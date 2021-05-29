var btnUpdt             = document.getElementsByClassName("UVilla");
var notificationMode    = "Tampilkan";
var boolDelVilla        = false;
var boolUpVilla         = false;


window.document.onclick = function(e){
    
    if(e.target.classList[0] === "HVilla"){

        e.stopPropagation();
        e.stopImmediatePropagation();
        e.preventDefault();

        if(!e.target.id.match(/^[0-9a-fA-F]*$/g)){

            alert("JANGAN DI EDIT");
            return false;

        }else{

            if(window.confirm("SELURU DATA YANG DI UPLOAD AKAN TERHAPUS PERMANENT, Yakin ingin Menghapus Villa dengan ID " + e.target.id + " ? " )){

                if(boolDelVilla === false){

                    var id = e.target.id;

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

                                            case 'OKE' : 
                                                muatDivAja("POST", "page-content", window.document.URL,  messageNotification(messageNotif, 'Tampilkan'));
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
       
    }else if(e.target.classList[0] === "HVilla"){

        

    }

}