<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>デバイス保険</title>
        <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
        <link rel="stylesheet" href="{{asset('css/device.css')}}">
    </head>
    <body>
        <header>
            @include('device-header')
        </header>
        <main>
            <div class="device-comp">
            <h2 class="device-comp__ttl">デバイス登録</h2>
                <h3 class="device-comp__ttl02">デバイス情報</h3>
                <img src="{{asset('/img/device/progress-comp.png')}}" class="device-comp__img">
                <p class="device-comp__text">端末情報を送信しました。</p>
                <button class="device-comp__btn"><a href="{{url('/home')}}" class="device-comp__btn--link">トップへ戻る</a></button>
            </div>
        </main>
        <footer>
            @include('footer')
        </footer>
    </body>
</html>