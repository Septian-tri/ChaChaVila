var notificationMode    = "Tampilkan";
var bPorses             = document.getElementById("bProses");
var bolProses           = false;


if(bProses === undefined || bProses === null){
    
    alert("kami mengalami ke gagalan memmuat komponen !");
    sendToHome.send();

}else{
    
    bProses.onclick = function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        e.stopPropagation();

        var dataUser            = {

            "idUnikVilla"       : orderData['idUnikVilla'],
            "tanggalCheckIn"    : ""

        }
        
        //Kirim data ke loginSystem.php
        if(bolProses === false){
                
            $.ajax({
                url         : document.location.origin + "/settings/ProsesSystem/bookingSystem.php",
                data        : dataUser,
                accepts     : "text/html",
                method      : "POST",
                crossDomain : false,
                beforeSend  : function(){
                        
                    bolProses = true;
                    disabledButtonSend("id", "bProses", "disabled", 'Loading');
                    
                }, //tambahkan animasi loading. ganti tulisan 'loading' e.g '<div class="loading"></div>'
                complete    : function(){
                        
                    bolProses = false;
                    
                    
                },
                error       : function(jqXHR){
                        
                    bolProses = true;
                    disabledButtonSend("id", "bProses", "disabled", 'Bayar Dan Check In');
                    messageNotification(mappingErrorNetwork[jqXHR.status], 'Tampilkan');
                    
                },
                success     : function(response){

                    disabledButtonSend("id", "bProses", "enabled", "Bayar Dan Check In");
                        
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
                                    window.document.location.href = window.document.URL;
                                    window.document.getElementsByClassName("card-body")[0].removeChild(bProses);
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