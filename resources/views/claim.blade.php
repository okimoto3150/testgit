<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>デバイス保険</title>
        <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
        <link rel="stylesheet" href="{{asset('css/claim.css')}}">
    </head>
    <body>
        <header>
            @include('claim-header')
        </header>
        <main>
            <div class="m-wrap">
                <div class="m">
                    <div class="m__name">
                        <p><?php echo $_COOKIE[ 'name' ]; ?></p><span>　さん</span>
                    </div>
                    <h2 class="m__ttl">マイページ</h2>
                    <section class="m__claim">
                        <h3 class="m__claim--ttl">保険金の請求</h3>
                        <img src="{{asset('img/claim/Progress3.png')}}" alt="入力" class="m__claim--step">
                        <p class="m__claim--text">請求依頼項目に入力し、確認ボタンを押してください。</p>
                    </section>
                    <section class="m__contract">
                        <h3 class="m__contract--ttl">ご契約情報</h3>
                        <dl class="m__contract--list">
                            <dt class="m__contract--item">保険番号</dt>
                            <dd class="m__contract--data">1234567812345678</dd>
                        </dl>
                        <button class="m__contract--check"><a href="" class="m__contract--link">契約内容確認</a></button>
                    </section>
                    <section class="m__request">
                        <form class="req-form" action="confirmation" method="post" enctype="multipart/form-data" name="form">
                            @csrf
                            <h3 class="req-form__ttl">保険金請求依頼</h3>
                                <dl class="req-form__list">
                                    <dt class="req-form__list--item">事故区分
                                </dt>
                                <div class="err-msg-flag"></div>
                                <dd class="req-form__list--data">
                                    <ul class="division" id="division">
                                        <li class="division__item">
                                            <input type="radio" name="flag" class="division__item--check" value="故障" id="break" onclick="buttonClick()">
                                            <label class="division__item--label" for="break"><span class="division__item--span">故障</span></label>
                                        </li>
                                        <li class="division__item">
                                            <input type="radio" name="flag" class="division__item--check" value="水濡れ" id="wet" onclick="buttonClick()">
                                            <label class="division__item--label" for="wet"><span class="division__item--span">水濡れ</span></label>
                                        </li>
                                        <li class="division__item">
                                            <input type="radio" name="flag" class="division__item--check" value="破損" id="loss" onclick="buttonClick()">
                                            <label class="division__item--label" for="loss"><span class="division__item--span">破損</span></label>
                                        </li>
                                        <li class="division__item">
                                            <input type="radio" name="flag" class="division__item--check" value="盗難" id="theft" onclick="buttonClick()">
                                            <label class="division__item--label" for="theft"><span class="division__item--span">盗難</span></label>
                                        </li>
                                    </ul>
                                </dd>
                                <dt class="req-form__list--item">修理可否</dt>
                                <div class="err-msg-check"></div>
                                <dd class="req-form__list--data">
                                    <ul class="claim-check">
                                        <li class="claim-check__item">
                                            <input type="radio" name="check" class="check__item--btn" value="修理可(有償交換含む)" id="yes">
                                            <label class="check__item--label" for="yes"><span class="check__item--span">修理可(有償交換含む)</span></label>
                                        </li>
                                        <li class="claim-check__item">
                                            <input type="radio" name="check" class="check__item--btn" value="不可" id="no">
                                            <label class="check__item--label" for="no"><span class="check__item--span">不可</span></label>
                                        </li>
                                    </ul>
                                </dd>
                                <dt class="req-form__list--item">事故発生日時</dt>
                                <dd class="req-form__list--data">
                                    <input type="date" class="req-form__list--input" min="1000-01-01" max="9999-12-31" name="req_date" id="date" autofocus required>
                                    <div class="err-msg-date"></div>
                                </dd>
                                <dt class="req-form__list--item">事故対象者</dt>
                                <dd class="req-form__list--data">
                                    <input type="text" name="req_name" placeholder="氏名を入力してください" value="" class="req-form__list--input" id="name" autofocus required>
                                    <div class="err-msg-name"></div>
                                </dd>
                                <dt class="req-form__list--item">事故発生場所</dt>
                                <dd class="req-form__list--data">
                                    <input type="text" name="req_place" placeholder="事故発生場所を入力してください" class="req-form__list--input" id="place" autofocus required>
                                    <div class="err-msg-place"></div>
                                </dd>
                                <dt class="req-form__list--item">市区群以下の住所および施設名</dt>
                                <dd class="req-form__list--data">
                                    <input type="text" name="req_add" placeholder="住所及び施設名を入力してください" class="req-form__list--input" id="add" autofocus required>
                                    <div class="err-msg-add"></div>
                                </dd>
                                <dt class="req-form__list--item">事故発生の状況</dt>
                                <dd class="req-form__list--data">
                                    <textarea placeholder="事故のきっかけ・原因などをご入力ください" class="req-form__list--message" name="req_status" id="messe" autofocus required></textarea>
                                    <div class="err-msg-messe"></div>
                                </dd>
                                <dt class="req-form__list--item">事故後の端末の状態</dt>
                                <dd class="req-form__list--data">
                                    <textarea placeholder="端末がどのように壊れているかなどをご入力ください" class="req-form__list--condition" name="req_condition" id="condition" autofocus required></textarea>
                                    <div class="err-msg-condition"></div>
                                </dd>
                            </dl>
                            <div id="select-break">
                                <p class="req-form__list--text">ダミー文章</p>
                                <div class="req-form__list--item">
                                    <p>端末画像(前面)</p>
                                    <div id="preview1"></div>
                                    <div class="req-form__btn">
                                        <label class="req-form__btn--label"><input type="file" name="req_phot1" id="req_phot1" capture="environment" onChange="imgPreView(event, 'preview1', 'device-btn1')" accept="image/*" class="req-form__btn--phot"><p id="device-btn1">端末画像のアップロード</p></label>
                                    </div>
                                    <div class="err-msg-req_phot1"></div>
                                </div>
                                <div class="req-form__list--item">
                                    <p>端末画像(背面)</p>
                                    <div id="preview2"></div>
                                    <div class="req-form__btn">
                                        <label class="req-form__btn--label"><input type="file" name="req_phot2"  id="req_phot2" capture="environment" onChange="imgPreView(event, 'preview2', 'device-btn2')" accept="image/*" class="req-form__btn--phot"><p id="device-btn2">端末画像のアップロード</p></label>
                                    </div>
                                    <div class="err-msg-req_phot2"></div>
                                </div>
                                <div class="req-form__phot">
                                    <p class="req-form__phot--text req-form__list--item">事故端末の写真が添付できない場合の理由</p>
                                    <textarea placeholder="事故端末の写真をアップロードいただけない場合のみその理由をご入力ください" class="req-form__phot--texterea" name="req_messe" id="req_messe"></textarea>
                                    <div class="err-msg-req_messe"></div>
                                </div>
                            </div>
                            <div id="select-loss">
                                <p>紛失/盗難の場合は証明書の送付が必要です。</p>
                                <div class="req-form__list--item">
                                    <p>盗難届or遺失届</p>
                                    <div id="preview3"></div>
                                    <div class="req-form__btn">
                                        <label class="req-form__btn--label"><input type="file" name="req_phot3" id="req_phot3" capture="environment" onChange="imgPreView(event, 'preview3', 'document-btn1')" accept="image/*" class="req-form__btn--phot"><p id="document-btn1">書類画像のアップロード</p></label>
                                    </div>
                                    <div class="err-msg-req_phot3"></div>
                                </div>
                                <div class="req-form__list--item">
                                    <p>再購入証明書</p>
                                    <div id="preview4"></div>
                                    <div class="req-form__btn">
                                        <label class="req-form__btn--label"><input type="file" name="req_phot4" id="req_phot4" capture="environment" onChange="imgPreView(event, 'preview4', 'document-btn2')" accept="image/*" class="req-form__btn--phot"><p id="document-btn2">書類画像のアップロード</p></label>
                                    </div>
                                    <div class="err-msg-req_phot4"></div>
                                </div>
                                <div class="req-form__phot req-form__list--item">
                                    <p class="req-form__phot--text">書類の写真が添付できない場合の理由</p>
                                    <textarea placeholder="書類の写真をアップロードいただけない場合のみその理由をご入力ください" class="req-form__phot--texterea" name="req_messe2" id="req_messe2"></textarea>
                                    <div class="err-msg-req_messe2"></div>
                                </div>
                            </div>
                            <input type="submit" class="req-form__submit" value="入力内容確認" onclick="OnButtonClick();" id="submit">
                        </form>
                    </section>  
                </div>
            </div>
        </main>
        <footer>
            @include('footer')
        </footer>
        <script>
            let selectbreak = document.getElementById("select-break");
            let selectloss = document.getElementById("select-loss");
            selectbreak.style.display = "none";
            selectloss.style.display = "none";

            function buttonClick() {
                let btnbreak = document.getElementById("break");
                let btnwet = document.getElementById("wet");
                let btnloss = document.getElementById("loss");
                let btntheft = document.getElementById("theft");

                if(btnbreak.checked) {
                    selectbreak.style.display = "";
                    selectloss.style.display = "none";
                } else if(btnwet.checked) {
                    selectbreak.style.display = "";
                    selectloss.style.display = "none";
                } else if(btnloss.checked) {
                    selectbreak.style.display = "none";
                    selectloss.style.display = "";
                } else if(btntheft.checked) {
                    selectbreak.style.display = "none";
                    selectloss.style.display = "";
                }


            }
        </script>
        <script>
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
            
            if (btnId === "device-btn1" || btnId === "device-btn2") {
                btn.textContent = '端末画像の変更';
            } else {
                btn.textContent = '書類画像の変更';
            }

            reader.readAsDataURL(file);
            }

        </script>
        <script language="javascript" type="text/javascript">
            function OnButtonClick() {
                var flag_break = document.forms[0].elements[1].checked;
                var flag_wet = document.forms[0].elements[2].checked;
                var flag_loss = document.forms[0].elements[3].checked;
                var flag_theft = document.forms[0].elements[4].checked;

                if (flag_break) {
                    document.cookie = 'flag=故障';
                } else if (flag_wet) {
                    document.cookie = 'flag=水濡れ';
                } else if (flag_loss) {
                    document.cookie = 'flag=紛失';
                } else if (flag_theft) {
                    document.cookie = 'flag=盗難';
                }


                var check_yes = document.forms[0].elements[5].checked;
                var check_no = document.forms[0].elements[6].checked;

                if (check_yes) {
                    document.cookie = 'check=可';
                } else if (check_no) {
                    document.cookie = 'check=不可';
                }

                document.cookie = 'acc_date=' + document.forms[0].elements[7].value;
                document.cookie = 'acc_name=' + document.forms[0].elements[8].value;
                document.cookie = 'acc_place=' + document.forms[0].elements[9].value;
                document.cookie = 'acc_add=' + document.forms[0].elements[10].value;
                document.cookie = 'acc_status=' + document.forms[0].elements[11].value;
                document.cookie = 'acc_condition=' + document.forms[0].elements[12].value;
                document.cookie = 'acc_messe=' + document.forms[0].elements[15].value;
                document.cookie = 'acc_messe2=' + document.forms[0].elements[18].value;

            }
        </script>
        <script src="{{ asset('/js/claim_valid.js') }}"></script>
</body>

</html>