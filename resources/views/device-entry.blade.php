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
            <div class="device-entry">
                <h2 class="device-entry__ttl">デバイス登録</h2>
                <h3 class="device-entry__ttl02">デバイス情報</h3>
                <img src="{{asset('/img/device/progress.png')}}" class="device-entry__img">
                <p class="device-entry__text">項目を入力し、確認ボタンを押してください。</p>

                <form class="entry-form" action="{{url('/devicecheck')}}" method="POST" name="entry_form" enctype="multipart/form-data">
                {{ csrf_field() }}
               
                    <h3 class="entry-form__ttl">デバイス情報入力</h3>
                    <dt class="entry-form__dt">主端末</dt>
                    <div class="err-msg-device"></div>
                    <dd class="entry-form__dd">
                        <ul class="entry-form__list entry">
                            <li class="entry-form__list--item">
                                <input type="radio" name="device" id="phone" class="entry-form__list--radio" checked>
                                <label for="phone" class="entry-form__list--label">スマートフォン</label>
                            </li>
                            <li class="entry-form__list--item">
                                <input type="radio" name="device" id="tablet" class="entry-form__list--radio">
                                <label for="tablet" class="entry-form__list--label">タブレット</label>
                            </li>
                            <li class="entry-form__list--item">
                                <input type="radio" name="device" id="others" class="entry-form__list--radio">
                                <label for="others" class="entry-form__list--label">ノートパソコン</label>
                            </li>
                        </ul>
                    </dd>
                    <dt class="entry-form__dt">
                        <label for="maker">メーカー</label>
                        <div class="required-box">必須</div>
                    </dt>
                    <dd class="entry-form__dd">
                        <input type="text" name="maker" id="maker" class="entry-form__dd--input" placeholder="入力してください" autofocus required>
                        <div class="err-msg-maker"></div>
                    </dd>
                    <dt class="entry-form__dt">
                        <label for="model">機種</label>
                        <div class="any-box">任意</div>
                    </dt>
                    <dd class="entry-form__dd">
                        <input type="text" name="model" id="model" class="entry-form__dd--input" placeholder="入力してください" autofocus required>
                        <div class="err-msg-model"></div>
                    </dd>
                    <dt class="entry-form__dt"><label for="number">シリアル番号</label></dt>
                    <dd class="entry-form__dd">
                        <input type="text" name="number" id="number" class="entry-form__dd--input" placeholder="入力してください" autofocus required>
                        <div class="err-msg-number"></div>
                    </dd>
                    <dt class="entry-form__dt"><label for="imei">IMEI</label></dt>
                    <dd class="entry-form__dd">
                        <input type="text" name="imei" id="imei" class="entry-form__dd--input" placeholder="入力してください" autofocus required>
                        <div class="err-msg-imei"></div>
                    </dd>
                    <dt class="entry-form__dt"><label for="capacity">容量</label></dt>
                    <dd class="entry-form__dd">
                        <input type="text" name="capacity" id="capacity" class="entry-form__dd--input" placeholder="入力してください" autofocus required>
                        <div class="err-msg-capacity"></div>
                    </dd>
                    <dt class="entry-form__dt"><label for="purchase">購入日</label></dt>
                    <dd class="entry-form__dd">
                        <input type="date" name="purchase" id="purchase" min="1000-01-01" max="9999-12-31" class="entry-form__dd--input" placeholder="入力してください" autofocus required>
                        <div class="err-msg-purchase"></div>
                    </dd>
                    <dt class="entry-form__dt"><label for="amount">購入金額</label></dt>
                    <dd class="entry-form__dd">
                        <input type="text" name="amount" id="amount" class="entry-form__dd--input" placeholder="入力してください" autofocus required>
                        <div class="err-msg-amount"></div>
                    </dd>
                    <dt class="entry-form__dt"><label for="career">キャリア</label></dt>
                    <dd class="entry-form__dd"><input type="text" name="career" id="career" class="entry-form__dd--input" placeholder="入力してください" autofocus required>
                        <div class="err-msg-career"></div>
                    </dd>
                    <p class="entry-form__text">
                        ダミー文章
                    </p>
                    <div class="entry-form__block">
                        <dt class="entry-form__dt"><label for="device-img1">端末画像(前面)</label></dt>
                        <dd class="entry-form__dd">
                            <div id="preview1"></div>
                            <input type="file" name="device-img1" id="device-img1" capture="environment" onChange="imgPreView(event, 'preview1', 'device-img-button1')" style="display: none" accept="image/*" autofocus required>
                            <input type="button" id="device-img-button1" class="entry-form__block--btn" value="端末画像のアップロード">
                            <div class="err-msg-device-img1"></div>
                        </dd>
                        <dt class="entry-form__dt"><label for="device-img2">端末画像(背面)</label></dt>
                        <dd class="entry-form__dd">
                            <div id="preview2"></div>
                            <input type="file" name="device-img2" id="device-img2" capture="environment" onChange="imgPreView(event, 'preview2', 'device-img-button2')" style="display: none" accept="image/*" autofocus required>
                            <input type="button" id="device-img-button2"  class="entry-form__block--btn" value="端末画像のアップロード">
                            <div class="err-msg-device-img2"></div>
                        </dd>
                    </div>
                    <input type="submit" name="submit" value="入力内容確認" onclick="OnDeviceEntryButtonClick();" class="entry-form__submit" id="entry-submit">
                </form>
            </div>
        </main>
        <footer>
            @include('footer')
        </footer>
        <script>
            //ファイルアップロードボタン
            var file1 = document.getElementById( 'device-img1' );
            var file2 = document.getElementById( 'device-img2' );
            var button1 = document.getElementById( 'device-img-button1' );
            var button2 = document.getElementById( 'device-img-button2' );


            button1.onclick = function()
            {
                // type="file"要素のclickイベントを発生させる
                file1.click();
            }

            button2.onclick = function()
            {
                // type="file"要素のclickイベントを発生させる
                file2.click();
            }

            //プレビュー
            function imgPreView(event, targetId, btnId) {
            var file = event.target.files[0];
            var reader = new FileReader();
            var preview = document.getElementById(targetId);
            var previewImage = document.getElementById("previewImage-"+targetId);
            var btn = document.getElementById(btnId);

            
            reader.onload = function(event) {
                    
                if(previewImage != null) {
                    preview.removeChild(previewImage);
                }

                var img = document.createElement("img");
                img.setAttribute("src", reader.result);
                img.setAttribute("id", "previewImage-"+targetId);
                img.setAttribute("width", "300px");
                preview.appendChild(img);
            };

            btn.value = '端末画像の変更';
            
            reader.readAsDataURL(file);
            }
        </script>
        <script language="javascript" type="text/javascript">
            function OnDeviceEntryButtonClick() {
                document.cookie = 'device_phone=' + document.forms[0].elements[1].checked;
                document.cookie = 'device_tablet=' + document.forms[0].elements[2].checked;
                document.cookie = 'device_others=' + document.forms[0].elements[3].checked;
                document.cookie = 'maker=' + document.forms[0].elements[4].value;
                document.cookie = 'model=' + document.forms[0].elements[5].value;
                document.cookie = 'number=' + document.forms[0].elements[6].value;
                document.cookie = 'imei=' + document.forms[0].elements[7].value;
                document.cookie = 'capacity=' + document.forms[0].elements[8].value;
                document.cookie = 'purchase=' + document.forms[0].elements[9].value;
                document.cookie = 'amount=' + document.forms[0].elements[10].value;
                document.cookie = 'career=' + document.forms[0].elements[11].value;
                document.cookie = 'img_front=' + document.forms[0].elements[12].files[0];
                document.cookie = 'img_back=' + document.forms[0].elements[14].files[0];

            }
        </script>
        <script src="{{ asset('/js/device_entry_valid.js') }}"></script>
        </body>
</html>