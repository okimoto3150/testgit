<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('/css/footer.css')}}">
</head>
<body> 
    <div class="footer">
        <div class="footer-box">
            <div class="footer-logo"><p>デバイス保険</p></div>
            <ul>
                <li><a href="{{url('/privacypolicy')}}">プライバシーポリシー</a><span>></span></li>
                <li><a href="{{url('/terms')}}">約款</a><span>></span></li>
                <li><a href="" class="coporate">コーポレートサイト</a><span>></span></li>
            </ul>
            <p class="copyright"><small>Copyright 2022- Device HOKEN., LTD. ALL RIGHTS RESERVED.</small></p>
        </div>
        <!--<p class="footer__text"><small>© digital SSI Co.Ltd.All rights reserved.</small></p>-->
    </div>
</body>
</html>