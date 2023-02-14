<?php

namespace App\Http\Controllers;

use Dotenv\Store\File\Paths;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Session;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Http;
use League\CommonMark\Block\Renderer\ThematicBreakRenderer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class ChargeController extends Controller
{
    // SalesForce Token
    public $m_strToken = '';

    public function stripe()
    {
        return view('checkout');
    }

    /****************************************************************************/
    /* 処理概要 : AWS保存・圧縮処理
    /* 作成日：2022/12/22
    /* 作成者：沖本
    /****************************************************************************/
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'datafile' => 'file|image|max:1024|nullable'
        ])->validate();

        // ファイルの存在チェック
        if ($request->hasFile('datafile'))
        {

            $file = $request->file('datafile');
            $name = $file->getClientOriginalName();

           // if ($request['datafile']) {
           //     $file = $request->file('datafile');
           //     $name = $file->getClientOriginalName();
           //     // 画像を横幅300px・縦幅アスペクト比維持の自動サイズへリサイズ
           //     $image = Image::make($file)
           //         ->resize(300, null, function ($constraint) {
           //             $constraint->aspectRatio();
           //         });
           //     // configファイルに定義したS3のパスへ画像をアップロード
           //     Storage::put(config('filesystems.s3.url').$name, (string) $image->encode());
           // }

           //$disk = Storage::disk('s3');

            // 画像データが格納されているなら
            $image = Image::make($file);
            $image->resize(
                600,
                null,
                function ($constraint) {
                    // 縦横比を保持したままにする
                    $constraint->aspectRatio();
                    // 小さい画像は大きくしない
                    $constraint->upsize();
                }
            );
            $filePath = storage_path('app');
            $image->save($filePath.'\\'. $name);

            // 画像を横幅300px・縦幅アスペクト比維持の自動サイズへリサイズ
            // $image = Image::make($file)
            //     ->resize(300, null, function ($constraint) {
            //         $constraint->aspectRatio();
            //     });
            //  Storage::put(config('filesystems.s3.url').$name, (string) $image->encode());

            $path = Storage::disk('s3')->put('', $filePath."\\". $name);

            //Storage::put($disk, (string) $image->encode());

           // S3にファイルを保存し、保存したファイル名を取得する
           // $fileName = $disk->put('', $request->file('datafile'));
           //$fileName = $disk->put('', $image->encode());
            
            //$disk = Storage::disk('s3');

           // S3にファイルを保存し、保存したファイル名を取得する
            //$fileName = $disk->put('', file_get_contents($filePath.'\\'. $name));
           // $path = Storage::disk('s3')->putFile('', $filePath.'\\'. $name, 'public');
            //dd($disk->url($fileName));

           // $filename = Storage::disk('s3')->put('' , $image, 'public');
           // $fileNameには
           // https://saitobucket3.s3.amazonaws.com/uhgKiZeJXMFhL9Vr7yT7XvlJqonPNx30xbJYoEo0.jpeg
           // のような画像へのフルパスが格納されている
           // このフルパスをDBに格納しておくと、画像を表示させるのは簡単になる
           // dd($disk->url($fileName));
        }
        //return redirect('/');
        return true;
    }


    /****************************************************************************/
    /* 処理概要 : STRIPE決済処理
    /* 作成日：2022/12/22
    /* 作成者：沖本
    /****************************************************************************/
    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $customer = Customer::create(array(
                'name' => $_SESSION["fname"].' '.$_SESSION["lname"],
                'email' => $_SESSION["email"],      
                'address[postal_code]' => $_SESSION["zip_code"],
                'address[state]' => $_SESSION["state"],
                'address[city]' => $_SESSION["city"],
                'address[line2]' => $_SESSION["line2"],
                'phone' => $_SESSION["phone"],
                'source' => $request->stripeToken
            ));
        }
        catch (\Throwable $th) {
            Session::flash('error', "申込者情報の確認が出来ませんでした。入力画面からやり直してください。");
            return back();
        }

        $result = json_encode($customer);
        $array = json_decode($result , true );

        //$stripe = new \Stripe\StripeClient(
        //    env('STRIPE_SECRET')
        //);

        //$subscription = $stripe->subscriptions->create([
        //    'customer' => 'cus_N6zHYy7tvVHgQX',
        //    'items' => [
        //    ['price' => 'price_1Lg1n6EDV4naHKHgxY1sLEa8'],
        //    ],
        //]);

        
        // ユーザー登録処理
        $bRet = $this->SetUserData($_SESSION["Accountid"],$array["id"]);
        if ($bRet === false)
        {
            Session::flash('error', "ユーザ情報の作成に失敗しました。サポートまでお問い合わせください。");
            return back();
        }

        Mail::send('emails.SendMail', [
            "name" => $_SESSION["fname"].' '.$_SESSION["lname"],
            "url" => env('MAIL_RESET_PASS')."/password/reset/".$_SESSION["Token"]."?email=".urlencode($_SESSION["email"])
        ], function($message) {
            $message
                ->to($_SESSION["email"])
                ->subject("ユーザー登録ありがとうございます");
        });

        // ここで画面遷移
        Session::flash('success', 'Payment successful!');
        
        return view('complet');
    }

    /****************************************************************************/
    /* 処理概要 : デバイス情報登録呼び出し処理
    /* 作成日：2023/1/17
    /* 作成者：髙山
    /****************************************************************************/
    public function devicePost(Request $request)
    {

        //STRIPE決済処理
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $customer = Customer::create(array(
                'name' => $_SESSION["name"],
                'email' => $_SESSION["AccountEmail"],      
                'address[postal_code]' => $_SESSION["yuubenbango"],
                'address[state]' => $_SESSION["AccountState"],
                'address[city]' => $_SESSION["AccountCity"],
                //'address[line2]' => $_COOKIE["Accountline2"],
                'phone' => $_SESSION["AccountPhone"],
                'source' => $request->stripeToken
            ));
        }
        catch (\Throwable $th) {
            Session::flash('error', "申込者情報の確認が出来ませんでした。入力画面からやり直してください。");
            return back();
        }

        $result = json_encode($customer);
        $array = json_decode($result , true );

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $subscription = $stripe->subscriptions->create([
            'customer' => $array['id'],
            'items' => [
            ['price' => 'price_1Lg1n6EDV4naHKHgxY1sLEa8'],
            ],
        ]);

        $sub_id = $subscription->id;
        $cus_id = $array['id'];
        //$card_id = $array['default_source'];



        Validator::make($request->all(), [
            'device-img1' => 'file|image|max:1024|nullable'
        ])->validate();

        // ファイルの存在チェック
        if ($request->hasFile('device-img1'))
        {

            $file = $request->file('device-img1');
            $name = $file->getClientOriginalName();

           // if ($request['datafile']) {
           //     $file = $request->file('datafile');
           //     $name = $file->getClientOriginalName();
           //     // 画像を横幅300px・縦幅アスペクト比維持の自動サイズへリサイズ
           //     $image = Image::make($file)
           //         ->resize(300, null, function ($constraint) {
           //             $constraint->aspectRatio();
           //         });
           //     // configファイルに定義したS3のパスへ画像をアップロード
           //     Storage::put(config('filesystems.s3.url').$name, (string) $image->encode());
           // }

           //$disk = Storage::disk('s3');

            // 画像データが格納されているなら
            $image = Image::make($file);
            $image->resize(
                600,
                null,
                function ($constraint) {
                    // 縦横比を保持したままにする
                    $constraint->aspectRatio();
                    // 小さい画像は大きくしない
                    $constraint->upsize();
                }
            );
            $filePath = storage_path('app');
            $image->save($filePath.'\\'. $name);

            // 画像を横幅300px・縦幅アスペクト比維持の自動サイズへリサイズ
            // $image = Image::make($file)
            //     ->resize(300, null, function ($constraint) {
            //         $constraint->aspectRatio();
            //     });
            //  Storage::put(config('filesystems.s3.url').$name, (string) $image->encode());

            $path = Storage::disk('s3')->put('', $filePath."\\". $name);

            //Storage::put($disk, (string) $image->encode());

           // S3にファイルを保存し、保存したファイル名を取得する
           // $fileName = $disk->put('', $request->file('datafile'));
           //$fileName = $disk->put('', $image->encode());
            
            //$disk = Storage::disk('s3');

           // S3にファイルを保存し、保存したファイル名を取得する
            //$fileName = $disk->put('', file_get_contents($filePath.'\\'. $name));
           // $path = Storage::disk('s3')->putFile('', $filePath.'\\'. $name, 'public');
            //dd($disk->url($fileName));

           // $filename = Storage::disk('s3')->put('' , $image, 'public');
           // $fileNameには
           // https://saitobucket3.s3.amazonaws.com/uhgKiZeJXMFhL9Vr7yT7XvlJqonPNx30xbJYoEo0.jpeg
           // のような画像へのフルパスが格納されている
           // このフルパスをDBに格納しておくと、画像を表示させるのは簡単になる
           // dd($disk->url($fileName));
        }

        // OAuth2.0認証処理
        $this->m_strToken = $this->getOAuth();

        // セールスフォースデータ登録処理(申込内容)
        $bRet = $this->SetSalesForceInsertDeviceDataTaks($sub_id,$cus_id);
        if ($bRet === false)
        {
            Session::flash('error', "デバイス情報の作成に失敗しました。");
            return back();
        }
        
        return view('device-comp');
    }

    /****************************************************************************/
    /* 処理概要 : 保険金請求登録呼び出し処理
    /* 作成日：2023/02/07
    /* 作成者：髙山
    /****************************************************************************/
    public function claimPost()
    {
        // OAuth2.0認証処理
        $this->m_strToken = $this->getOAuth();

        // セールスフォースデータ登録処理(保険金請求)
        $bRet = $this->SetSalesForceInsertClaimDataTaks();
        if ($bRet === false)
        {
            Session::flash('error', "請求情報の送信に失敗しました。時間をおいて、再度送信してください。");
            return view('confirmation');
        }

        return view('claimcomplet');
    }

    /****************************************************************************/
    /* 処理概要 : 申込情報変更処理呼び出し
    /* 作成日：2023/02/03
    /* 作成者：髙山
    /****************************************************************************/
    public function chengePost() {

        // OAuth2.0認証処理
        $this->m_strToken = $this->getOAuth();

        // セールスフォースデータ変更処理(個人取引先)
        $bRet = $this->SetSalesForceUpdateDataTaks();
        if ($bRet === false)
        {
            Session::flash('error', "変更情報の送信に失敗しました。時間をおいて、再度送信してください。");
            return view('contractchange-check');
        }
        
        return view('contractchange-comp');
    }

    /****************************************************************************/
    /* 処理概要 : 支払変更処理
    /* 作成日：2023/02/10
    /* 作成者：髙山
    /****************************************************************************/
    public function chengePayment(Request $request) {

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $cus_id = $_SESSION[ 'customerid' ];

        try {
            Customer::update(
            $cus_id,
            [
                'source' => $request->stripeToken
            ]
            );
        }
        catch(\Throwable $th) {
            Session::flash('error', "お支払い方法の変更に失敗しました。");
            return back();
        }

        return view("cangepayment-comp");
    }

    /****************************************************************************/
    /* 処理概要 : デバイス削除処理呼び出し
    /* 作成日：2023/02/06
    /* 作成者：髙山
    /****************************************************************************/
    public function deviceDelete() {

        // OAuth2.0認証処理
        $this->m_strToken = $this->getOAuth();
        
        // 決済情報削除処理
        $bRet =$this->DeleteStripe($_SESSION[ 'stripeid' ]);
        if ($bRet === false)
        {
            Session::flash('false', "決済情報の削除に失敗しました。");
            return back();
        }

        // 保険金請求済みなら削除処理を行う
        if (!empty($_SESSION[ 'Hokenkinid' ])) {
            // セールスフォースデータ削除処理(保険金請求)
            $bRet = $this->SetSalesForceDeleteHokenkinDataTaks($_SESSION[ 'Hokenkinid' ]);
            if ($bRet === false)
            {
                Session::flash('false', "保険金情報の削除に失敗しました。");
                return back();
            }
        }

        // セールスフォースデータ削除処理(デバイス情報)
        $bRet = $this->SetSalesForceDeleteDeviceDataTaks($_SESSION["Taksid"]);
        if ($bRet === false)
        {
            Session::flash('false', "デバイスの削除に失敗しました。");
            return back();
        }
        Session::flash('true', "");
        return back();
    }

    /****************************************************************************/
    /* 処理概要 : 保険解約処理呼び出し
    /* 作成日：2023/02/07
    /* 作成者：髙山
    /****************************************************************************/
    public function AccountCancel() {
        // OAuth2.0認証処理
        $this->m_strToken = $this->getOAuth();

        //決済情報削除処理
        $res = $this->SelectStripeId();

        if ($res === false) {
            Session::flash('false', "stripeデータの取得に失敗しました。");
            return back();
        }

        $stripe_id = $res[0]->stripe_id;

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $subscription = \Stripe\Subscription::retrieve($stripe_id);
            $subscription->cancel();
            }
            
        catch (\Throwable $th) {
            // エラー
            $this->SendSlack($th->getMessage());
            return false;
        }  

        //デバイス情報の登録があれば削除処理を行う
        if (!empty($_SESSION[ 'deviceId' ])) {
            //保険金請求の登録があれば削除処理を行う
            if (!empty($_SESSION[ 'HokenkinId' ])) {

                $HokenkinArry = $_SESSION[ 'HokenkinId' ];
                $length = count($HokenkinArry);

                for ($i = 0; $i < $length; $i++) {

                    $HokenkinId = $HokenkinArry[$i];

                    // セールスフォース登録デバイス削除処理
                    $bRet = $this->SetSalesForceDeleteHokenkinDataTaks($HokenkinId);
                    if ($bRet === false)
                    {
                        Session::flash('false', "保険金請求データの削除に失敗しました。");
                        return back();
                    }
                }
            }

            // デバイスデータの取り出し
            $deviceIdArry = $_SESSION[ 'deviceId' ];
            $length = count($deviceIdArry);

            for ($i = 0; $i < $length; $i++) {

                $deviceId = $deviceIdArry[$i];
                // セールスフォース登録デバイス削除処理
                $bRet = $this->SetSalesForceDeleteDeviceDataTaks($deviceId);
                if ($bRet === false)
                {
                    Session::flash('false', "デバイスデータの削除に失敗しました。");
                    return back();
                }
            }

            //決済情報削除処理
            $stripeIdArry = $_SESSION[ 'stripeId' ];
            $length = count($stripeIdArry);

            for ($i = 0; $i < $length; $i++) {

                $stripeId = $stripeIdArry[$i];
                // セールスフォース登録デバイス削除処理
                $bRet = $this->DeleteStripe($stripeId);
                if ($bRet === false)
                {
                    Session::flash('false', "決済情報の削除に失敗しました。");
                    return back();
                }
            }
        }

        // セールスフォースデータ削除処理(個人取引先)
        $bRet = $this->SetSalesForceDeleteDataTaks();
        if ($bRet === false)
        {
            Session::flash('false', "データの削除に失敗しました。");
            return back();
        }

        // データベース削除処理
        $bRet = $this->DeleteUserData();
        if ($bRet === false)
        {
            Session::flash('false', "保険の解約に失敗しました。");
            return back();
        }

        Session::flash('true', "");
        return view('cancel-comp');
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
    /* 処理概要 : Slack通知処理
    /* 作成日：2022/12/22
    /* 作成者：沖本
    /****************************************************************************/
    public function SendSlack($strMessage)
    {
        str_replace('�','', $strMessage);
        $url = 'https://hooks.slack.com/services/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';
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
            'PersonEmail'=> $_SESSION["email"],
            'Phone'=> $_SESSION["phone"],
            'LastName'=> $_SESSION["fname"].' '.$_SESSION["lname"],
            'Kokyakuseikanji__pc' => $_SESSION["fname"],
            'Kokyakumeikanji__pc' => $_SESSION["lname"],
            'Kokyakuseikana__pc' => $_SESSION["fnamekana"],
            'Kokyakumeikana__pc' => $_SESSION["lnamekana"],
            'Moushikomishaseinengappi__pc' => $_SESSION["birthday"],
            'state__c' => $_SESSION["state"],
            'city__c' => $_SESSION["city"],
            'Yuubenbango__pc' => $_SESSION["zip_code"],
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
    /* 処理概要 : セールスフォースデータ登録処理(デバイス情報)
    /* 作成日：2023/1/17
    /* 作成者：髙山
    /****************************************************************************/
    public function SetSalesForceInsertDeviceDataTaks($sub_id,$cus_id)
    {
        $path = '/services/data/v55.0/composite/tree/Taks__c/';
        $url = 'https://onenet3.my.salesforce.com' . $path;
        $token = $this->m_strToken;

        $arrData = array();
        $nCnt = 1;

        $Data = [
            'attributes' => array('type'=>'Taks__c', 'referenceId' => "ref".$nCnt),
            'Account__c'  => $_SESSION["Accountid"],
            'Maker__c' => $_SESSION["maker"],
            'Model__c' => $_SESSION["model"],
            'SerialNumber__c' => $_SESSION["number"],
            'Device__c' => $_SESSION["device"],
            'Imei__c' => $_SESSION["imei"],
            'ContractCapacity__c' => $_SESSION["capacity"],
            'Purchase__c' => $_SESSION["purchase"],
            'Amount__c' => $_SESSION["amount"],
            'Career__c' => $_SESSION["career"],
            'STRIPE_ID__c' => $sub_id,
            'STRIPE_CUS_ID__c' => $cus_id,
            'Name' => "デバイス保険",
            'OwnerId' => '0055h000006j5uBAAQ',
            'CreatedById'  => '0055h000006j5uBAAQ',
            'LastModifiedById' => '0055h000006j5uBAAQ',
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
            $this->SendSlack("デバイス情報の作成に失敗しました。");
            return false;
        }
        $list = json_decode($res->getBody()->getContents(), true);

        $arr = $list["results"];
        $_SESSION('Taks_id', $arr[0]["id"]);

        return true;
    }

    /****************************************************************************/
    /* 処理概要 : セールスフォースデータ登録処理(保険金請求)
    /* 作成日：2022/02/07
    /* 作成者：髙山
    /****************************************************************************/
    public function SetSalesForceInsertClaimDataTaks()
    {
        $path = '/services/data/v55.0/composite/tree/Hokenkin__c/';
        $url = 'https://onenet3.my.salesforce.com' . $path;
        $token = $this->m_strToken;

        $arrData = array();
        $nCnt = 1;
        $date = date("Y-m-d");

        $Data = [
            'attributes' => array('type'=>'Hokenkin__c', 'referenceId' => "ref".$nCnt),
            'Account__c'  => $_SESSION["Accountid"],
            'Tak__c'  => $_SESSION["Taksid"],
            'status__c'  => "審査中",
            'AccidentDivision__c' => $_SESSION["flag"],
            'RepairYN__c' => $_SESSION["check"],
            'AccidentDay__c' => $_SESSION["acc_date"],
            'AccidentPerson__c' => $_SESSION["acc_name"],
            'AccidentPlace__c' => $_SESSION["acc_place"],
            'AccidentAdd__c' => $_SESSION["acc_add"],
            'AccidentSituation__c' => $_SESSION["acc_status"],
            'DeviceSituation__c' => $_SESSION["acc_condition"],
            'NoAttached__c' => $_SESSION["acc_messe"],
            'NoDocument__c' => $_SESSION["acc_messe2"],
            'shinseibi__c' => $date,
            'Name' => "デバイス保険",
            'OwnerId' => '0055h000006j5uBAAQ',
            'CreatedById'  => '0055h000006j5uBAAQ',
            'LastModifiedById' => '0055h000006j5uBAAQ',
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
            //$this->SendSlack($th->getMessage());
            $this->SendSlack("保険金請求情報の作成に失敗しました。");
            return false;
        }
        $list = json_decode($res->getBody()->getContents(), true);

        $arr = $list["results"];
        $_SESSION('Taks_id', $arr[0]["id"]);

        return true;
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
            $strErrorMsg = "既に登録済みのメールアドレスです。";
        }

        return true;
    }

    /****************************************************************************/
    /* 処理概要 : セールスフォースデータ変更処理(個人取引先)
    /* 作成日：2023/02/03
    /* 作成者：髙山
    /****************************************************************************/
    public function SetSalesForceUpdateDataTaks() {

        $path = '/services/data/v55.0/sobjects/account/'.$_SESSION["Accountid"];
        $url = 'https://onenet3.my.salesforce.com' . $path;
        $token = $this->m_strToken;

        $postData = [
            'PersonEmail'=> $_SESSION["email"],
            'Phone'=> $_SESSION["phone"],
            'LastName'=> $_SESSION["fname"].' '.$_SESSION["lname"],
            'Kokyakuseikanji__pc' => $_SESSION["fname"],
            'Kokyakumeikanji__pc' => $_SESSION["lname"],
            'Kokyakuseikana__pc' => $_SESSION["fnamekana"],
            'Kokyakumeikana__pc' => $_SESSION["lnamekana"],
            'Moushikomishaseinengappi__pc' => $_SESSION["birthday"],
            'state__c' => $_SESSION["state"],
            'city__c' => $_SESSION["city"],
            'Yuubenbango__pc' => $_SESSION["zip_code"],
            'line2__c' => $_SESSION["line2"],
        ];

        $params = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
            'body' => json_encode($postData),
        ];

        $client = new \GuzzleHttp\Client();
        // 結果の確認
        try {
            $res = $client->request('PATCH', $url, $params);
        } catch (\Throwable $th) {
            // エラー
            $this->SendSlack("個人取引先の変更に失敗しました。");
            return false;
        }

        $res->getBody()->getContents();

        return true;
    }

    /****************************************************************************/
    /* 処理概要 : セールスフォースデータ削除処理(保険金請求)
    /* 作成日：2022/02/08
    /* 作成者：髙山
    /****************************************************************************/
    public function SetSalesForceDeleteHokenkinDataTaks($HokenkinId) {

        $path = 'https://onenet3.my.salesforce.com/services/data/v55.0/sobjects/Hokenkin__c/'.$HokenkinId;
        
        $token = $this->m_strToken;

        $params = [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ];

        $client = new \GuzzleHttp\Client();
        try {
            $client->request('DELETE', $path, $params);
        }
        catch (\Throwable $th) {
            $this->SendSlack("保険金請求情報の削除に失敗しました。");
            return false;
        }

        return true;
    }

    /****************************************************************************/
    /* 処理概要 : セールスフォースデータ削除処理(デバイス情報)
    /* 作成日：2023/02/06
    /* 作成者：髙山
    /****************************************************************************/
    public function SetSalesForceDeleteDeviceDataTaks($deviceId) {

        $path = 'https://onenet3.my.salesforce.com/services/data/v55.0/sobjects/Taks__c/'.$deviceId;

        $token = $this->m_strToken;

        $params = [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ];

        $client = new \GuzzleHttp\Client();
        try {
            $client->request('DELETE', $path, $params);
        }
        catch (\Throwable $th) {
            //$this->SendSlack($th->getMessage());
            $this->SendSlack("デバイス情報の削除に失敗しました。");
            return false;
        }

        return true;
    }

    /****************************************************************************/
    /* 処理概要 : セールスフォースデータ削除処理(個人取引先)
    /* 作成日：2023/02/07
    /* 作成者：髙山
    /****************************************************************************/
    public function SetSalesForceDeleteDataTaks() {

        $path = '/services/data/v55.0/sobjects/account/'.$_SESSION["Accountid"];
        $url = 'https://onenet3.my.salesforce.com' . $path;
        $token = $this->m_strToken;

        $params = [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ];

        $client = new \GuzzleHttp\Client();
        try {
            $client->request('DELETE', $url, $params);
        }
        catch (\Throwable $th) {
            //$this->SendSlack($th->getMessage());
            $this->SendSlack("個人取引先の削除に失敗しました。");
            return back();
        }

        return view('cancel-comp');
    }

    /****************************************************************************/
    /* 処理概要 : データベースユーザ削除処理(個人取引先)
    /* 作成日：2023/02/07
    /* 作成者：髙山
    /****************************************************************************/
    public function DeleteUserData() {

        $strSql = "DELETE FROM users WHERE accountid = '".$_SESSION["Accountid"]."'";

        try {
            // SQL実行
            DB::connection("pgsql")->delete($strSql);
        }
        catch (\Throwable $th) {
            // エラー
            $this->SendSlack($th->getMessage(),false);
            Log::error($strSql);
            return false;
        }

        return true;
    }

    /****************************************************************************/
    /* 処理概要 : データベースstripe_id取得処理
    /* 作成日：2023/02/09
    /* 作成者：髙山
    /****************************************************************************/
    public function SelectStripeId() {

        $strSql = "SELECT stripe_id FROM users WHERE accountid = '".$_SESSION["Accountid"]."'";

        try {
            // SQL実行
            $res = DB::connection("pgsql")->select($strSql);
        }
        catch (\Throwable $th) {
            // エラー
            $this->SendSlack($th->getMessage(),false);
            Log::error($strSql);
            return false;
        }

        return $res;
    }

    /****************************************************************************/
    /* 処理概要 : 決済情報削除処理
    /* 作成日：2023/02/09
    /* 作成者：髙山
    /****************************************************************************/
    public function DeleteStripe($stripe_id) {

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $subscription = \Stripe\Subscription::retrieve($stripe_id);
            $subscription->cancel();
            }
            
        catch (\Throwable $th) {
            // エラー
            $this->SendSlack($th->getMessage());
            return false;
        }  

        return true;
    }

    /****************************************************************************/
    /* 処理概要 : ユーザー登録処理
    /* 作成日：2023/01/04
    /* 作成者：沖本
    /****************************************************************************/
    public function SetUserData($strAccountid,$strStripeid)
    {
        $strPass = str()->random(8);
        $encryptedPassword = Hash::make($strPass);

        $user = array(
            'name' => $_SESSION["fname"].' '.$_SESSION["lname"], 
            'email' => $_SESSION["email"], 
            'password' => $encryptedPassword,
            'accountid' => $strAccountid,
            'stripe_id' => $strStripeid);
        // user作成
        $user = User::create($user);

        return true;
    }
}