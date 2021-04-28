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
            
            if(FV[i].files[0] !== undefined){
                
                if(FV[i].id.split("_")[0] === "FVG"){

                    if(FV[i].files.length > 5){

                        alert("Maaf Batas Maksimal Memasukan Gambar Pada Fasilitas Vilaa, Maksimal 5 gambar");
                        styleWrong(FV[i].id);
                        return false;

                    }else{

                        for(var j = 0; j < FV[i].files.length; j++){

                            
                            if(FV[i].files[j].size > 1048576){

                                alert("Maaf Proses tidak dapat di lanjut kan file dengan nama " + FV[i].files[j].name + " Memiliki Ukuran lebih dari 1 MB");
                                styleWrong(FV[i].id);
                                return false;

                            }else{

                                fileFormat.append(FV[i].id + "[]", FV[i].files[j]);
                                console.log(FV[i].files.length);


                            }

                        }

                    }

                }else{

                    fileFormat.append(FV[i].id, FV[i].files[0]);

                }

            }
        
        }else if(FV[i].type === "text" || FV[i].type === "textarea"){
            
            if(FV[i].id === "HargaVilla"){
                
                fileFormat.append(FV[i].id, FV[i].value.split(".").join(""));
            
            }else if(FV[i].id === "deskripsi"){
                
                fileFormat.append(FV[i].id, tinymce.activeEditor.getContent());
                
            }else{

                fileFormat.append(FV[i].id, FV[i].value);
            }
        
        }
    }
    
    if(boolAddVilla === false){
            
        $.ajax({
            url         : document.location.origin + "/settings/ProsesSystem/addVillaSystem.php",
            data        : fileFormat,
            method      : "POST",
            contentType : false,
            cache       : false,
            processData : false,
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

 
      