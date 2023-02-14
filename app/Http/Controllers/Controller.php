<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        public function check(Request $moji)
        {
            $data1 = $moji::all();
            return view('check',compact('data1'));
        }

        public function checkout(Request $moji)
        {
            session_start();
            // ユーザー重複チェック処理
            $bRet = $this->GetUserData($dtUser,$strErrorMsg);
            if ($bRet === false)
            {
                Session::flash('error', "ユーザ情報の取得に失敗しました。サポートまでお問い合わせください。");
                return back();
            }
            elseif (strlen($strErrorMsg) !== 0)
            {
                Session::flash('error', $strErrorMsg);
                return back();
            }

            try {
                $strAgency = $_COOKIE["agency"];
            }
            catch (\Throwable $th) {
                $strAgency = '';
            }
            switch ($strAgency){
                 case 'ISF2B5E8': // 代理店Aの場合
                    $strAgency = '0055h000008dOFKAA2';
                    break;
                 case 'MAH20CGG': // 代理店Bの場合
                    $strAgency = '0055h000008dOFUAA2';
                    break;
                 default: // その他は全てone net
                    $strAgency = '0055h000006j5uBAAQ';
            }
        
            try {
                $strAccountid = $_COOKIE["Accountid"];
            }
            catch (\Throwable $th) {

                 // OAuth2.0認証処理
                $this->m_strToken = $this->getOAuth();
                // セールスフォースデータ登録処理(個人取引先)
                $bRet = $this->SetSalesForceInsertDataAccount($res,$strAgency);
                if ($bRet === false)
                {
                    Session::flash('error', "申込者情報の作成に失敗しました。サポートまでお問い合わせください。");
                    return back();
                }
                $arr = $res["results"];
                setcookie("Accountid",$arr[0]["id"]);

                // Token作成処理
                $strToken = str_replace('%','',urlencode(str()->random(40)));
                $bRet = $this->SetToken($strToken);
                if ($bRet === false)
                {
                    Session::flash('error', "Tokenの作成に失敗しました。サポートまでお問い合わせください。");
                    return back();
                }
                setcookie("Token",$strToken);
            }

            return view('checkout');
	}

        /****************************************************************************/
        /* 処理概要 : セールスフォースデータ登録処理(個人取引先)
        /* 作成日：2022/12/22
        /* 作成者：沖本
        /****************************************************************************/
        public function SetSalesForceInsertDataAccount(&$list,$strAgency)
        {
            $path = '/services/data/v55.0/composite/tree/Account/';
            $url = 'https://onenet3.my.salesforce.com' . $path;
            $token = $this->m_strToken;
            
            $arrData = array();
            $nCnt = 1;

            $Data = [
                'attributes' => array('type'=>'Account', 'referenceId' => "ref".$nCnt),
                'RecordTypeId'  => '0125h000000UUCBAA4',
                'PersonEmail'=> $_COOKIE["email"],
                'Phone'=> $_COOKIE["phone"],
                'LastName'=> $_COOKIE["fname"].' '.$_COOKIE["lname"],
                'Kokyakuseikanji__pc' => $_COOKIE["fname"],
                'Kokyakumeikanji__pc' => $_COOKIE["lname"],
                'Kokyakuseikana__pc' => $_COOKIE["fnamekana"],
                'Kokyakumeikana__pc' => $_COOKIE["lnamekana"],
                'Moushikomishaseinengappi__pc' => $_COOKIE["birthday"],
                'state__c' => $_COOKIE["state"],
                'city__c' => $_COOKIE["city"],
                'Yuubenbango__pc' => $_COOKIE["zip_code"],
                'line2__c' => $_COOKIE["line2"],
                'UserAgent__c' => $_SERVER["HTTP_USER_AGENT"],
                'Host__c' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
                'OwnerId' => $strAgency,
                'CreatedById'  => $strAgency,
                'LastModifiedById' => $strAgency,
            ];
            
            array_push($arrData,$Data);

            $postdata = [
                'records' => $arrData,
            ];

            $params = [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
                'body' => json_encode($postdata),
            ];

            $client = new \GuzzleHttp\Client();
            try {
                $res = $client->request('POST', $url, $params);
            }
            catch (\Throwable $th) {
                // エラー
                $this->SendSlack("個人取引先の作成に失敗しました。");
                return false;
            }
            $list = json_decode($res->getBody()->getContents(), true);

            return true;
        }

        /****************************************************************************/
        /* 処理概要 : OAuth2.0認証処理
        /* 作成日：2022/12/22
        /* 作成者：沖本
        /****************************************************************************/
        public function getOAuth()
        {
            $path = '/services/oauth2/token';
            $url  = 'https://login.salesforce.com' . $path;
            $params = [
                'form_params' => [
                    'client_id'  => '3MVG9Nvmjd9lcjRnZECY3dNT6D49P18WUelxW3.QM.RffNKhejAF8uT5b08S27MwpmIXMfM68LVpZVa.cHV2p',
                    'client_secret' => '8BF5742F223C40144FF0F93EC8C36F419CE6C1455D0E73132EAAA289D4905FDA',
                    'grant_type'=> 'password',
                    'username'=> 'okimoto@one-net.jp',
                    'password'=> 'Pass1115WIxYTBKGGdoOrBg6AN8TQ4XTU',
                ]
            ];
            $client  = new \GuzzleHttp\Client();
            try {
                $resJson = $client->request('POST', $url, $params)->getBody()->getContents();
            }
            catch (\Throwable $th) {
                // エラー
                $this->SendSlack($th->getMessage());
                return false;
            }  
            
            $resAry  = json_decode($resJson, true);

            return $resAry['access_token'] ?? '';
        }

        /****************************************************************************/
        /* 処理概要 : ユーザー重複チェック処理
        /* 作成日：2023/01/04
        /* 作成者：沖本
        /****************************************************************************/
        public function GetUserData(&$dtUser,&$strErrorMsg)
        {
            $strSql = "SELECT * FROM users WHERE email = '".$_SESSION["email"]."'" ;

            try {
                // SQL実行
                $dtUser = DB::connection("pgsql")->select($strSql);
            }
            catch (\Throwable $th) {
                // エラー
                $this->SendSlack($th->getMessage(),false);
                Log::error($strSql);
                return false;
            }

            if (count($dtUser) > 0)
            {
                $strErrorMsg = "既に登録済みのメールアドレスです。修正するボタンを押して、別のアドレスを入力するか、パスワードが不明な場合はパスワードリセットをご利用ください。";
            }

            return true;
        }

        /****************************************************************************/
        /* 処理概要 : Slack通知処理
        /* 作成日：2022/12/22
        /* 作成者：沖本
        /****************************************************************************/
        public function SendSlack($strMessage)
        {
            str_replace('�','', $strMessage);
            $url = '';
            $payload = [
                    'text' => $strMessage,
            ];
            $params = [
                    'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($payload),
            ];
            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', $url, $params);
    
            return;
        }

    /****************************************************************************/
    /* 処理概要 : Token登録処理
    /* 作成日：2023/01/06
    /* 作成者：沖本
    /****************************************************************************/
    public function SetToken($strToken)
    {
        $strSql = "INSERT INTO password_resets VALUES('".$_COOKIE["email"]."','".Hash::make($strToken)."','".date('Y-m-d H:i:s')."') ";
        $strSql .= "on conflict (email) do update set token='".Hash::make($strToken)."',created_at='".date('Y-m-d H:i:s')."'";

        try {
            // SQL実行
            $dtUser = DB::connection("pgsql")->insert($strSql);
        }
        catch (\Throwable $th) {
            // エラー
            $this->SendSlack($th->getMessage(),false);
            Log::error($strSql);
            return false;
        }

        return true;
    }
}
