var btnHps              = document.getElementsByClassName("HVilla");
var btnUpdt             = document.getElementsByClassName("UVilla");
var notificationMode    = "Tampilkan";
var boolDelVilla        = false;
var boolUpVilla         = false;

for(var i = 0; i < btnHps.length; i++){

    btnHps[i].onclick = function(e){

        e.stopPropagation();
        e.stopImmediatePropagation();
        e.preventDefault();

        if(!this.id.match(/^[0-9a-fA-F]*$/g)){

            alert("JANGAN DI EDIT");
            return false;

        }else{

            if(window.confirm("SELURU DATA YANG DI UPLOAD AKAN TERHAPUS PERMANENT, Yakin ingin Menghapus Villa dengan ID " + this.id + " ? " )){

                if(boolDelVilla === false){

                    var id = this.id;

                    $.ajax({
                        url         : "../../Settings/ProsesSystem/listVillaSystem.php",
                        data        : {"IDUV" : id, "KODE" : "HAPUS"},
                        method      : "POST",
                        beforeSend  : function(){
                                
                            boolDelVilla = true;
                            disabledButtonSend("id", id, "disabled", '<i class="fa fa-spinner"></i>');
                            
                        }, //tambahkan animasi loading. ganti tulisan 'loading' e.g '<div class="loading"></div>'
                        complete    : function(){
                                
                            boolDelVilla = false;
                            disabledButtonSend("id", id, "enabled", '<i class="fa fa-trash"></i>');
                            
                        },
                        error       : function(jqXHR){
                                
                            boolDelVilla = true;
                            disabledButtonSend("id", id, "disabled", '<i class="fa fa-spinner"></i>');
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

        }
       
    }

}

// for(var j = 0; j < btnUpdt.length; j++){

//     btnUpdt[j].onclick = function(e){

//         e.stopPropagation();
//         e.stopImmediatePropagation();
//         e.preventDefault();

//         if(!this.id.match(/^[U]{1}[\.]{1}[0-9a-fA-F]*$/g)){

//             alert("JANGAN DI EDIT");
//             return false;

//         }else{

//                 if(boolUpVilla === false){

//                     var idu   = this.id;
//                     var dataU = new FormData();
//                         dataU.append("IDUV", this.id.split(".")[1]);
//                         dataU.append("KODE", "UPDATE");

//                     $.ajax({
//                         url         : "../../Admin/VillaCustomize/update_villa.php",
//                         data        : dataU,
//                         method      : "POST",
//                         processData : false,
//                         contentType : false,
//                         beforeSend  : function(){
                                
//                             boolUpVilla = true;
//                             disabledButtonSend("id", idu, "disabled", '<i class="fa fa-spinner"></i>');
                            
//                         }, //tambahkan animasi loading. ganti tulisan 'loading' e.g '<div class="loading"></div>'
//                         complete    : function(){
                                
//                             boolUpVilla = false;
//                             disabledButtonSend("id", idu, "enabled", '<i class="fa fa-cog text-white"></i>');
                            
//                         },
//                         error       : function(jqXHR){
                                
//                             boolUpVilla = true;
//                             disabledButtonSend("id", idu, "disabled", '<i class="fa fa-spinner"></i>');
//                             messageNotification(mappingErrorNetwork[jqXHR.status], 'Tampilkan');
                            
//                         },
//                         success     : function(response){
                                
//                             if(response){
                                    
//                                 try{
                                        
//                                     var parseJson               = JSON.parse(response);
//                                     var messageType             = parseJson.messageType;
//                                     var messageNotif            = parseJson.messageNotif;
//                                     var messageFieldError       = parseJson.messageFieldErrorObject;
                
//                                         switch(messageType){
                                            
//                                             case 'notification' :
//                                                 messageNotification(messageNotif, 'Tampilkan');
//                                             break;
                                            
//                                             case 'OKE' :
//                                                 messageNotification(messageNotif, 'Tampilkan');
//                                                 window.location.href = "../../Admin/VillaCustomize/update_villa.php";
//                                             break;
                                            
//                                             default :
//                                                 alert('Maaf Kami mengalami masalah sistem :( . Code : ' + messageType);
//                                                 return false;
//                                             break;
//                                         }
                                        
//                                     }catch(e){
                
//                                         console.log(response + " " + e);
//                                         alert("Maaf Kami melihat ada Sesuatu Yang kurang Baik, kami akan Merload Halaman kamu !");
//                                         // window.document.location = window.document.location.origin;
//                                         return false;
                
//                                     }
                                
//                                 }
                
//                             }
                
//                     });

//                 }

//         }
       
//     }

// }