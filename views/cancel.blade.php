<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>デバイス保険</title>
        <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
        <link rel="stylesheet" href="{{asset('css/cancel.css')}}">
    </head>
    <body>
        <header>
            @include('claim-header')
        </header>
        <main>
            <div class="m-wrap">
                <p class="name"><?php echo $_COOKIE[ 'name' ]; ?>  さん</p>
                <section>
                    <h2>解約手続きを実行します。</h2>
                    <div class="cancel-text">
                        <p>下記ボタンを押すと退会になります。</p>
                        <p>お客様情報は<span>すべて解除</span>されますが、よろしいでしょうか？</p>
                    </div>
                    <div class="cancel-btn-box">
                        <button class="cancel-btn"><a href="/AccountCancel">はい、解約します。</a></button>
                        <button class="return-btn" onclick="history.go(-1);">いいえ、解約しません。</button>
                    </div>
                </section>
            </div>
        </main>
        <footer>
            @include('footer')
        </footer>
    </body>
</html>