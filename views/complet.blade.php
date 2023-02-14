<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>デバイス保険</title>
        <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
        <link rel="stylesheet" href="{{asset('css/comp.css')}}">
    </head>
    <body>
        <header>
            @include('header')
        </header>
        <main>
            <div class="complet">
                <h2 class="complet__ttl">新規入会</h2>
                <h3 class="complet__ttl02">お申し込み</h3>
                <img src="{{asset('/img/Progress-comp.png')}}" class="complet__img">
                <p class="complet__text">
                    新規入会依頼を送信しました。ご登録のメールアドレス宛にメールを送信いたしましたので、メール記載のURLよりパスワードの設定をお願いいたします。<br><br>
                    パスワードの設定後に続けて端末のご登録が可能です。端末の登録にお進みになる場合にはマイページトップより「デバイスを登録する」ボタンを押してください。
                </p>
                <!--<div class="btn-group">
                    <button class="btn-group__next"><a href="" class="btn-group__next--link">このまま端末登録をする</a></button>
                    <button class="btn-group__later"><a href="" class="btn-group__later--link">後で登録する</a></button>
                </div>-->
            </div>
        </main>
        <footer>
            @include('footer')
        </footer>
    </body>
</html>

