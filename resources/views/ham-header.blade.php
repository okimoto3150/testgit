<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/ham-header.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA="crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="h-wrap">
            <div class="h">
                <h1 class="h__logo"><a href="/"><img src="{{asset('/img/top/top-logo.png')}}"></a></h1>       
                <div class="h__ham">
                    <span class="h__ham--line"></span> <span class="h__ham--line"></span> <span class="h__ham--line"></span></div>
                </div>
            </div>
        </div>
    </header>
    <nav class="nav">
        <ul class="nav__list">
            <li class="nav__list--item"><a href="" class="nav__list--link">マイページトップ</a></li>
            <li class="nav__list--item"><a href="/device-entry" class="nav__list--link">対象デバイスの追加・変更</a></li>
            <li class="nav__list--item"><a href="" class="nav__list--link">保険の解約</a></li>
            <li class="nav__list--item"><a href="/terms" class="nav__list--link">利用規約</a></li>
            <li class="nav__list--item"><a href="/privacypolicy" class="nav__list--link">プライバシーポリシー</a></li>
            <li class="nav__list--item"><a href="/logout" class="nav__list--link">ログアウト</a></li>
        </ul>
    </nav>
</body>
<script>
$(".h__ham").click(function () {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
            $('.nav').addClass('active');
        } else {
            $('.nav').removeClass('active');
        }
});
</script>
</html>
