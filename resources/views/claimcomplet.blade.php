<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>デバイス保険</title>
        <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
        <link rel="stylesheet" href="{{asset('css/claimcomplet.css')}}">
    </head>
    <body>
        <header>
            @include('claim-header')
        </header>
        <main>
            <div class="complet">
                <div class="complet__name">
                        <p><?php echo $_COOKIE[ 'name' ]; ?></p><span>　さん</span>
                    </div>
                <h2 class="complet__ttl">マイページ</h2>
                <h3 class="complet__ttl02">保険金の請求</h3>
                <img src="{{asset('img/claim/Progress5.png')}}" class="complet__img">
                <p class="complet__text">
                    保険金請求依頼を送信しました。内容確認後、担当者よりご連絡申し上げます。
                </p>
                <!--<div class="btn-group">
                    <button class="btn-group__next"><a href="" class="btn-group__next--link">このまま端末登録をする</a></button>
                    <button class="btn-group__later"><a href="" class="btn-group__later--link">後で登録する</a></button>
                </div>-->
                <button class="claimcomp__btn"><a href="{{url('/home')}}" class="claimcomp__btn--link">トップへ戻る</a></button>
            </div>
        </main>
        <footer>
            @include('footer')
        </footer>
    </body>
</html>