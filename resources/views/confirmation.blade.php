<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>デバイス保険</title>
        <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
        <link rel="stylesheet" href="{{asset('css/confirmation.css')}}">
    </head>
    <body>
        <header>
            @include('claim-header')
        </header>
        <main>
            <div class="m-wrap">
                <div class="m">
                    <div class="m__name">
                        <p><?php echo $_COOKIE[ 'name' ]; ?></p><span>　さん</span>
                    </div>
                    <h2 class="m__ttl">マイページ</h2>
                    <section class="m__claim">
                        <h3 class="m__claim--ttl">保険金の請求</h3>
                        <img src="{{asset('img/claim/Progress4.png')}}" alt="入力" class="m__claim--step">
                        <p class="m__claim--text">入力内容に間違いがないか確認し、問題なければ確定ボタンを押してください。</p>
                    </section>
                    <section class="m__contract">
                        <h3 class="m__contract--ttl">ご契約情報</h3>
                        <dl class="m__contract--list">
                            <dt class="m__contract--item">保険番号</dt>
                            <dd class="m__contract--data">1234567812345678</dd>
                        </dl>
                        <button class="m__contract--check"><a href="" class="m__contract--link">契約内容確認</a></button>
                    </section>
                    <!--<form class="order-form">-->
                    <section>
                        <h3 class="m__order--ttl">保険金請求依頼</h3>
                        <dl class="m__order">
                            <div class="flex-box">
                                <div class="order-left">
                                    <dt class="m__order--item">事故区分</dt>
                                    <dd class="m__order--data" id="flag"></dd>
                                    <dt class="m__order--item">修理可否</dt>
                                    <dd class="m__order--data" id="check"></dd>
                                    <dt class="m__order--item">事故発生日時</dt>
                                    <dd class="m__order--data" id="acc_date"></dd>
                                    <dt class="m__order--item">事故対象者</dt>
                                    <dd class="m__order--data" id="acc_name"></dd>
                                    <dt class="m__order--item">事故発生場所</dt>
                                    <dd class="m__order--data" id="acc_place"></dd>
                                    <dd class="m__order--data" id="acc_add="></dd>
                                    <dt class="m__order--item">事故発生の状況</dt>
                                    <dd class="m__order--data"><?php echo $_COOKIE['acc_status']; ?></dd>
                                    <dt class="m__order--item">事故後の端末の状態</dt>
                                    <dd class="m__order--data"><?php echo $_COOKIE['acc_condition']; ?></dd>
                                </div>
                                <?php if ($_COOKIE['flag'] === "故障" || $_COOKIE['flag'] === "水濡れ") { ?>
                                    <div class="order-right">
                                        <dt class="m__order--item">端末画像(前面)</dt>
                                        <dd class="m__order--data"></dd>
                                        <dt class="m__order--item">端末画像(背面)</dt>
                                        <dd class="m__order--data"></dd>
                                        <dt class="m__order--item">事故端末の写真が添付できない場合の理由</dt>
                                        <dd class="m__order--data"><?php echo $_COOKIE['acc_messe']; ?></dd>
                                    </div>
                                <?php } else { ?>
                                    <div class="order-right">
                                        <dt class="m__order--item">盗難届or遺失届</dt>
                                        <dd class="m__order--data"></dd>
                                        <dt class="m__order--item">再購入証明書</dt>
                                        <dd class="m__order--data"></dd>
                                        <dt class="m__order--item">書類の写真が送付できない場合の理由</dt>
                                        <dd class="m__order--data"><?php echo $_COOKIE['acc_messe2']; ?></dd>
                                    </div>
                                <?php } ?>
                            </div>
                            @if (Session::has('error'))
                            <div class="alert alert-error text-center">
                                <p class="error">{{ Session::get('error') }}</p>
                            </div>
                            @endif
                            <div class="order-btng">
                                <button class="order-btng__fix" onclick="history.go(-1);">修正する</button>
                                <form action="/claimPost" method="post">
                                    @csrf
                                    <input class="order-btng__submit" type="submit" value="送信する">
                                </form>
                            </div>

                        </dl>
                    </section>
                    <!--</form>-->
                </div>
            </div>
        </main>
        <footer>
            @include('footer')
        </footer>
        <script type="text/javascript">
            var cookies = document.cookie;
            var cookieItem = cookies.split(";");
            var cookieArray = new Array();
            for (i = 0; i < cookieItem.length; i++) {
                cookieItem[i] = cookieItem[i].trim();
                var elem = cookieItem[i].split("=");
                cookieArray[elem[0]] = decodeURIComponent(elem[1]);
            }

            const flag = document.getElementById('flag');
            flag.textContent = cookieArray["flag"];
            const check = document.getElementById('check');
            check.textContent = cookieArray["check"];
            const acc_date = document.getElementById('acc_date');
            acc_date.textContent = cookieArray["acc_date"];
            const acc_name = document.getElementById('acc_name');
            acc_name.textContent = cookieArray["acc_name"];
            const acc_place = document.getElementById('acc_place');
            acc_place.textContent = cookieArray["acc_place"];
            const acc_add = document.getElementById('acc_add');
            acc_add.textContent = cookieArray["acc_add"];


        </script>

    </body>
</html>