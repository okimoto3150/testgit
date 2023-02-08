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
    <link rel="stylesheet" href="{{asset('/css/device-header.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA="crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="h-wrap">
            <div class="h">
                <div class="flex-box">
                    <h1 class="h__logo"><a href="/"><img src="{{asset('/img/top/top-logo.png')}}"></a></h1>
                    <div class="logout"><a href="/logout">ログアウト</a></div>
                </div>
                <div class="link-box">
                    <a href="{{url('/home')}}">
                        <div class="mypage-link">
                            <div class="link-inner">
                                <div class="mypage-img">
                                    <img src="{{asset('img/device/mypage.png')}}">
                                </div>
                            <p>マイページトップ</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{url('/device-entry')}}">
                        <div class="device-link">
                            <div class="link-inner">
                                <div class="device-img">
                                    <img src="{{asset('img/device/phone.png')}}">
                                </div>
                                <p>対象デバイスの追加</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="link-box-sp">
                    <a href="{{url('/home')}}">
                        <div class="mypage-link">
                            <div class="link-inner">
                                <div class="mypage-img">
                                    <img src="{{asset('img/device/mypage-sp.png')}}">
                                </div>
                            <p>マイページトップ</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{url('/device-entry')}}">
                        <div class="device-link">
                            <div class="link-inner">
                                <div class="device-img">
                                    <img src="{{asset('img/device/phone-sp.png')}}">
                                </div>
                                <p>対象デバイスの追加</p>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </header>
</body>
</html>
