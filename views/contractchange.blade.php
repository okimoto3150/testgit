<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('css/contractchange.css')}}">
    <title>デバイス保険</title>
</head>
<body>
    <header>
        @include('header')
    </header>
    <main>
        <section>
            <div class="contractchange">
                <h2 class="contractchange__ttl">マイページ</h2>
                <p class="contractchange__ttl02">契約者情報変更</p>
                <p class="contractchange__text">項目を入力し「次へ」ボタンを押してください。</p>
                <form action="{{url('/contractchangecheck')}}" method="post" class="contractchange-form">
                    @csrf
                    <dl class="contractchange-form__dl">
                        <dt class="contractchange-form__dt">
                            <label class="contractchange-form__dt--label">氏</label>
                            <div class="required-box">必須</div>
                        </dt>
                        <dd class="contractchange-form__dd">
                            <input type="text" name="fastname" class="contractchange-form__dd--input" id="fname" value="<?php echo $_COOKIE[ 'AccountFirstName' ]; ?>" placeholder="山田" autofocus required>
                            <div class="err-msg-fname"></div>
                        </dd>
                    </dl>
                    <dl class="contractchange-form__dl">
                        <dt class="contractchange-form__dt">
                            <label class="contractchange-form__dt--label">名</label>
                            <div class="required-box">必須</div>
                        </dt>
                        <dd class="contractchange-form__dd">
                            <input type="text" name="lastname" class="contractchange-form__dd--input" id="lname" value="<?php echo $_COOKIE[ 'AccountLastName' ]; ?>" placeholder="太郎" autofocus required>
                            <div class="err-msg-lname"></div>
                        </dd>
                    </dl>
                    <dl class="contractchange-form__dl">
                        <dt class="contractchange-form__dt">
                            <label class="contractchange-form__dt--label">氏（カナ）</label>
                            <div class="required-box">必須</div>
                        </dt>
                        <dd class="contractchange-form__dd">
                            <input type="text" name="fastnamekana" class="contractchange-form__dd--input" id="fnamekana" value="<?php echo $_COOKIE[ 'AccountFirstNameKana' ]; ?>" placeholder="ヤマダ" autofocus required>
                            <div class="err-msg-fnamekana"></div>
                        </dd>
                    </dl>
                    <dl class="contractchange-form__dl">
                        <dt class="contractchange-form__dt">
                            <label class="contractchange-form__dt--label">名（カナ）</label>
                            <div class="required-box">必須</div>
                        </dt>
                        <dd class="contractchange-form__dd">
                            <input type="text" name="lastnamekana" class="contractchange-form__dd--input" id="lnamekana" value="<?php echo $_COOKIE[ 'AccountLastNameKana' ]; ?>" placeholder="タロウ" autofocus required>
                            <div class="err-msg-lnamekana"></div>
                        </dd>
                    </dl>
                    <dl class="contractchange-form__dl">
                        <dt class="contractchange-form__dt">
                            <label class="contractchange-form__dt--label">生年月日</label>
                            <div class="required-box">必須</div>
                        </dt>
                        <dd class="contractchange-form__dd">
                            <input type="date" name="birthday" class="contractchange-form__dd--input" min="1000-01-01" max="9999-12-31" id="birthday" value="<?php echo $_COOKIE[ 'birthday' ]; ?>" autofocus required>
                            <div class="err-msg-birthday"></div>
                        </dd>
                    </dl>
                    <dl class="contractchange-form__dl">
                        <dt class="contractchange-form__dt">
                            <label class="contractchange-form__dt--label">メール</label>
                            <div class="required-box">必須</div>
                        </dt>
                        <dd class="contractchange-form__dd">
                            <input type="email" name="email" class="contractchange-form__dd--input" id="email" value="<?php echo $_COOKIE[ 'AccountEmail' ]; ?>" placeholder="@" autofocus required>
                            <div class="err-msg-email"></div>
                        </dd>
                    </dl>
                    <dl class="contractchange-form__dl">
                        <dt class="contractchange-form__dt">
                            <label class="contractchange-form__dt--label">電話番号</label>
                            <div class="required-box">必須</div>
                        </dt>
                        <dd class="contractchange-form__dd">
                            <input type="text" name="phone" class="contractchange-form__dd--input" id="phone" value="<?php echo $_COOKIE[ 'AccountPhone' ]; ?>"  placeholder="00000000000" autofocus required>
                            <div class="err-msg-phone"></div>
                        </dd>
                    </dl>
                    <dl class="contractchange-form__dl">
                        <dt class="contractchange-form__dt">
                            <label for="zipcode" class="contractchange-form__dt--label">郵便番号</label>
                            <div class="required-box">必須</div>
                        </dt>
                        <dd class="contractchange-form__dd">
                            <span class="yubinbango-mark">〒</span>
                            <input type="text" name="zipcode" class="contractchange-form__dd--input yubin-input" id="zipcode" value="<?php echo $_COOKIE[ 'yuubenbango' ]; ?>" placeholder="0000000" autofocus required>
                            <p id="error"></p>
                            <div class="err-msg-zipcode"></div>
                            <div id="disp" style="display:none;">
                                <p>複数の住所がございます。下記より選択してください。</p>
                                <select name="address-info" id="address-info" size="5">
                                    <option disabled selected>住所を選択してください。</option>
                                </select>
                            </div>
                        </dd>
                    </dl>                <dl class="contractchange-form__dl">
                    <dt class="contractchange-form__dt">
                        <label class="contractchange-form__dt--label">都道府県</label>
                        <div class="required-box">必須</div>
                    </dt>
                    <dd class="contractchange-form__dd">
                            <select name="state" class="contractchange-form__dd--input" id="state"  autofocus required>
                                <option value="<?php echo $_COOKIE[ 'AccountState' ]; ?>" selected><?php echo $_COOKIE[ 'AccountState' ]; ?></option>
                                <option value="北海道">北海道</option>
                                <option value="青森県">青森県</option>
                                <option value="岩手県">岩手県</option>
                                <option value="宮城県">宮城県</option>
                                <option value="秋田県">秋田県</option>
                                <option value="山形県">山形県</option>
                                <option value="福島県">福島県</option>
                                <option value="茨城県">茨城県</option>
                                <option value="栃木県">栃木県</option>
                                <option value="群馬県">群馬県</option>
                                <option value="埼玉県">埼玉県</option>
                                <option value="千葉県">千葉県</option>
                                <option value="東京都">東京都</option>
                                <option value="神奈川県">神奈川県</option>
                                <option value="新潟県">新潟県</option>
                                <option value="富山県">富山県</option>
                                <option value="石川県">石川県</option>
                                <option value="福井県">福井県</option>
                                <option value="山梨県">山梨県</option>
                                <option value="長野県">長野県</option>
                                <option value="岐阜県">岐阜県</option>
                                <option value="静岡県">静岡県</option>
                                <option value="愛知県">愛知県</option>
                                <option value="三重県">三重県</option>
                                <option value="滋賀県">滋賀県</option>
                                <option value="京都府">京都府</option>
                                <option value="大阪府">大阪府</option>
                                <option value="兵庫県">兵庫県</option>
                                <option value="奈良県">奈良県</option>
                                <option value="和歌山県">和歌山県</option>
                                <option value="鳥取県">鳥取県</option>
                                <option value="島根県">島根県</option>
                                <option value="岡山県">岡山県</option>
                                <option value="広島県">広島県</option>
                                <option value="山口県">山口県</option>
                                <option value="徳島県">徳島県</option>
                                <option value="香川県">香川県</option>
                                <option value="愛媛県">愛媛県</option>
                                <option value="高知県">高知県</option>
                                <option value="福岡県">福岡県</option>
                                <option value="佐賀県">佐賀県</option>
                                <option value="長崎県">長崎県</option>
                                <option value="熊本県">熊本県</option>
                                <option value="大分県">大分県</option>
                                <option value="宮崎県">宮崎県</option>
                                <option value="鹿児島県">鹿児島県</option>
                                <option value="沖縄県">沖縄県</option>
                                </select>
                                <div class="err-msg-state"></div>
                        </dd>
                    </dl>
                    <dl class="contractchange-form__dl">
                        <dt class="contractchange-form__dt">
                        <label class="contractchange-form__dt--label">市区町村・番地</label>
                        <div class="required-box">必須</div>
                        </dt>
                        <dd class="contractchange-form__dd">
                            <input type="text" name="city" class="contractchange-form__dd--input" id="city" value="<?php echo $_COOKIE[ 'AccountCity' ]; ?>" placeholder="入力してください" autofocus required>
                            <div class="err-msg-city"></div>
                        </dd>
                    </dl>
                    <dl class="contractchange-form__dl">
                        <dt class="contractchange-form__dt">
                        <dt class="contractchange-form__dt">
                                <label class="contractchange-form__dt--label">建物名・部屋番号</label>
                        </dt>
                        </dt>
                        <dd class="contractchange-form__dd">
                            <?php if(empty($_COOKIE[ 'Accountline2' ])) { ?>
                            <input type="text" name="line2" class="contractchange-form__dd--input" id="line2" value="">
                            <?php }else{ ?>
                            <input type="text" name="line2" class="contractchange-form__dd--input" id="line2" value="<?php echo $_COOKIE[ 'Accountline2' ]; ?>">
                            <?php } ?>

                        </dd>
                    </dl>
                    <input type="submit" name="submit" value="入力内容を確認する" onclick="OnButtonClick();" class="contractchange__btn" id="submit">
                </form>
            </div>
        </section>
    </main>
    <footer>
        @include('footer')
    </footer>
    <script language="javascript" type="text/javascript">
        function OnButtonClick() {
            document.cookie = 'fname=' + document.forms[0].elements[1].value;
            document.cookie = 'lname=' + document.forms[0].elements[2].value;
            document.cookie = 'fnamekana=' + document.forms[0].elements[3].value;
            document.cookie = 'lnamekana=' + document.forms[0].elements[4].value;
            document.cookie = 'birthday=' + document.forms[0].elements[5].value;
            document.cookie = 'email=' + document.forms[0].elements[6].value;
            document.cookie = 'phone=' + document.forms[0].elements[7].value;
            document.cookie = 'zip_code=' + document.forms[0].elements[8].value;
            document.cookie = 'state=' + document.forms[0].elements[10].value;
            document.cookie = 'city=' + document.forms[0].elements[11].value;
            //document.cookie = 'line1=' + document.forms[0].elements[12].value;
            document.cookie = 'line2=' + document.forms[0].elements[12].value;
        }
    </script>
    <script src="{{ asset('/js/validation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/fetch-jsonp@1.1.3/build/fetch-jsonp.min.js"></script>
    <script src="{{ asset('/js/zipcloud.js') }}"></script>
</body>
</html>