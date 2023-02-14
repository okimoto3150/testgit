<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('css/contractchange-check.css')}}">
    <title>デバイス保険</title>
</head>
<body>
    <header>
        @include('header')
    </header>
    <main>
        <section>
            <div class="check">
                <h2 class="check__ttl">マイページ</h2>
                <p class="check__ttl02">契約者情報変更</p>
                <p class="check__text">入力内容に間違いがないか確認し、問題が無ければ送信ボタンを押してください。</p>
                <dl class="check-info__list">
                    <div class="flex-box">
                        <div class="check-info__list--group">
                            <dt class="check-info__list--ttl">氏名</dt>
                            <p class="check-info__list--data" id="user_name"></p>
                        </div>
                        <div class="check-info__list--group">
                            <dt class="check-info__list--ttl">氏名（フリガナ）</dt>
                            <p class="check-info__list--data" id="user_kana"></p>
                        </div>
                    </div>
                    <div class="flex-box">
                        <div class="check-info__list--group">
                            <dt class="check-info__list--ttl">生年月日</dt>
                            <p class="check-info__list--data"  id="user_birthday"></p>
                        </div>
                        <div class="check-info__list--group">
                            <dt class="check-info__list--ttl">メールアドレス</dt>
                            <p class="check-info__list--data" id="user_email"></p>
                        </div>
                    </div>
                    <div class="flex-box">
                        <div class="check-info__list--group">
                            <dt class="check-info__list--ttl">電話番号</dt>
                            <p class="check-info__list--data" id="user_phone"></p>
                        </div>
                        <div class="check-info__list--group">
                            <dt class="check-info__list--ttl">郵便番号</dt>
                            <div class="flex-box-yuben">
                                <span>〒</span><p class="check-info__list--data" id="user_zip_code"></p>
                            </div>
                        </div>
                    </div>
                    <div class="check-info__list--group">
                        <dt class="check-info__list--ttl">住所</dt>
                        <p class="check-info__list--data" id="user_add"></p>
                    </div>
                </dl>
                @if (Session::has('error'))
                    <div class="alert alert-error text-center">
                        <p class="error">{{ Session::get('error') }}</p>
                    </div>
                @endif
                <div class="check-info__flex">
                <button class="check-info__btn" onclick="history.go(-1);">修正する</button>
                <form action="/chengePost" method="post">
                    @csrf
                    <input class="check-info__return" type="submit" value="送信する">
                </form>
                </div>
            </div>
        </section>
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

</body>
</html>