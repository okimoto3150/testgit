window.addEventListener('DOMContentLoaded', () => {

    // 「送信」ボタンの要素を取得
    const submit = document.querySelector('#submit');
    
    // 「送信」ボタンの要素にクリックイベントを設定する
    submit.addEventListener('click', (e) => {

        // 「お名前」入力欄の空欄チェック
        // フォームの要素を取得
        const fname = document.querySelector('#fname');
        // エラーメッセージを表示させる要素を取得
        const errMsgfName = document.querySelector('.err-msg-fname');
        if(!fname.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgfName.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgfName.textContent = '苗字が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            fname.classList.add('input-invalid');
            // デフォルトアクションをキャンセル
            e.preventDefault();
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgfName.textContent ='';
            // クラスを削除
            fname.classList.remove('input-invalid');
        }

        //lname
        const lname = document.querySelector('#lname');
        // エラーメッセージを表示させる要素を取得
        const errMsglName = document.querySelector('.err-msg-lname');
        if(!lname.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsglName.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsglName.textContent = 'お名前が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            lname.classList.add('input-invalid');
            // デフォルトアクションをキャンセル
            e.preventDefault();
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsglName.textContent ='';
            // クラスを削除
            lname.classList.remove('input-invalid');
        }

        //fnamekana
        const fnamekana = document.querySelector('#fnamekana');
        // エラーメッセージを表示させる要素を取得
        const errMsgfNameKana = document.querySelector('.err-msg-fnamekana');
        if(!fnamekana.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgfNameKana.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgfNameKana.textContent = 'フリガナが入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            fnamekana.classList.add('input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgfNameKana.textContent ='';
            // クラスを削除
            fnamekana.classList.remove('input-invalid');
        }

        //lnamekana
        const lnamekana = document.querySelector('#lnamekana');
        // エラーメッセージを表示させる要素を取得
        const errMsglNameKana = document.querySelector('.err-msg-lnamekana');
        if(!lnamekana.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsglNameKana.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsglNameKana.textContent = 'フリガナが入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            lnamekana.classList.add('input-invalid');
            // 後続の処理を止める
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsglNameKana.textContent ='';
            // クラスを削除
            lnamekana.classList.remove('input-invalid');
        }
        

        //birthday
        const birthday = document.querySelector('#birthday');
        // エラーメッセージを表示させる要素を取得
        const errMsgbirthday = document.querySelector('.err-msg-birthday');
        if(!birthday.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgbirthday.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgbirthday.textContent = '生年月日が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            birthday.classList.add('input-invalid');
            // デフォルトアクションをキャンセル
            e.preventDefault();
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgbirthday.textContent ='';
            // クラスを削除
            birthday.classList.remove('input-invalid');
        }

        //email
        const email = document.querySelector('#email');
        // エラーメッセージを表示させる要素を取得
        const errMsgemail = document.querySelector('.err-msg-email');

        const pattern = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ui;



        if(!email.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgemail.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgemail.textContent = 'メールアドレスが入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            email.classList.add('input-invalid');
            // デフォルトアクションをキャンセル
            e.preventDefault();

        }else if(email.value.length < 6) {
            // クラスを追加(エラーメッセージを表示する)
            errMsgemail.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgemail.textContent = 'メールアドレスを確認してください';
            // クラスを追加(フォームの枠線を赤くする)
            email.classList.add('input-invalid');
            // デフォルトアクションをキャンセル
            e.preventDefault();

        }else if(!pattern.test(email.value)) {
            // クラスを追加(エラーメッセージを表示する)
            errMsgemail.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgemail.textContent = 'メールアドレスの形式が正しくありません';
            // クラスを追加(フォームの枠線を赤くする)
            email.classList.add('input-invalid');
            // デフォルトアクションをキャンセル
            e.preventDefault();

        }else{

            // エラーメッセージのテキストに空文字を代入
            errMsgemail.textContent ='';
            // クラスを削除
            email.classList.remove('input-invalid');


        }

        //phone
        const phone = document.querySelector('#phone');
        // エラーメッセージを表示させる要素を取得
        const errMsgphone = document.querySelector('.err-msg-phone');
        if(!phone.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgphone.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgphone.textContent = '電話番号が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            phone.classList.add('input-invalid');
            // デフォルトアクションをキャンセル
            e.preventDefault();
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgphone.textContent ='';
            // クラスを削除
            phone.classList.remove('input-invalid');
        }
        

        //zipcode
        const zipcode = document.querySelector('#zipcode');
        // エラーメッセージを表示させる要素を取得
        const errMsgzipcode = document.querySelector('.err-msg-zipcode');
        if(!zipcode.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgzipcode.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgzipcode.textContent = '郵便番号が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            zipcode.classList.add('input-invalid');
            // デフォルトアクションをキャンセル
            e.preventDefault();
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgzipcode.textContent ='';
            // クラスを削除
            zipcode.classList.remove('input-invalid');
        }

        //state
        const state = document.querySelector('#state');
        // エラーメッセージを表示させる要素を取得
        const errMsgstate = document.querySelector('.err-msg-state');
        if(!state.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgstate.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgstate.textContent = '都道府県が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            state.classList.add('input-invalid');
            // デフォルトアクションをキャンセル
            e.preventDefault();
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgstate.textContent ='';
            // クラスを削除
            state.classList.remove('input-invalid');
        }

        //city
        const city = document.querySelector('#city');
        // エラーメッセージを表示させる要素を取得
        const errMsgcity = document.querySelector('.err-msg-city');
        if(!city.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgcity.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgcity.textContent = '市区町村が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            city.classList.add('input-invalid');
            // デフォルトアクションをキャンセル
            e.preventDefault();
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgcity.textContent ='';
            // クラスを削除
            city.classList.remove('input-invalid');
        }

        //line1
        const line1 = document.querySelector('#line1');
        // エラーメッセージを表示させる要素を取得
        const errMsgline1 = document.querySelector('.err-msg-line1');
        if(!line1.value){
            // クラスを追加(エラーメッセージを表示する)
            errMsgline1.classList.add('form-invalid');
            // エラーメッセージのテキスト
            errMsgline1.textContent = '丁目・番地が入力されていません';
            // クラスを追加(フォームの枠線を赤くする)
            line1.classList.add('input-invalid');
            // デフォルトアクションをキャンセル
            e.preventDefault();
            
        }else{
            // エラーメッセージのテキストに空文字を代入
            errMsgline1.textContent ='';
            // クラスを削除
            line1.classList.remove('input-invalid');
        }


    }, false);
}, false);