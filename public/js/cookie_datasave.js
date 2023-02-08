
    //cookie data Temporarily saved
    
    function OnButtonClick() {
        document.cookie = 'fname=' + document.forms[0].elements[0].value;
        document.cookie = 'lname=' + document.forms[0].elements[1].value;
        document.cookie = 'fnamekana=' + document.forms[0].elements[2].value;
        document.cookie = 'lnamekana=' + document.forms[0].elements[3].value;
        document.cookie = 'birthday=' + document.forms[0].elements[4].value;
        document.cookie = 'email=' + document.forms[0].elements[5].value;
        document.cookie = 'zip_code=' + document.forms[0].elements[6].value;
        document.cookie = 'state=' + document.forms[0].elements[7].value;
        document.cookie = 'city=' + document.forms[0].elements[8].value;
        document.cookie = 'line1=' + document.forms[0].elements[9].value;
        document.cookie = 'line2=' + document.forms[0].elements[10].value;
        document.cookie = 'phone=' + document.forms[0].elements[11].value;
    }