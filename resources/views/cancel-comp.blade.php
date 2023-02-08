<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>デバイス保険</title>
        <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
        <link rel="stylesheet" href="{{asset('css/cancel-comp.css')}}">
    </head>
    <body>
        <header>
            @include('header')
        </header>
        <main>
            <div class="m-wrap">
                <section>
                    <div class="cancel-img">
                        <img src="{{asset('/img/cancel.png')}}">
                    </div>
                    <h2>解約手続き完了</h2>
                    <div class="cancel-comp-text">
                        <p>正常に退会処理が完了しました。</p>
                        <p>ご利用ありがとうございました。</p>
                    </div>
                    <div class="top-btn-box">
                        <button class="top-btn"><a href="/">トップページへ</a></button>
                    </div>
                </section>
            </div>
        </main>
    </body>
</html>