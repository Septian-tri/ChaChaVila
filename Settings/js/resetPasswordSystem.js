var rpb                 = document.getElementsByClassName('reset-password-box')[0];
var boolReset           = false;
var resetButton         = document.getElementById("resetbtn");
var riquestMode         = "mReset";
var boolNoticeData      = false;
var tempBidangDataRPB   = "";
var notificationMode    = "Tampilkan";
var timeOut;   

if(resetButton === null || resetButton === undefined){

    alert("kami mengalami ke gagalan memmuat komponen !");
    sendToHome.send();

}else{

    resetButton.onclick = function(e){
        e.stopPropagation();
        e.preventDefault();
        e.stopImmediatePropagation();
        
        if(riquestMode === 'lReset' && tempBidangDataRPB.length > 0){

            var dataReset            = {

                "kodeToken"     : document.getElementById("kodeToken").value, 
                "password"      : document.getElementById("password").value,
                "repassword"    : document.getElementById("repassword").value,
                "riquestMode"   : riquestMode
    
            }

        }else{

            var dataReset            = {

                "email"       : document.getElementById("email").value, 
                "phonenumber" : document.getElementById("phonenumber").value,
                "riquestMode" : riquestMode
    
            }

        }

        if(boolReset === false){

            $.ajax({
                url         : document.location.origin + "/settings/ProsesSystem/resetPasswordSystem.php",
                data        : dataReset,
                accepts     : "text/html",
                method      : "POST",
                crossDomain : false,
                beforeSend  : function(){
                    
                    boolReset = true;
                    disabledButtonSend("id", "resetbtn", "disabled", 'Loading');
                
                }, //tambahkan animasi loading. ganti tulisan 'loading' e.g '<div class="loading"></div>'
                complete    : function(){
                    
                    boolReset = false;
                    disabledButtonSend("id", "resetbtn", "enabled", "RESET PASSWORD");
                
                },
                error       : function(jqXHR){
                    
                    boolReset = true;
                    disabledButtonSend("id", "resetbtn", "disabled", 'Loading');
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

                                case 'OK' :

                                    riquestMode     = "lReset";
                                    
                                    messageNotification(messageNotif, 'Tampilkan');
                                    tempBidangDataRPB = "";
                                    tempBidangDataRPB += rpb.innerHTML;
                                    rpb.innerHTML     = "";

                                    for(var i = 0; i < 3; i++){
                            
                                            var buatObjectDiv = createElement('div', {'class' : 'form-group first'});
                                            insertElement('sesudah', 'reset-password-box', 'class', buatObjectDiv);

                                    }

                                    var formGroup               = document.getElementsByClassName('form-group');
                                    var buatObjectToken         = createElement(
                                        'input', 
                                        {
                                            'type'          : 'text',
                                            'placeholder'   : 'Masukan Kode Token', 
                                            'id'            : 'kodeToken',
                                            'class'         : 'form-control',
                                            'maxlength'     : '32'
                                        });
                                    var buatObjectPassword      = createElement(
                                        'input', 
                                        {
                                            'type'          : 'password',
                                            'placeholder'   : 'Masukan Password Baru', 
                                            'id'            : 'password',
                                            'class'         : 'form-control',
                                            'maxlength'     : '100'
                                        });
                                    var buatObjectRepassword    =  createElement(
                                        'input', 
                                        {
                                            'type'          : 'password',
                                            'placeholder'   : 'Konfirmasi Password Baru', 
                                            'id'            : 'repassword',
                                            'class'         : 'form-control',
                                            'maxlength'     : '100'
                                        });
                                        
                                        formGroup[0].appendChild(buatObjectToken);
                                        formGroup[1].appendChild(buatObjectPassword);
                                        formGroup[2].appendChild(buatObjectRepassword);

                                        timeOut = setTimeout(function(){
                                            riquestMode   = 'mReset';
                                            rpb.innerHTML = "";
                                            rpb.innerHTML = tempBidangDataRPB;
                                            messageNotification('Silahkan Ulangi permintaan token sudah expired', 'Tampilkan');
                                        }, 300000);

                                break;

                                case 'SUKSES' :
                                        clearTimeout(timeOut);
                                        riquestMode   = 'mReset';
                                        rpb.innerHTML = "";
                                        rpb.innerHTML = tempBidangDataRPB;
                                        messageNotification(messageNotif, 'Tampilkan');
                                break;
                                
                                default :
                                    alert('Maaf Kami mengalami masalah sistem :( . Code : ' + messageType);
                                    sendToHome.send();
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