var btnAdd              = document.getElementById("advBtn");
var notificationMode    = "Tampilkan";
var boolAddVilla        = false;

btnAdd.onclick = function(e){

    e.preventDefault();
    e.stopImmediatePropagation();
    e.stopPropagation();

    var dataUser            = {

        "namavilla"      : document.getElementById("NamaVilla").value, 
        "alamatvilla"    : document.getElementById("AlamatVilla").value, 
        "hargavilla"     : document.getElementById("HargaVilla").value,
        "deskripsivilla" : document.getElementById("deskripsi").value,
        "thumbnail"      : document.getElementById("ThumbnailVilla").files[0]
    
    }

        if(boolAddVilla === false){
            
            $.ajax({
                url         : document.location.origin + "/settings/ProsesSystem/addVillaSystem.php",
                data        : dataUser,
                accepts     : "text/html",
                method      : "POST",
                crossDomain : false,
                beforeSend  : function(){
                    
                    boolAddVilla = true;
                    disabledButtonSend("id", "advBtn", "disabled", 'Loading');
                
                }, //tambahkan animasi loading. ganti tulisan 'loading' e.g '<div class="loading"></div>'
                complete    : function(){
                    
                    boolAddVilla = false;
                    disabledButtonSend("id", "advBtn", "enabled", "Tambahkan Villa");
                
                },
                error       : function(jqXHR){
                    
                    boolAddVilla = true;
                    disabledButtonSend("id", "advBtn", "disabled", 'Loading');
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

 
      