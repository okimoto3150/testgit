<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();
        $arr = array();
        $arr = json_decode(json_encode($user), true);
        $arrRet = array();

        // OAuth2.0認証処理
        $this->m_strToken = $this->getOAuth();
        // セールスフォースデータ取得処理(個人取引先)
        $this->SelectSalesForceAccount($listAccount,$arr);
        $listAccount = array_slice($listAccount, 1);

        // セールスフォースデータ取得処理(申込内容)
        $this->SelectSalesForceTaks($listTaks,$arr);

        // セールスフォースデータ取得処理(保険金請求)
        $this->SelectSalesForceHokenkin($listHokenkin,$arr);

        $kigen = time() + 30 * 24 * 3600;
        setcookie('Accountid', $listAccount["Id"], $kigen);
        setcookie('name', $listAccount["Name"], $kigen);
        setcookie('AccountFirstName', $listAccount["Kokyakuseikanji__pc"], $kigen);
        setcookie('AccountLastName', $listAccount["Kokyakumeikanji__pc"], $kigen);
        setcookie('AccountFirstNameKana', $listAccount["Kokyakuseikana__pc"], $kigen);
        setcookie('AccountLastNameKana', $listAccount["Kokyakumeikana__pc"], $kigen);
        setcookie('birthday', $listAccount["Moushikomishaseinengappi__pc"], $kigen);
        setcookie('AccountEmail', $listAccount["PersonEmail"], $kigen);
        setcookie('AccountPhone', $listAccount["Phone"], $kigen);
        setcookie('yuubenbango', $listAccount["Yuubenbango__pc"], $kigen);
        setcookie('AccountState', $listAccount["state__c"], $kigen);
        setcookie('AccountCity', $listAccount["city__c"], $kigen);
        setcookie('Accountline2', $listAccount["line2__c"], $kigen);

        // View用の連想配列生成
        $Customer = array(
            'TaksCount' => count($listTaks),
            'HokenkinCount' => count($listHokenkin),
            'Accountid' => $listAccount["Id"],
            'AccountFullName' => $listAccount["Name"],
            'AccountLastName' => $listAccount["LastName"],
            'AccountFirstName' => $listAccount["FirstName"],
            'AccountLastNameKana' => $listAccount["Kokyakumeikana__pc"],
            'AccountFirstNameKana' => $listAccount["Kokyakuseikana__pc"],
            'AccountPhone' => $listAccount["Phone"],
            'AccountEmail' => $listAccount["PersonEmail"],
            'AccountState' => $listAccount["state__c"],
            'AccountCity' => $listAccount["city__c"],
            'Accountline1' => $listAccount["line1__c"],
            'Accountline2' => $listAccount["line2__c"],
            'birthday' => $listAccount["Moushikomishaseinengappi__pc"],
            'yuubenbango' => $listAccount["Yuubenbango__pc"],
            'Add' => $listAccount["state__c"].$listAccount["city__c"].$listAccount["line1__c"].$listAccount["line2__c"],
        );


        $nTaksCnt = 0;
        foreach ($listTaks as $value)
        {
            $Customer["TaksId".$nTaksCnt] =  $value["Id"];
            $Customer["TaksName".$nTaksCnt] =  $value["Name"];
            $Customer["device".$nTaksCnt] =  $value["Device__c"];
            $Customer["maker".$nTaksCnt] =  $value["Maker__c"];
            $Customer["model".$nTaksCnt] =  $value["Model__c"];
            $Customer["number".$nTaksCnt] =  $value["SerialNumber__c"];
            $Customer["imei".$nTaksCnt] =  $value["Imei__c"];
            $Customer["capacity".$nTaksCnt] =  $value["ContractCapacity__c"];
            $Customer["purchase".$nTaksCnt] =  $value["Purchase__c"];
            $Customer["amount".$nTaksCnt] =  $value["Amount__c"];
            $Customer["career".$nTaksCnt] =  $value["Career__c"];
            $Customer["stripeId".$nTaksCnt] =  $value["STRIPE_ID__c"];
            $Customer["cusId".$nTaksCnt] =  $value["STRIPE_CUS_ID__c"];

            $nTaksCnt++;
        }


        $nHokenkinCnt = 0;
        foreach ($listHokenkin as $value)
        {
            $Customer["HokenkinId".$nHokenkinCnt] =  $value["Id"];
            $Customer["TaksId_h".$nHokenkinCnt] =  $value["Tak__c"];
            $Customer["status".$nHokenkinCnt] =  $value["status__c"];
            $Customer["AccidentDay".$nHokenkinCnt] =  $value["AccidentDay__c"];
            $Customer["DeviceSituation".$nHokenkinCnt] =  $value["DeviceSituation__c"];

            $nHokenkinCnt++;
        }

        return view('home')->with('Customer', $Customer);
    }

    public function claim()
    {
        return view('claim');
    }

    public function complet()
    {
        return view('complet');
    }

    public function claimcomplet()
    {
        return view('claimcomplet');
    }

    public function confirmation(Request $moji)
	{
        $data1 = $moji::all();
        return view('confirmation',compact('data1'));
	}

    public function costomer(Request $moji)
	{
        $data1 = $moji::all();
        return view('costomer',compact('costomerdata'));
	}

    public function devicecheck(Request $moji)
	{
        $data1 = $moji::all();
        return view('device-check',compact('data1'));
	}

    public function contractchangecheck(Request $moji)
	{
        $data1 = $moji::all();
        return view('contractchange-check',compact('data1'));
	}

    public function func() {
        $user = new User;
        $value = $user->find(1);
        $arr = ['Snome1', 'Snome2', 'Snome3'];
        return view('sample', compact('value', 'arr'));
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
    /* 処理概要 : 個人取引先情報取得処理
    /* 作成日：2022/12/22
    /* 作成者：沖本
    /****************************************************************************/    
    public function SelectSalesForceAccount(&$list,$arr)
    {
        $path  = 'https://onenet3.my.salesforce.com/services/data/v55.0/sobjects/account/'.$arr['accountid'];
        $token = $this->m_strToken;

        $params = [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ];

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $path, $params);

        // 結果の確認
        $list = json_decode($res->getBody()->getContents(), true);
    }

    /****************************************************************************/
    /* 処理概要 : 申込内容情報取得処理
    /* 作成日：2022/12/28
    /* 作成者：沖本
    /****************************************************************************/    
    public function SelectSalesForceTaks(&$listTaks,$arr)
    {
        $path  = 'https://onenet3.my.salesforce.com/services/data/v55.0/query/?q=SELECT+ID+FROM+Taks__c+WHERE+ACCOUNT__C=\''.$arr['accountid'].'\'';
        $token = $this->m_strToken;
        $listtmp = array();
        $listTaks = array();

        $params = [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ];

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $path, $params);

        // 結果の確認
        $list = json_decode($res->getBody()->getContents(), true);

        foreach ($list['records'] as $value)
        {
            $path  = 'https://onenet3.my.salesforce.com/services/data/v55.0/sobjects/Taks__c/'.$value['Id'];
            $res = $client->request('GET', $path, $params);
            $listtmp = json_decode($res->getBody()->getContents(), true);
            array_push($listTaks,$listtmp);
        }
    }

    /****************************************************************************/
    /* 処理概要 : 保険金請求情報取得処理
    /* 作成日：2022/02/08
    /* 作成者：髙山
    /****************************************************************************/ 
    public function SelectSalesForceHokenkin(&$listHokenkin,$arr) {

        $path  = 'https://onenet3.my.salesforce.com/services/data/v55.0/query/?q=SELECT+ID+FROM+Hokenkin__c+WHERE+ACCOUNT__C=\''.$arr['accountid'].'\'';
        $token = $this->m_strToken;
        $listtmp = array();
        $listHokenkin = array();

        $params = [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ];

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $path, $params);

        // 結果の確認
        $list = json_decode($res->getBody()->getContents(), true);

        foreach ($list['records'] as $value)
        {
            $path  = 'https://onenet3.my.salesforce.com/services/data/v55.0/sobjects/Hokenkin__c/'.$value['Id'];
            $res = $client->request('GET', $path, $params);
            $listtmp = json_decode($res->getBody()->getContents(), true);
            array_push($listHokenkin,$listtmp);
        }

    }

}
