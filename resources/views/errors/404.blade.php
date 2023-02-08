@extends('errors::minimal')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>デバイス保険</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/404.css')}}">
</head>
<body>
    <header>
        @include('header')
    </header>
    <main>
        <div class="error">
            <div class="image"><img src="{{asset('img/404.png')}}"></div>
            <h2 class="error__ttl">404</h2>
            <p class="error__text">ページが見つかりません。お探しのページは移動さえれたか削除された可能性があります。</p>
            <button class="error__btn"><a href="{{route('home')}}" class="error__btn--link">トップページへ</a></button>
        </div>
    </main>
</body>
</html>

