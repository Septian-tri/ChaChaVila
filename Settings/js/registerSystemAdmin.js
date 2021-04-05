var boolLogin           = false;
var boolNoticeData      = false;
var notificationMode    = "Tampilkan";
var regButton           = document.getElementById("regAbtn");
var regFilter           = (/^[^\s]*$/gi); 


if(regButton === undefined || regButton === null){
    
    alert("kami mengalami ke gagalan memmuat komponen !");
    sendToHome.send();

}else{
    regButton.onclick = function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        e.stopPropagation();

        var dataUser            = {
    
            "namaadmin"      : document.getElementById("namaadmin").value, 
            "emailadmin"     : document.getElementById("emailadmin").value, 
            "nomorhandphone" : document.getElementById("nomorhandphone").value,
            "password"       : document.getElementById("password").value,
            "repassword"     : document.getElementById("repassword").value
        
        }
        
        //Kirim data ke registersystem.php
        function sendData(){

            if(boolLogin === false){
                
                $.ajax({
                    url         : document.location.origin + "/settings/ProsesSystem/registerSystemAdmin.php",
                    data        : dataUser,
                    accepts     : "text/html",
                    method      : "POST",
                    crossDomain : false,
                    beforeSend  : function(){
                        
                        boolLogin = true;
                        disabledButtonSend("id", "regAbtn", "disabled", 'Loading');
                    
                    }, //tambahkan animasi loading. ganti tulisan 'loading' e.g '<div class="loading"></div>'
                    complete    : function(){
                        
                        boolLogin = false;
                        disabledButtonSend("id", "regAbtn", "enabled", "DAFTAR SEKARANG");
                    
                    },
                    error       : function(jqXHR){
                        
                        boolLogin = true;
                        disabledButtonSend("id", "regAbtn", "disabled", 'Loading');
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

                                console.log(response + " " + e);
                                alert("Maaf Kami melihat ada Sesuatu Yang kurang Baik, kami akan Merload Halaman kamu !");
                                // window.document.location = window.document.location.origin;
                                return false;

                            }
                        
                        }

                    }

                });
            }

        }

        if(dataUser.emailadmin.length > 0 && dataUser.emailadmin.match(/^[a-zA-Z0-9]+[a-zA-Z0-9\.\-\_]+[a-zA-Z0-9]+[\@]{1}[a-zA-Z0-9\-\_]+[\.]{1}[a-zA-Z]{2,}$/gi) !== null){

            if(boolNoticeData === true){

                sendData();
                return false

            }else{

                if(window.confirm("Periksa Kembali emailadmin kamu ya " + dataUser.emailadmin + " .Sudah Sesuai ? Klik Oke") === true){

                    sendData();
                    boolNoticeData = true;
                    return false

                }

                return false;
            }

        }else{

            styleWrong('emailadmin');
            return false;

        }

    }

}