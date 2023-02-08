window.addEventListener('DOMContentLoaded', () => {

    // 「送信」ボタンの要素を取得
    const submit = document.querySelector('#entry-submit');
    
    // 「送信」ボタンの要素にクリックイベントを設定する
    submit.addEventListener('click', (e) => {
        // デフォルトアクションをキャンセル
        //e.preventDefault();

        var flag = false; // 選択されているか否かを判定するフラグ
   
        //　ラジオボタンの数だけ判定を繰り返す（ボタンを表すインプットタグがあるので１引く）
        for(var i=0; i<document.entry_form.device.length; i++){
            // i番目のラジオボタンがチェックされているかを判定
            if(document.entry_form.device[i].checked){ 
                flag = true;    
                
            }

            // 何も選択されていない場合の処理
            const errMsgdevice = document.querySelector('.err-msg-device');
            const label = document.querySelector('.entry');
            if(!flag){ 
                    // クラスを追加(エラーメッセージを表示する)
                errMsgdevice.classList.add('entry-form-invalid');
                // エラーメッセージのテキスト
                errMsgdevice.textContent = '主端末が選択されていません';
                // クラスを追加(フォームの枠線を赤くする)
                label.classList.add('label-invalid');
                // 後続の処理を止める
            }else{
                errMsgdevice.classList.remove('entry-form-invalid');
                label.classList.remove('label-invalid');

            };
        }

        // 入力欄の空欄チェック
        // フォームの要素を取得
        const maker = document.querySelector('#maker');
        // エラーメッセージを表示させる要素を取得
        const errMsgmaker = document.querySelector('.err-msg-maker');
        if(!maker.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgmaker.classList.add('entry-form-invalid');
            // エラーメッセージのテキスト
            errMsgmaker.textContent = 'メーカーが入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            maker.classList.add('entry-input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgmaker.textContent ='';
            // クラスを削除
            maker.classList.remove('entry-input-invalid');
        }

        //model
        const model = document.querySelector('#model');
        // エラーメッセージを表示させる要素を取得
        const errMsgmodel = document.querySelector('.err-msg-model');
        if(!model.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgmodel.classList.add('entry-form-invalid');
            // エラーメッセージのテキスト
            errMsgmodel.textContent = '機種が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            model.classList.add('entry-input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgmodel.textContent ='';
            // クラスを削除
            model.classList.remove('entry-input-invalid');
        }

        //number
        const number = document.querySelector('#number');
        // エラーメッセージを表示させる要素を取得
        const errMsgnumber = document.querySelector('.err-msg-number');
        if(!number.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgnumber.classList.add('entry-form-invalid');
            // エラーメッセージのテキスト
            errMsgnumber.textContent = 'シリアル番号が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            number.classList.add('entry-input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgnumber.textContent ='';
            // クラスを削除
            number.classList.remove('entry-input-invalid');
        }

        //imei
        const imei = document.querySelector('#imei');
        // エラーメッセージを表示させる要素を取得
        const errMsgimei = document.querySelector('.err-msg-imei');
        if(!imei.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgimei.classList.add('entry-form-invalid');
            // エラーメッセージのテキスト
            errMsgimei.textContent = 'IMEIが入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            imei.classList.add('entry-input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgimei.textContent ='';
            // クラスを削除
            imei.classList.remove('entry-input-invalid');
        }

        //capacity
        const capacity = document.querySelector('#capacity');
        // エラーメッセージを表示させる要素を取得
        const errMsgcapacity = document.querySelector('.err-msg-capacity');
        if(!capacity.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgcapacity.classList.add('entry-form-invalid');
            // エラーメッセージのテキスト
            errMsgcapacity.textContent = '容量が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            capacity.classList.add('entry-input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgcapacity.textContent ='';
            // クラスを削除
            capacity.classList.remove('entry-input-invalid');
        }

         //purchase
         const purchase = document.querySelector('#purchase');
         // エラーメッセージを表示させる要素を取得
         const errMsgpurchase = document.querySelector('.err-msg-purchase');
         if(!purchase.value){
             // クラスを追加(エラーメッセージを表示する)
             errMsgpurchase.classList.add('entry-form-invalid');
             // エラーメッセージのテキスト
             errMsgpurchase.textContent = '購入日が入力されていません';
             // クラスを追加(フォームの枠線を赤くする)
             purchase.classList.add('entry-input-invalid');
             // 後続の処理を止める
             
         }else{
             // エラーメッセージのテキストに空文字を代入
             errMsgpurchase.textContent ='';
             // クラスを削除
             purchase.classList.remove('entry-input-invalid');
         }

        //amount
        const amount = document.querySelector('#amount');
        // エラーメッセージを表示させる要素を取得
        const errMsgamount = document.querySelector('.err-msg-amount');
        if(!amount.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgamount.classList.add('entry-form-invalid');
            // エラーメッセージのテキスト
            errMsgamount.textContent = '購入金額が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            amount.classList.add('entry-input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgamount.textContent ='';
            // クラスを削除
            amount.classList.remove('entry-input-invalid');
        }

         //career
         const career = document.querySelector('#career');
         // エラーメッセージを表示させる要素を取得
         const errMsgcareer = document.querySelector('.err-msg-career');
         if(!career.value){
             // クラスを追加(エラーメッセージを表示する)
             errMsgcareer.classList.add('entry-form-invalid');
             // エラーメッセージのテキスト
             errMsgcareer.textContent = 'キャリアが入力されていません';
             // クラスを追加(フォームの枠線を赤くする)
             career.classList.add('entry-input-invalid');
             // 後続の処理を止める
             
         }else{
             // エラーメッセージのテキストに空文字を代入
             errMsgcareer.textContent ='';
             // クラスを削除
             career.classList.remove('entry-input-invalid');
         }

        //device-img1
        const deviceimg1 = document.querySelector('#device-img1');
        // エラーメッセージを表示させる要素を取得
        const errMsgdeviceimg1 = document.querySelector('.err-msg-device-img1');
        if(!deviceimg1.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgdeviceimg1.classList.add('entry-form-invalid');
            // エラーメッセージのテキスト
            errMsgdeviceimg1.textContent = '写真が選択されていません';
            // クラスを追加(フォームの枠線を赤くする)
            deviceimg1.classList.add('entry-input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgdeviceimg1.textContent ='';
            // クラスを削除
            deviceimg1.classList.remove('entry-input-invalid');
        }

        //device-img2
        const deviceimg2 = document.querySelector('#device-img2');
        // エラーメッセージを表示させる要素を取得
        const errMsgdeviceimg2 = document.querySelector('.err-msg-device-img2');
        if(!deviceimg2.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgdeviceimg2.classList.add('entry-form-invalid');
            // エラーメッセージのテキスト
            errMsgdeviceimg2.textContent = '写真が選択されていません';
            // クラスを追加(フォームの枠線を赤くする)
            deviceimg2.classList.add('entry-input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgdeviceimg2.textContent ='';
            // クラスを削除
            deviceimg2.classList.remove('entry-input-invalid');
        }
    }, false);
}, false);