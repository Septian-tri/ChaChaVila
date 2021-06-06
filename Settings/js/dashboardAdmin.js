var btnAdd              = document.getElementById("advBtn");
var smNotif             = document.getElementById("smNotif");
var notificationMode    = "Tampilkan";
var boolAddVilla        = false;

window.document.onkeyup = function(e){
    e.stopPropagation();
    e.stopImmediatePropagation();
    e.preventDefault();

    var target = e.target; 

    if(target.id === "HargaVilla"){

        smNotif.innerHTML = "* Jika tidak memilki discount, biarkan field discount kosong";

        if(target.value.split(".").join("").match(/^[0-9]*$/g)){

            target.value = target.value.split(".").join("").replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
            
        }else{
            
            target.value = "";
            document.getElementById("HargaVillaDisc").value = "";
            
        }

        if(target.value.length <= 0){

            document.getElementById("HargaVillaDisc").value = "";
        
        }

    }else if(target.id === "HargaVillaDisc"){

        if(document.getElementById("HargaVilla") !== undefined && document.getElementById("HargaVilla") !== null){
         
            if(document.getElementById("HargaVilla").value.length > 0){
            
                if(!target.value.split(".").join("").match(/^[0-9]*$/g)){

                    target.value = "";
                    document.getElementById("HargaVilla").focus();    

                }else{

                    target.value = target.value.split(".").join("").replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
 
                    if(parseInt(target.value.split(".").join("")) > parseInt(document.getElementById("HargaVilla").value.split(".").join(""))){

                        smNotif.innerHTML = "* Discount tidak dapat lebih besar dari Harga villa !";
                        smNotif.style.cssText = "color : #"+ Math.floor(Math.random() * 999999) + ";";
                        target.value = "";

                        return false;
                    }

                }

            }else{

                target.value = "";
                smNotif.innerHTML = "* Silahkan isi Terlebih dahulu harga Villa !";
                document.getElementById("HargaVilla").focus();

            }

        }else{

            target.value = "";
            return false;

        }

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

                            }

                        }

                    }

                }else{

                    fileFormat.append(FV[i].id, FV[i].files[0]);
                    
                }

            }else{

                fileFormat.append(FV[i].id, FV[i].files[0]);

            }
        
        }else if(FV[i].type === "text" || FV[i].type === "textarea"){
            
            if(FV[i].id === "HargaVilla"){
                
                fileFormat.append(FV[i].id, FV[i].value.split(".").join(""));
            
            }else if(FV[i].id === "HargaVillaDisc"){

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

 
      