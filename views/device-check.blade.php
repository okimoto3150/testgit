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
        <?php
        $up_file1 = "";
        $up_file2 = "";
        $up_ok = false;
        $tmp_file1 = isset($_FILES["device-img1"]["tmp_name"]) ? $_FILES["device-img1"]["tmp_name"] : "";
        $org_file1 = isset($_FILES["device-img1"]["name"])     ? $_FILES["device-img1"]["name"]     : "";
        $tmp_file2 = isset($_FILES["device-img2"]["tmp_name"]) ? $_FILES["device-img2"]["tmp_name"] : "";
        $org_file2 = isset($_FILES["device-img2"]["name"])     ? $_FILES["device-img2"]["name"]     : "";


        if( $tmp_file1 != "" &&
        is_uploaded_file($tmp_file1) &&
        is_uploaded_file($tmp_file2))
        {
        $split1 = explode('.', $org_file1); 
        $ext1 = end($split1);
        $split2 = explode('.', $org_file2); 
        $ext2 = end($split2);
        if( $ext1 != "" &&
            $ext1 != $org_file1  )
        {
        $up_file1 = "./img/". date("Ymd_His.") . mt_rand(1000,9999) . ".$ext1";
        $up_file2 = "./img/". date("Ymd_His.") . mt_rand(1000,9999) . ".$ext2";

        move_uploaded_file( $tmp_file1, $up_file1);
        move_uploaded_file( $tmp_file2, $up_file2);
        }
        }
        ?>
            <div class="device-check">
                <h2 class="device-check__ttl">デバイス登録</h2>
                <h3 class="device-check__ttl02">デバイス情報</h3>
                <img src="{{asset('/img/device/progress-check.png')}}" class="device-check__img">
                <p class="device-check__text">入力内容に間違いがないか確認し、問題が無ければ送信ボタンを押してください。</p>
                <section class="check-table">
                    <h3 class="check-table__ttl">デバイス情報内容確認</h3>
                    <dl class="check-table__list">
                        <div class="check-left">
                            <div class="check-table__list--grup">
                                <dt class="check-table__list--dt">主端末</dt>
                                <p class="check-table__list--dd" id="device"></p>
                            </div>
                            <div class="check-table__list--grup">
                                <dt class="check-table__list--dt">メーカー</dt>
                                <p class="check-table__list--dd" id="maker"></p>
                            </div>
                            <div class="check-table__list--grup">
                                <dt class="check-table__list--dt">機種</dt>
                                <p class="check-table__list--dd" id="model"></p>
                            </div>
                            <div class="check-table__list--grup">
                                <dt class="check-table__list--dt">シリアル番号</dt>
                                <p class="check-table__list--dd" id="number"></p>
                            </div>
                            <div class="check-table__list--grup">
                            <dt class="check-table__list--dt">IMEI</dt>
                            <p class="check-table__list--dd" id="imei"></p>
                            </div>
                            <div class="check-table__list--grup">
                                <dt class="check-table__list--dt">容量</dt>
                                <p class="check-table__list--dd" id="capacity"></p>
                            </div>
                            <div class="check-table__list--grup">
                                <dt class="check-table__list--dt">購入日</dt>
                                <p class="check-table__list--dd" id="purchase"></p>
                            </div>
                            <div class="check-table__list--grup">
                                <dt class="check-table__list--dt">購入金額</dt>
                                <p class="check-table__list--dd" id="amount"></p>
                            </div>
                        </div>
                        <div class="check-right">
                            <div class="check-table__list--grup">
                                <dt class="check-table__list--dt">キャリア</dt>
                                <p class="check-table__list--dd" id="career"></p>
                            </div>
                            <dt class="check-table__list--dt">端末画像(前面)</dt>
                            <dd class="check-table__list--dd">
                                <img src="<?= $up_file1 ?>">
                            </dd>
                            <dt class="check-table__list--dt">端末画像(背面)</dt>
                            <dd class="check-table__list--dd">
                                <img src="<?= $up_file2 ?>">
                            </dd>
                        </div>
                    </dl>
                        <!--<button class="check-table__block--next"><a href="{{ route('device.post') }}">送信する</a></button>-->
                        <!--<div class="check-table__block">
                        <button class="check-table__block--return" onclick="history.go(-1);">修正する</button>
                            <form action="/devicePost" method="post" enctype="multipart/form-data">
                        @csrf
                                <input class="check-table__block--next" type="submit" value="送信する">
                            </form>
                    </div>-->
                    <div class="check-table__block">
                        <button class="check-table__block--return" onclick="history.go(-1);">修正する</button>
                        <button class="check-table__block--next"><a href="{{url('/device-checkout')}}" class="next-link">送信する</a></button>
                    </div>
                </section>
            </div>
        </main>
        <footer>
            @include('footer')
        </footer>
        <script type="text/javascript">
            var cookies = document.cookie;
            var cookieItem = cookies.split(";");
            var cookieArray = new Array();
            for (i = 0; i < cookieItem.length; i++) {
                cookieItem[i] = cookieItem[i].trim();
                var elem = cookieItem[i].split("=");
                cookieArray[elem[0]] = decodeURIComponent(elem[1]);
            }
            
            if(cookieArray["device_phone"] == "true") {
                const device = document.getElementById('device');
                device.textContent = "スマートフォン";
                document.cookie = 'device=phone';
            } else if(cookieArray["device_tablet"] == "true") {
                const device = document.getElementById('device');
                device.textContent = "タブレット";
                document.cookie = 'device=tablet';
            } else if(cookieArray["device_others"] == "true") {
                const device = document.getElementById('device');
                device.textContent = "ノートパソコン";
                document.cookie = 'device=others';

            }

            const maker = document.getElementById('maker');
            maker.textContent = cookieArray["maker"];
            const model = document.getElementById('model');
            model.textContent = cookieArray["model"];
            const number = document.getElementById('number');
            number.textContent = cookieArray["number"];
            const imei = document.getElementById('imei');
            imei.textContent = cookieArray["imei"];
            const capacity = document.getElementById('capacity');
            capacity.textContent = cookieArray["capacity"];
            const purchase = document.getElementById('purchase');
            purchase.textContent = cookieArray["purchase"];
            const amount = document.getElementById('amount');
            amount.textContent = cookieArray["amount"];
            const career = document.getElementById('career');
            career.textContent = cookieArray["career"];
        </script>
    </body>
</html>