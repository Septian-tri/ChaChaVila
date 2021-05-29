var boolLogin           = false;
var boolNoticeData      = false;
var notificationMode    = "Tampilkan";
var lgnBtnUs              = document.getElementById("lgnBtnUs");
var regFilter           = (/^[^\s]*$/gi); 


if(lgnBtnUs === undefined || lgnBtnUs === null){
    
    alert("kami mengalami ke gagalan memmuat komponen !");
    sendToHome.send();

}else{
    
    lgnBtnUs.onclick = function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        e.stopPropagation();

        var dataUser            = {

            "email"         : document.getElementById("email").value,
            "password"      : document.getElementById("password").value

        }
        
        //Kirim data ke loginSystem.php
        if(boolLogin === false){
                
            $.ajax({
                url         : document.location.origin + "/settings/ProsesSystem/loginSystemUs.php",
                data        : dataUser,
                accepts     : "text/html",
                method      : "POST",
                crossDomain : false,
                beforeSend  : function(){
                        
                    boolLogin = true;
                    disabledButtonSend("id", "lgnBtnUs", "disabled", 'Loading');
                    
                }, //tambahkan animasi loading. ganti tulisan 'loading' e.g '<div class="loading"></div>'
                complete    : function(){
                        
                    boolLogin = false;
                    
                    
                },
                error       : function(jqXHR){
                        
                    boolLogin = true;
                    disabledButtonSend("id", "lgnBtnUs", "disabled", 'Login');
                    messageNotification(mappingErrorNetwork[jqXHR.status], 'Tampilkan');
                    
                },
                success     : function(response){

                    disabledButtonSend("id", "lgnBtnUs", "enabled", "Login");
                        
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
                                    
                                case 'OKE' :
                                    window.document.location.href = '/';
                                    window.document.getElementsByClassName("flg")[0].removeChild(lgnBtnUs);
                                break;

                                default :
                                    alert('Maaf Kami mengalami masalah sistem :( . Code : ' + messageType);
                                    return false;
                                break;
                            }
                                
                        }catch(e){

                            console.log(response + " " + e);
                            alert("Maaf Kami melihat ada Sesuatu Yang kurang Baik, kami akan Merload Halaman kamu !");
                            return false;

                        }
                        
                    }

                }

            });
        }

    }

}