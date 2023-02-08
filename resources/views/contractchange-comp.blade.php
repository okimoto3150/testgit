<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('css/contractchange-comp.css')}}">
    <title>デバイス保険</title>
</head>
<body>
    <header>
        @include('header')
    </header>
    <main>
        <section>
            <div class="complet">
                <h2 class="complet__ttl">マイページ</h2>
                <p class="complet__ttl02">契約者情報変更</p>
                <p class="complet__text">
                    契約書情報の変更が完了しました。
                </p>
                <button class="complet__btn"><a href="{{url('/home')}}" class="complet__btn--link">トップへ戻る</a></button>
            </div>
        </section>
    </main>
    <footer>
        @include('footer')
    </footer>
</body>
</html>