window.addEventListener('DOMContentLoaded', () => {

    // 「送信」ボタンの要素を取得
    const submit = document.querySelector('#submit');
    
    // 「送信」ボタンの要素にクリックイベントを設定する
    submit.addEventListener('click', (e) => {
        // デフォルトアクションをキャンセル
        //e.preventDefault();

        var flag = false; // 選択されているか否かを判定するフラグ
   
        //　ラジオボタンの数だけ判定を繰り返す（ボタンを表すインプットタグがあるので１引く）
        for(var i=0; i<document.form.flag.length; i++){
            // i番目のラジオボタンがチェックされているかを判定
            if(document.form.flag[i].checked){ 
                flag = true;    
                
            }

            // 何も選択されていない場合の処理
            const errMsgflag = document.querySelector('.err-msg-flag');
            const label = document.querySelector('.division');
            if(!flag){ 
                // クラスを追加(エラーメッセージを表示する)
                errMsgflag.classList.add('form-invalid');
                // エラーメッセージのテキスト
                errMsgflag.textContent = '事故区分が選択されていません';
                // クラスを追加(フォームの枠線を赤くする)
                label.classList.add('label-invalid');
                // 後続の処理を止める
            }else{
                errMsgflag.classList.remove('form-invalid');
                label.classList.remove('label-invalid');

            };
        }

        for(var i=0; i<document.form.check.length; i++){
            // i番目のラジオボタンがチェックされているかを判定
            if(document.form.check[i].checked){ 
                flag = true;
            }

            const errMsgcheck = document.querySelector('.err-msg-check');
            const text = document.querySelector('.claim-check');
            if(!flag){ 
                // クラスを追加(エラーメッセージを表示する)
                errMsgcheck.classList.add('form-invalid');
                // エラーメッセージのテキスト
                errMsgcheck.textContent = '修理可否が選択されていません';
                // クラスを追加(フォームの枠線を赤くする)
                text.classList.add('label-invalid');
                // 後続の処理を止める
            }else{
                errMsgcheck.classList.remove('form-invalid');
                text.classList.remove('label-invalid');
            };
        }

        

        // 「お名前」入力欄の空欄チェック
        // フォームの要素を取得
        const date = document.querySelector('#date');
        // エラーメッセージを表示させる要素を取得
        const errMsgdate = document.querySelector('.err-msg-date');
        if(!date.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgdate.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgdate.textContent = '生年月日が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            date.classList.add('input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgdate.textContent ='';
            // クラスを削除
            date.classList.remove('input-invalid');
        }
        // name
        const name = document.querySelector('#name');
        // エラーメッセージを表示させる要素を取得
        const errMsgname = document.querySelector('.err-msg-name');
        if(!date.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgname.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgname.textContent = '氏名が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            name.classList.add('input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgname.textContent ='';
            // クラスを削除
            name.classList.remove('input-invalid');
        }
        // place
        const place = document.querySelector('#place');
        // エラーメッセージを表示させる要素を取得
        const errMsgplace = document.querySelector('.err-msg-place');
        if(!place.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgplace.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgplace.textContent = '事故発生場所が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            place.classList.add('input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgplace.textContent ='';
            // クラスを削除
            place.classList.remove('input-invalid');
        }
        // add
        const add = document.querySelector('#add');
        // エラーメッセージを表示させる要素を取得
        const errMsgadd = document.querySelector('.err-msg-add');
        if(!add.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgadd.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgadd.textContent = '市区群以下の住所及び施設名が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            add.classList.add('input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgadd.textContent ='';
            // クラスを削除
            add.classList.remove('input-invalid');
        }
         // messe
         const messe = document.querySelector('#messe');
         // エラーメッセージを表示させる要素を取得
         const errMsgmesse = document.querySelector('.err-msg-messe');
         if(!add.value){
             // クラスを追加(エラーメッセージを表示する)
             errMsgmesse.classList.add('form-invalid');
             // エラーメッセージのテキスト
             errMsgmesse.textContent = '事故発生の状況が入力されていません';
             // クラスを追加(フォームの枠線を赤くする)
             messe.classList.add('input-invalid');
             // 後続の処理を止める
             
         }else{
             // エラーメッセージのテキストに空文字を代入
             errMsgmesse.textContent ='';
             // クラスを削除
             messe.classList.remove('input-invalid');
         }
          // condition
          const condition = document.querySelector('#condition');
          // エラーメッセージを表示させる要素を取得
          const errMsgcondition = document.querySelector('.err-msg-condition');
          if(!condition.value){
              // クラスを追加(エラーメッセージを表示する)
              errMsgcondition.classList.add('form-invalid');
              // エラーメッセージのテキスト
              errMsgcondition.textContent = '事故後の端末の状態が入力されていません';
              // クラスを追加(フォームの枠線を赤くする)
              condition.classList.add('input-invalid');
              // 後続の処理を止める
              
          }else{
              // エラーメッセージのテキストに空文字を代入
              errMsgcondition.textContent ='';
              // クラスを削除
              condition.classList.remove('input-invalid');
          }

          //image
          let flg = "";
          const form = document.form.flag;

          for (let i = 0; i < form.length; i++) {
            if (form[i].checked) {
                flg = form[i].value;
              break;
            }
          }

          if (flg === "break" || flg === "wet") {
            const req_phot1 = document.querySelector('#req_phot1');
            const req_phot2 = document.querySelector('#req_phot2');
            const req_messe = document.querySelector('#req_messe');
            // エラーメッセージを表示させる要素を取得
            const errMsgreq_phot1 = document.querySelector('.err-msg-req_phot1');
            const errMsgreq_phot2 = document.querySelector('.err-msg-req_phot2');
            const errMsgreq_messe = document.querySelector('.err-msg-req_messe');
            if(!req_phot1.value && !req_phot2.value && !req_messe.value){
                // クラスを追加(エラーメッセージを表示する)
                errMsgreq_messe.classList.add('form-invalid');
                // エラーメッセージのテキスト
                errMsgreq_messe.textContent = '事故端末の写真が添付できない理由が入力されていません';
                // クラスを追加(フォームの枠線を赤くする)
                req_messe.classList.add('input-invalid');
                // 後続の処理を止める
            }else if (req_phot1.value && !req_phot2.value) {
                // クラスを追加(エラーメッセージを表示する)
                errMsgreq_phot2.classList.add('form-invalid');
                // エラーメッセージのテキスト
                errMsgreq_phot2.textContent = '端末画像(背面)がアップロードされていません';
                // クラスを追加(フォームの枠線を赤くする)
                req_phot2.classList.add('input-invalid');
                // 後続の処理を止める
            }else if(!req_phot1.value && req_phot2.value) {
                // クラスを追加(エラーメッセージを表示する)
                errMsgreq_phot1.classList.add('form-invalid');
                // エラーメッセージのテキスト
                errMsgreq_phot1.textContent = '端末画像(前面)がアップロードされていません';
                // クラスを追加(フォームの枠線を赤くする)
                req_phot1.classList.add('input-invalid');
                // 後続の処理を止める
            }else{
                // エラーメッセージのテキストに空文字を代入
                errMsgreq_messe.textContent ='';
                // クラスを削除
                req_messe.classList.remove('input-invalid');
            }
  
          } else {
            const req_phot3 = document.querySelector('#req_phot3');
            const req_phot4 = document.querySelector('#req_phot4');
            const req_messe2 = document.querySelector('#req_messe2');
            // エラーメッセージを表示させる要素を取得
            const errMsgreq_phot3 = document.querySelector('.err-msg-req_phot3');
            const errMsgreq_phot4 = document.querySelector('.err-msg-req_phot4');
            const errMsgreq_messe2 = document.querySelector('.err-msg-req_messe2');
            if(!req_phot3.value && !req_phot4.value && !req_messe2.value){
                // クラスを追加(エラーメッセージを表示する)
                errMsgreq_messe2.classList.add('form-invalid');
                // エラーメッセージのテキスト
                errMsgreq_messe2.textContent = '事故端末の写真が添付できない理由が入力されていません';
                // クラスを追加(フォームの枠線を赤くする)
                req_messe2.classList.add('input-invalid');
                // 後続の処理を止める
            }else if (req_phot3.value && !req_phot4.value) {
                // クラスを追加(エラーメッセージを表示する)
                errMsgreq_phot4.classList.add('form-invalid');
                // エラーメッセージのテキスト
                errMsgreq_phot4.textContent = '再購入証明書がアップロードされていません';
                // クラスを追加(フォームの枠線を赤くする)
                req_phot4.classList.add('input-invalid');
                // 後続の処理を止める
            }else if(!req_phot3.value && req_phot4.value) {
                // クラスを追加(エラーメッセージを表示する)
                errMsgreq_phot3.classList.add('form-invalid');
                // エラーメッセージのテキスト
                errMsgreq_phot3.textContent = '盗難届or遺失届がアップロードされていません';
                // クラスを追加(フォームの枠線を赤くする)
                req_phot3.classList.add('input-invalid');
                // 後続の処理を止める
            }else{
                // エラーメッセージのテキストに空文字を代入
                errMsgreq_messe2.textContent ='';
                // クラスを削除
                req_messe2.classList.remove('input-invalid');
            }

          }

          


    }, false);
}, false);