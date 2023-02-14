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
                <h2 class="complet__ttl">デバイス登録</h2>
                <h3 class="complet__ttl02">支払変更</h3>
                <p class="complet__text">
                    お支払い方法の変更が完了しました。
                </p>
                <div class="complet__bun-box">
                    <button class="complet__btn"><a href="{{url('/home')}}" class="complet__btn--link">トップへ戻る</a></button>
                </div>
            </div>
        </main>
        <footer>
            @include('footer')
        </footer>
    </body>
</html>

