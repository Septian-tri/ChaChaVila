var btnAdd              = document.getElementById("updBtn");
var notificationMode    = "Tampilkan";
var boolupdBtn          = false;
var FV                  = document.querySelectorAll(".FV");
var ckhHapus            = document.querySelectorAll(".CKH");
var UPG                 = document.querySelectorAll(".UPG");
var upgLength           = UPG.length;        

//validasi harga villa
document.getElementById("HargaVilla").onkeyup = function(){

    if(this.value.split(".").join("").match(/^[0-9]*$/g)){

        this.value = this.value.split(".").join("").replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
        
    }else{

        this.value = "";

    }
    
}

//validasi ketikan checkbox hapus di aktifkan
for(var j = 0; j < ckhHapus.length; j++){
  
    ckhHapus[j].onchange = function(e){
        
        upgLength = document.querySelectorAll(".UPG").length;
        var hasilID = "";

        for(var k = 1; k < e.target.id.split("_").length; k++){

            if(k == e.target.id.split("_").length-1){

                hasilID+=e.target.id.split("_")[k];  

            }else{

                hasilID+=e.target.id.split("_")[k] + "_";

            }

        }

        if(e.target.checked){
            
            var UPGfile = document.getElementById(hasilID);
                
                if(UPGfile === undefined || UPGfile === null){

                    hasilID = "";
                    UPGfile.value = "";
                    alert("ID Tidak DI temukan");

                }else{

                    if(UPGfile.files.length > 0){

                        hasilID = "";
                        UPGfile.value = "";
                        alert("Tidak dapat mengupadate foto, saat HAPUS di aktifkan !");

                    }

                }
        }

        hasilID = ""; 

    }

}

//validasi input files ketika checkbox di aktifikan
for(var k = 0; k < upgLength; k++){

    UPG[k].onchange = function(e){

        if(e.target.files[0].size > 1048576){

            alert("Maaf Proses tidak dapat di lanjut kan file dengan nama " + e.target.files[0].name + " Memiliki Ukuran lebih dari 1 MB");
            e.target.value = "";
            styleWrong(e.target.id);

        }else{
            
            var HCK = document.getElementById("HCK_" + e.target.id);
            
            if(HCK === undefined || HCK === null){

                e.target.value = "";
                alert("ID Tidak DI temukan");

            }else{

                if(HCK.checked){

                    e.target.value = "";
                    alert("Tidak dapat mengupadate foto, saat HAPUS di aktifkan !");

                }
            
            }

        }

    }

}


//up


btnAdd.onclick = function(e){

    e.preventDefault();
    e.stopImmediatePropagation();
    e.stopPropagation();

    var fileFormat          = new FormData();
    var arrayHapus          = [];
    var nomrUrutHapusID     = 0;

    //validasi Semmua input field
    for(var i = 0; i < FV.length; i++){

        if(FV[i].type === "checkbox"){

            if(FV[i].id.split("_")[0] === "HCK"){
                
                if(FV[i].checked){

                    arrayHapus.push(FV[i].id)[nomrUrutHapusID];
                    nomrUrutHapusID++;
                
                }

            }else{
                
                fileFormat.append(FV[i].id, FV[i].checked);

            }
        
        }else if(FV[i].type === "file"){
            
            if(FV[i].files[0] !== undefined){
                
                if(FV[i].id.split("_")[0] === "FVG"){

                    if(FV[i].files.length > 5){

                        alert("Maaf Batas Maksimal Memasukan Gambar Pada Fasilitas Vilaa, Maksimal 5 gambar");
                        styleWrong(FV[i].id);
                        FV[i].value = "";
                        return false;

                    }else{

                        for(var j = 0; j < FV[i].files.length; j++){

                            if(FV[i].files[j].size > 1048576){

                                alert("Maaf Proses tidak dapat di lanjut kan file dengan nama " + FV[i].files[j].name + " Memiliki Ukuran lebih dari 1 MB");
                                styleWrong(FV[i].id);
                                FV[i].value = "";
                                return false;

                            }else{

                                fileFormat.append(FV[i].id + "[]", FV[i].files[j]);

                            }

                        }

                    }

                }else if(FV[i].id.split("_")[0] === "UFVG"){

                    if(FV[i].files.length > 1){

                        alert("Maaf Batas Maksimal Memasukan Gambar Pada Fasilitas Vilaa, Maksimal 1 gambar");
                        styleWrong(FV[i].id);
                        FV[i].value = "";
                        return false;

                    }else{

                        for(var k = 0; k < FV[i].files.length; k++){

                            if(FV[i].files[k].size > 1048576){

                                alert("Maaf Proses tidak dapat di lanjut kan file dengan nama " + FV[i].files[k].name + " Memiliki Ukuran lebih dari 1 MB");
                                styleWrong(FV[i].id);
                                FV[i].value = "";
                                return false;

                            }else{

                                fileFormat.append(FV[i].id, FV[i].files[0]);

                            }

                        }
                    }
                }

            }else{

                fileFormat.append(FV[i].id, FV[i].files[0]);

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

    for(var l = 0; l < upgLength; l++){
        
        if(UPG[l].files.length === 1){
            
            if(UPG[l].files[0].size > 1048576){

                alert("Maaf Proses tidak dapat di lanjut kan file dengan nama " + UPG[l].files[0].name + " Memiliki Ukuran lebih dari 1 MB");
                styleWrong(UPG[l].id);
                UPG[l].value = "";
                return false;

            }else{
                
                abcd = "";

                for( var aaa = 0; aaa < UPG[l].id.split("_").length; aaa++){

                    if(aaa !== UPG[l].id.split("_").length-1){

                       strip = "_";

                    }else{

                        strip = "";

                    }

                    if(aaa !== 0){

                        abcd+=UPG[l].id.split("_")[aaa] + strip;

                    }

                }

                fileFormat.append("Update_" + abcd.split(".").join("-"), UPG[l].files[0]);

            }
        }
    }

    fileFormat.append("IDUV", IDUV());
    fileFormat.append("KODE", KODE());
    fileFormat.append("HAPUS", arrayHapus);

    if(boolupdBtn === false){
            
        $.ajax({
            url         : document.location.origin + "/settings/ProsesSystem/updateVillaSystem.php",
            data        : fileFormat,
            method      : "POST",
            contentType : false,
            cache       : false,
            processData : false,
            beforeSend  : function(){
                    
                boolupdBtn = true;
                disabledButtonSend("id", "updBtn", "disabled", 'Loading');
                
            }, //tambahkan animasi loading. ganti tulisan 'loading' e.g '<div class="loading"></div>'
            complete    : function(){
                    
                boolupdBtn = false;
                disabledButtonSend("id", "updBtn", "enabled", "Update Villa");
                
            },
            error       : function(jqXHR){
                    
                boolupdBtn = true;
                disabledButtonSend("id", "updBtn", "disabled", 'Loading');
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

                                case 'OKE' :
                                    messageNotification(messageNotif, 'Tampilkan');
                                    // window.location.reload();
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
      