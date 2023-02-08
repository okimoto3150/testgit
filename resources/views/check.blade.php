<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>デバイス保険</title>
        <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
        <link rel="stylesheet" href="{{asset('css/check.css')}}">
    </head>
    <body>
        <header>
            @include('header')
        </header>
        <main>
            <div class="check">
                <h2 class="check__ttl">新規入会</h2>
                <h3 class="check__ttl02">お申し込み</h3>
                <img src="{{asset('/img/Progress-check.png')}}" class="check__img">
                <p class="check__text">入力内容に間違いがないか確認し、問題が無ければ送信ボタンを押してください。</p>
                <section class="plan">
                    <h3 class="plan__ttl">お申し込み内容確認</h3>
                    <div class="flex-box">
                        <div class="plan__group">
                            <dt class="plan__group--ttl">プラン名</dt>
                            <dd class="plan__group--data">デバイス保険</dd>
                        </div>
                        <div class="plan__group">
                            <dt class="plan__group--ttl">保険金額</dt>
                            <dd class="plan__group--data">100,000円</dd>
                        </div>
                    </div>
                    <div class="plan__group">
                        <dt class="plan__group--ttl">月払保険料</dt>
                        <dd class="plan__group--data">500円</dd>
                    </div>
                </section>
                <section class="user-info">
                    <h3 class="user-info__ttl">ご契約情報</h3>
                    <dl class="user-info__list">
                        <div class="flex-box">
                            <div class="user-info__list--group">
                                <dt class="user-info__list--ttl">氏名</dt>
                                <p class="user-info__list--data" id="user_name"></p>
                            </div>
                            <div class="user-info__list--group">
                                <dt class="user-info__list--ttl">氏名（フリガナ）</dt>
                                <p class="user-info__list--data" id="user_kana"></p>
                            </div>
                        </div>
                        <div class="flex-box">
                            <div class="user-info__list--group">
                                <dt class="user-info__list--ttl">生年月日</dt>
                                <p class="user-info__list--data"  id="user_birthday"></p>
                            </div>
                            <div class="user-info__list--group">
                                <dt class="user-info__list--ttl">メールアドレス</dt>
                                <p class="user-info__list--data" id="user_email"></p>
                            </div>
                        </div>
                        <div class="flex-box">
                            <div class="user-info__list--group">
                                <dt class="user-info__list--ttl">電話番号</dt>
                                <p class="user-info__list--data" id="user_phone"></p>
                            </div>
                            <div class="user-info__list--group">
                                <dt class="user-info__list--ttl">郵便番号</dt>
                                <div class="flex-box-yuben">
                                    <span>〒</span><p class="user-info__list--data" id="user_zip_code"></p>
                                </div>
                            </div>
                        </div>
                        <div class="user-info__list--group">
                            <dt class="user-info__list--ttl">住所</dt>
                            <p class="user-info__list--data" id="user_add"></p>
                        </div>
                    </dl>
                    <div class="user-info__flex">
                        <button class="user-info__btn" onclick="history.go(-1);">修正する</button>
                        <button class="user-info__return"><a href="{{url('/checkout')}}" class="user-info__return--link">送信する</a></button>
                    </div>
                    
                </section>
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

            const name = document.getElementById('user_name');
            name.textContent = cookieArray["fname"] + "　" + cookieArray["lname"];
            const kana = document.getElementById('user_kana');
            kana.textContent = cookieArray["fnamekana"] + "　" + cookieArray["lnamekana"];
            const birthday = document.getElementById('user_birthday');
            birthday.textContent = cookieArray["birthday"];
            const email = document.getElementById('user_email');
            email.textContent = cookieArray["email"];
            const phone = document.getElementById('user_phone');
            phone.textContent = cookieArray["phone"];
            const zip_code = document.getElementById('user_zip_code');
            zip_code.textContent = cookieArray["zip_code"];
            const address = document.getElementById('user_add');
            //address.textContent = cookieArray["state"] + cookieArray["city"] + cookieArray["line1"] + cookieArray["line2"];
            address.textContent = cookieArray["state"] + cookieArray["city"] + cookieArray["line2"];

        </script>

        <!--<script src="{{ asset('/js/cookie_output.js') }}"></script>-->
    </body>
</html>