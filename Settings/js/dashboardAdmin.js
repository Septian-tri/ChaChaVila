var btnAdd              = document.getElementById("advBtn");
var notificationMode    = "Tampilkan";
var boolAddVilla        = false;


document.getElementById("HargaVilla").onkeyup = function(){

    if(this.value.split(".").join("").match(/^[0-9]*$/g)){

        this.value = this.value.split(".").join("").replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
        
    }else{

        this.value = "";

    }
    
}

btnAdd.onclick = function(e){

    e.preventDefault();
    e.stopImmediatePropagation();
    e.stopPropagation();

    var fileFormat  = new FormData();
    var FV          = document.getElementsByClassName("FV");

    for(var i = 0; i < FV.length; i++){
        
        if(FV[i].type === "checkbox"){
            
            fileFormat.append(FV[i].id, FV[i].checked);
        
        }else if(FV[i].type === "file"){
            
            if(FV[i].files[0] === undefined){
                
                fileFormat.append(FV[i].id, "TA_FOTO");
            
            }else{
                
                fileFormat.append(FV[i].id, FV[i].files[0]);
            }
        
        }else if(FV[i].type === "text"){
            
            fileFormat.append(FV[i].id, FV[i].value);
        
        }
    }

        if(boolAddVilla === false){
            
            $.ajax({
                url         : document.location.origin + "/settings/ProsesSystem/addVillaSystem.php",
                data        : fileFormat,
                accepts     : "text/html",
                method      : "POST",
                contentType : false,
                processData : false,
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

 
      