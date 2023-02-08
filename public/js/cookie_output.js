var cookies = document.cookie;
    var cookieItem = cookies.split(";");
    var cookieArray = new Array();
    for (i = 0; i < cookieItem.length; i++) {
        cookieItem[i] = cookieItem[i].trim();
        var elem = cookieItem[i].split("=");
        cookieArray[elem[0]] = decodeURIComponent(elem[1]);
    }

    //cookie data form value
    const yourname = document.getElementById('user_name');
    yourname.textContent = cookieArray["fname"];
    const yournamekana = document.getElementById('user_kana');
    yournamekana.textContent = cookieArray["fnamekana"];
    const birthday = document.getElementById('user_birthday');
    birthday.textContent = cookieArray["birthday"];
    const email = document.getElementById('user_email');
    email.textContent = cookieArray["email"];
    const phone = document.getElementById('user_phone');
    phone.textContent = cookieArray["phone"];
    const zip_code = document.getElementById('user_zip_code');
    zip_code.textContent = cookieArray["zip_code"];
    const address = document.getElementById('user_add');
    address.textContent = cookieArray["state"];