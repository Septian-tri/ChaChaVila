var boolLogin           = false;
var boolNotification    = "Tampilkan";
var loginButton         = document.getElementById("lgnBtn");


if(loginButton === undefined || loginButton === null){
    
    window.document.location = document.location.origin + "/register.php";

}else{

    loginButton.onclick = function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        e.stopPropagation();

        if(boolLogin === false){

            //Kirim data ke registersystem.php
            $.ajax({

                url         : document.location.origin + "/settings/ProsesSystem/registerSystem.php",
                data        : {
                    
                    "username"    : document.getElementById("username").value, 
                    "email"       : document.getElementById("email").value, 
                    "phonenumber" : document.getElementById("phonenumber").value,
                    "password"    : document.getElementById("password").value,
                    "repassword"  : document.getElementById("repassword").value,

                },
                accepts     : "text/html",
                method      : "POST",
                crossDomain : false,
                beforeSend  : function(){ 

                    boolLogin = true; 
                    disabledButtonSend("id", "lgnBtn", "disabled", 'Loading'); 

                }, //tambahkan animasi loading. ganti tulisan 'loading' e.g '<div class="loading"></div>'
                complete    : function(){ 

                    boolLogin = false; 
                    disabledButtonSend("id", "lgnBtn", "enabled", "DAFTAR SEKARANG"); 

                },
                error       : function(jqXHR){

                    boolLogin = true;
                    disabledButtonSend("id", "lgnBtn", "disabled", 'Loading');  
                    messageNotification(mappingErrorNetwork[jqXHR.status], 'Tampilkan');

                },
                success     : function(response){

                   if(response){
                        
                        try{

                            var parseJson               = JSON.parse(response);
                            var messageType             = parseJson.messageType;
                            var messageNotif            = parseJson.messageNotif;
                            var messageFieldError       = parseJson.messageFieldErrorObject;

                            switch(messageType){

                                case 'notification' :
                                    messageNotification(messageNotif, 'Tampilkan');
                                break;

                                case 'notificationErrorField' :
                                    messageNotification(messageNotif, 'Tampilkan');
                                    styleWrong(messageFieldError);
                                break;

                                default :
                                    alert('Maaf Kami mengalami masalah sistem :( . Code : ' + messageType);
                                    return false;
                                break;

                            }
                        
                        }catch(e){

                            console.log(response);
                            alert("Maaf Kami melihat ada Sesuatu Yang kurang Baik, kami akan Merload Halaman kamu !");
                            // window.document.location = window.document.location.origin;
                            return false;

                        }
                   
                    }
                }

            });
        }

        close;
    }

}
