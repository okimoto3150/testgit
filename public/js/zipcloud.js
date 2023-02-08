
        let zipcode = document.getElementById('zipcode');
        let m_arr = [];
        zipcode.addEventListener('change', ()=>{
    
            let api = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=';
            let error = document.getElementById('error');
            let address1 = document.getElementById('state');
            let address2 = document.getElementById('city');
            //let address3 = document.getElementById('line1');
            let param = zipcode.value.replace("-",""); //入力された郵便番号から「-」を削除
            let url = api + param + "&limit=70";
            let disp = document.getElementById('disp');
           
                fetchJsonp(url, {
                timeout: 10000, //タイムアウト時間
                })
                .then((response)=>{
                    error.textContent = ''; //HTML側のエラーメッセージ初期化
                    return response.json();  
                })

                .then((data)=>{
                    if(data.status === 400){ //エラー時
                        error.textContent = data.message;
                    }else if(data.results === null){
                        error.textContent = '郵便番号から住所が見つかりませんでした。';
                    }else{
                        if(data.results.length == 1){
                            disp.style.display = "none";
                            let result = data.results[0];
                            var res1 = result.address1;
                            var res2 = result.address2 + result.address3;
                           // var res3 = result.address3;
                            address1.value = res1;
                            address2.value = res2;
                            //address3.value = res3;
                        }else {
                            for (let i = 0; i < data.results.length; i++) {
                                let result = data.results[i];
                                var res1 = result.address1;
                                var res2 = result.address2;
                               // var res3 = result.address3;
    
                                disp.style.display = "block";
                                address1.value = "";
                                address2.value = "";
                               // address3.value = "";
                                const address_all = document.getElementById('address-info');
                                const option = document.createElement('option');
                                var arr = [res1 , res2 , res3];
                                m_arr.push(arr);
                                option.value = arr;
                                option.textContent = res1 + res2 + res3;
                                address_all.appendChild(option);                          
                            }
                        }

                    }
                })
                .catch((ex)=>{ //例外処理
                    console.log(ex);
                });
        }, false);


        var add = document.getElementById('address-info');
        add.onchange = function () {
            let address1 = document.getElementById('state');
            let address2 = document.getElementById('city');
           // let address3 = document.getElementById('line1');
            var idx = add.selectedIndex;
            var objvalue = add.options[idx].value;
            
            address1.value = m_arr[idx][0];
            address2.value = m_arr[idx][1];
           // address3.value = m_arr[idx][2];
        };