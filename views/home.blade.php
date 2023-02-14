<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>デバイス保険</title>
        <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
        <link rel="stylesheet" href="{{asset('css/mypage.css')}}">
        <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.min.js"></script>
    </head>
    <body>
        <header>
            @include('ham-header')
        </header>
        <main>
            <div class="m-contener">
                <div class="mypage-left">
                    <ul>
                        <li><a href="/home">マイページトップ</a></li>
                        <li><a href="/device-entry">対象デバイスの追加</a></li>
                        <li><a href="/cancel">保険の解約</a></li>
                        <li><a href="/terms">利用規約</a></li>
                        <li><a href="/privacypolicy">プライバシーポリシー</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                    </ul>
                </div>
                <div class="m-wrap">
                    <div class="mypage-top"></div>
                    <div class="home-m">
                        <p class="home-m__name">{{ $Customer['AccountFullName'] }}<span>　さん</span></p>
                        <h2 class="home-m__ttl">マイページ</h2>
                        <p class="home-m__text">
                            ご契約内容の確認、保険金の請求、契約内容の変更などの手続きを行うことができます。
                        </p>


                        <div class="home-m__device-entry" id="home-m__device-entry">
                            <p class="home-m__device-entry--text">ご登録のデバイスがまだありません。以下のボタンより保険を適用したいデバイスをご登録ください。</p>
                            <button class="home-m__device-entry--btn"><a href="{{url('/device-entry')}}" class="contract-plas__btn--link">⊕ デバイスを追加する</a></button>
                        </div>


                        <!-- ご契約者情報　-->
                        <section class="Contractor">
                            <h2 class="Contractor__ttl">ご契約者情報</h2>
                            <dl class="Contractor__list">
                                <div class="Contractor__left">
                                    <dt class="Contractor__list--ttl">氏名</dt>
                                    <dd class="Contractor__list--data">{{ $Customer['AccountFullName'] }}</dd>
                                    <dt class="Contractor__list--ttl">氏名(フリガナ)</dt>
                                    <dd class="Contractor__list--data">{{ $Customer['AccountFirstNameKana'] }}  {{ $Customer['AccountLastNameKana'] }}</dd>
                                    <dt class="Contractor__list--ttl">生年月日</dt>
                                    <dd class="Contractor__list--data">{{ $Customer['birthday'] }}</dd>
                                </div>
                                <div class="Contractor__right">
                                    <dt class="Contractor__list--ttl">携帯電話番号</dt>
                                    <dd class="Contractor__list--data">{{ $Customer['AccountPhone'] }}</dd>
                                    <dt class="Contractor__list--ttl">郵便番号</dt>
                                    <dd class="Contractor__list--data">{{ $Customer['yuubenbango'] }}</dd>
                                    <dt class="Contractor__list--ttl">住所</dt>
                                    <dd class="Contractor__list--data">{{ $Customer['Add'] }}</dd>
                                </div>
                            </dl>
                        </section>
                        <div class="change-btng">
                            <button class="change-btng__user"><a href="/contractchange" class="change-btng__user--link">ご契約者情報の変更</a></button>
                            <!--<button class="change-btng__payment"><a href="" class="change-btng__payment--link">お支払情報の変更</a></button>-->
                        </div>
                        <!-- 対象デバイス　-->
                        <div class="contract" id="contract">
                            <h2 class="contract__ttl">契約一覧</h2>

                            <?php
                                $nTaksCnt = $Customer["TaksCount"];
                                $nHokenkinCnt = $Customer["HokenkinCount"];
                                $kigen = time() + 30 * 24 * 3600;

                                $nTaksCnt--;
                                $nHokenkinCnt--;

                                //顧客情報cookieに格納
                                
                                //$kigen = time() + 30 * 24 * 3600;
                                //setcookie('name', $Customer["birthday"], $kigen);
                                $j = 0;

                                //デバイスidのcookieをリセット
                                if (!empty($_COOKIE[ 'deviceId' ])) {

                                    $deviceId = $_COOKIE[ 'deviceId' ];
                                    $length = count($deviceId);
    
                                    for ($k = 0; $k < $length; $k++) {
                                        setcookie("deviceId[$k]", "", time()-60);
                                        setcookie("stripeId[$k]", "", time()-60);
                                        setcookie("customerId[$k]", "", time()-60);
                                    }
    
                                }

                                //保険金請求idのcookieをリセット
                                if (!empty($_COOKIE[ 'HokenkinId' ])) {

                                    $HokenkinId = $_COOKIE[ 'HokenkinId' ];
                                    $length = count($HokenkinId);
    
                                    for ($k = 0; $k < $length; $k++) {
                                        setcookie("HokenkinId[$k]", "", time()-60);
                                    }
    
                                }

                                for ($k = $nHokenkinCnt; $k >= 0; $k--) {
                                    setcookie("HokenkinId[$k]", $Customer["HokenkinId".$k], $kigen);
                                }

                                //登録デバイス表示処理
                                for ($i = $nTaksCnt; $i >= 0; $i--) {

                                    $id = $Customer["TaksId".$i];
                                    $name = $Customer["AccountFullName"];//仮でアカウント名
                                    $device = $Customer["device".$i];
                                    $maker = $Customer["maker".$i];
                                    $model = $Customer["model".$i];
                                    $number = $Customer["number".$i];
                                    $imei = $Customer["imei".$i];
                                    $amount = $Customer["amount".$i];
                                    $stripeId = $Customer["stripeId".$i];
                                    $customerId = $Customer["cusId".$i];

                                    setcookie("deviceId[$j]", $id, $kigen);
                                    setcookie("stripeId[$j]", $stripeId, $kigen);
                                    setcookie("customerId[$j]", $customerId, $kigen);


                                    //保険金請求状況紐付け処理
                                    $nHokenkinCount = $Customer["HokenkinCount"];
                                    $nHokenkinCount--;
                                    $status = "";
                                    $HokenkinId = "";

                                    for ($k = $nHokenkinCount; $k >= 0; $k--) {


                                        if (!empty($Customer["TaksId_h".$k]) && $id == $Customer["TaksId_h".$k]) {
                                            
                                            $status = $Customer["status".$k];
                                            $AccidentDay = $Customer["AccidentDay".$k];
                                            $DeviceSituation = $Customer["DeviceSituation".$k];
                                            $HokenkinId = $Customer["HokenkinId".$k];
                                        }
                                    }


                                    $j++;

                                    $icon = '';
                                    if ($device === "phone") {
                                        $icon = '/img/Icons1.png';
                                    } else if ($device === "tablet") {
                                        $icon = '/img/Icons2.png';
                                    } else if ($device === "others") {
                                        $icon = '/img/Icons3.png';
                                    }
                            ?>
                            
                                <div class="contract-cont">
                                    <dt class="contract-cont__ttl open">
                                        <div class="subject">
                                            <div class="device-icon-box">
                                                <img src="<?php echo $icon ?> ">
                                            </div>
                                            <div class="subject__ttl" id="subject__ttl">
                                                <h3 class="subject__ttl--device"><?php echo $model;?></h3>
                                                <p class="subject__ttl--name"><?php echo $name;?></p>
                                            </div>
                                            <?php if ($status === "") { ?>
                                                <span class="subject__empty"></span>
                                            <?php }else if ($status === "審査中") { ?>
                                                <span class="subject__judging"><?php echo $status;?></span>
                                            <?php }else if ($status === "支払済み") { ?>
                                                <span class="subject__done"><?php echo $status;?></span>
                                            <?php }else if ($status === "支払不可") { ?>
                                                <span class="subject__impossible"><?php echo $status;?></span>
                                            <?php } ?>
                                            <span class="subject__btn">
                                                <span class="subject__btn--line"></span>
                                            </span>
                                        </div>
                                    </dt>
                                    <dd class="contract-cont__data pulldown">
                                        <div class="data-line"></div>
                                        <div class="data-flex">
                                            <dl class="contract-info">
                                                <dt class="contract-info__item">購入金額</dt>
                                                <dd class="contract-info__value"><?php echo $amount;?>円</dd>
                                                <dt class="contract-info__item">IMEI</dt>
                                                <dd class="contract-info__value"><?php echo $imei;?></dd>
                                                <dt class="contract-info__item">端末は正常に動作しますか</dt>
                                                <dd class="contract-info__value">はい</dd>
                                                <dt class="contract-info__item">端末に外装上の破損</dt>
                                                <dd class="contract-info__value">なし</dd>
                                                <dt class="contract-info__item">端末画面(前面)</dt>
                                                <dd class="contract-info__value"></dd>
                                                <dt class="contract-info__item">端末画面(背面)</dt>
                                                <dd class="contract-info__value"></dd>
                                            </dl>
                                            <dl class="agreement-info">
                                                <p class="agreement-ttl">ご契約情報</p>
                                                <dt class="agreement-info__item">プラン名</dt>
                                                <dd class="agreement-info__value">プランA</dd>
                                                <dt class="agreement-info__item">契約期間</dt>
                                                <dd class="agreement-info__value">2022年12月12日～2022年12月11日</dd>
                                                <dt class="agreement-info__item">次回更新日</dt>
                                                <dd class="agreement-info__value">2023年12月12日</dd>
                                                <dt class="agreement-info__item">申込日</dt>
                                                <dd class="agreement-info__value">2022年12月12日</dd>
                                                <dt class="agreement-info__item">保険料</dt>
                                                <dd class="agreement-info__value">月額500円</dd>
                                                <?php if(!empty($HokenkinId)) { ?>
                                                    <dt class="agreement-info__item">保険金請求履歴</dt>
                                                    <dd class="agreement-info__value">事故発生日時：<?php echo $AccidentDay;?></dd>
                                                    <p class="state">状態：<?php echo $DeviceSituation;?></p>
                                                <?php } ?>
                                            </dl>
                                            <dl class="client-info">
                                                <p class="client-ttl">被保険者情報</p>
                                                <dt class="client-info__item">氏名</dt>
                                                <dd class="client-info__value">{{ $Customer['AccountFullName'] }}</dd>
                                                <dt class="client-info__item">生年月日</dt>
                                                <dd class="client-info__value">{{ $Customer['birthday'] }}</dd>
                                                <dt class="client-info__item">メールアドレス</dt>
                                                <dd class="client-info__value">{{ $Customer['AccountEmail'] }}</dd>
                                                <dt class="client-info__item">郵便番号</dt>
                                                <dd class="client-info__value">{{ $Customer['yuubenbango'] }}</dd>
                                                <dt class="client-info__item">住所</dt>
                                                <dd class="client-info__value">{{ $Customer['Add'] }}</dd>
                                            </dl>
                                        </div>
                                        <div class="link-btng">
                                        @if (Session::has('false'))
                                            <div class="alert alert-error text-center">
                                                <p class="error">{{ Session::get('false') }}</p>
                                            </div>
                                        @elseif (Session::has('true'))
                                            <script>
                                                location.reload();
                                            </script>
                                        @endif
                                        <?php if (empty($HokenkinId)) { ?>
                                            <button class="link-btng__claim"><a href="" class="link-btng__claim--link claim-btn" data-target="<?php echo $id;?>">保険金請求</a></button>
                                        <?php } ?>
                                            <button class="link-btng__terms"><a href="" class="link-btng__terms--link terms-btn" data-target="<?php echo $customerId;?>,<?php echo $id;?>">お支払情報の変更</a></button>
                                            <button class="link-btng__delete"><a href="" class="md-btn" data-target="modal<?php echo $i;?>,<?php echo $id;?>,<?php echo $HokenkinId;?>,<?php echo $stripeId;?>">⊖ デバイスの削除</a></button>
                                                <div id="modal<?php echo $i;?>" class="modal">
                                                    <div class="md-overlay md-close"></div>
                                                    <div class="modal-body">
                                                        <div class="modal-p">
                                                            <p>登録デバイスを削除しますか？</p>
                                                            <p>登録デバイスが削除されます。</p>
                                                        </div>
                                                        <div class="modal-btn">
                                                            <button class="modal-delete"><a href="/deviceDelete">削除する</a></button>
                                                            <button class="md-close">キャンセル</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </dd>
                                </div>


                            <?php } ?>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.2.min.js"integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA="crossorigin="anonymous"></script>
                        <script type="text/javascript">
                            //プルダウンの設定
                            $(".open").on('click', function() {
                                $(this).toggleClass('selected');
                                $(this).next(".pulldown").slideToggle(700);
                            });
                        </script>
                        <!-- 登録デバイス有無判定処理 -->
                        <script type="text/javascript">

                            //HomeControllerから顧客情報取り出し
                            var TaksCount = <?php echo $Customer["TaksCount"];?>;

                            //登録デバイス有無判定
                            if(TaksCount > 0) {
                                document.getElementById("home-m__device-entry").style.display ="none";
                            
                            } else {
                                document.getElementById("contract").style.display ="none";
                            }

                        </script>
                        <script>
                            $(function(){
                                //保険金請求ボタン押下時idをcookieに保存
                                $(".claim-btn").each(function(){
                                    $(this).on('click',function(e){
                                    e.preventDefault();

                                    var target = $(this).data('target');
                                    document.cookie = "Taksid=" + target;
                                    window.location.href = '/claim';

                                    });
                                });
                            });
                        </script>
                        <script>
                            $(function(){
                                //お支払い変更ボタン押下時idをcookieに保存
                                $(".terms-btn").each(function(){
                                    $(this).on('click',function(e){
                                    e.preventDefault();

                                    var target = $(this).data('target');
                                    const itemData = target.split(',');
                                    var customerid = itemData[0];
                                    var Taksid = itemData[1];
                                    document.cookie = "customerid=" + customerid;
                                    document.cookie = "Taksid=" + Taksid;
                                    window.location.href = '/changepayment';

                                    });
                                });
                            });
                        </script>
                        <script>
                            //デバイス削除モーダルウインドウ
                            $(function(){
                                var scrollPosition;

                                $(".md-btn").each(function(){
                                    $(this).on('click',function(e){
                                    e.preventDefault();
                                    scrollPosition = $(window).scrollTop();
                                    $('body').addClass('fixed').css({'top': -scrollPosition});
                                    var target = $(this).data('target');

                                    const itemData = target.split(',');
                                    var modalid = itemData[0];
                                    var Taksid = itemData[1];
                                    var HokenkinId = itemData[2];
                                    var stripeId = itemData[3];
                                    document.cookie = "Taksid=" + Taksid;
                                    document.cookie = "stripeid=" + stripeId;

                                    if (HokenkinId) {
                                        document.cookie = "Hokenkinid=" + HokenkinId;
                                    } else {
                                        document.cookie = "Hokenkinid=" + "";
                                    }
                                    
                                    var modal = document.getElementById(modalid);
                                    $(modal).find('.md-overlay,.modal-body').fadeIn();
                                    });
                                });
                                $('.md-close').on('click',function(){
                                    $('body').removeClass('fixed');
                                    window.scrollTo( 0 , scrollPosition );
                                    $('.md-overlay,.modal-body').fadeOut();
                                });
                            });
                        </script>
                        <div class="contract-plas">
                            <button class="contract-plas__btn"><a href="{{url('/device-entry')}}" class="contract-plas__btn--link">⊕ デバイスを追加する</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            @include('footer')
        </footer>
    </body>
</html>