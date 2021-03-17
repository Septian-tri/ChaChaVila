var mappingErrorNetwork    = {
    "0"   : "Opps..Maaf Periksa Kembali Jaringan Kamu ya. Code : NW",
    "400" : "Permintaan Buruk",
    "403" : "Akses Telah di larang",
    "409" : "Terjadi Konflik",
    "401" : "Permintaan Tidak Resmi",
    "404" : "Halaman Yang di tuju tidak di temukan",
    "500" : "Internal Server Error"
};


var sendToHome     = {
        send : function(){
            return window.document.location = window.document.location.origin;
        } 
    } 

// Fungsi matikan tombol ketika pengiriman data berlangsung
function disabledButtonSend(type, button, action, buttonValue){


    var tempButtonName = button;
    

    switch(type){

        case 'class' :
            var buttonObject = window.document.getElementsByClassName(button)[0];
        break;

        case 'id' :
            var buttonObject = window.document.getElementById(button);
        break;

        default:
            alert("Kami tidak dapat menumakan ' + type + ' yang diminta");
            sendToHome.send();
        break;

    }

    if(buttonObject === null || buttonObject === undefined){

        alert ("Kami tidak dapat menumakan " + type + " yang diminta");
        sendToHome.send();

    }else{

        if(action === "enabled"){

            buttonObject.removeAttribute("disabled");
            buttonObject.innerHTML = buttonValue;

        }else if(action === "disabled"){

            buttonObject.setAttribute("disabled", "disabled");
            buttonObject.innerHTML = buttonValue;

        }else{

            sendToHome.send() + "?sadsda";
            close;

        }
    }
}

function notifikasiPesan(Pesan, Mode){
    
    function buatDiv(PesanDiv, modeDiv){

        var elemenNotifikasi = document.getElementsByClassName('notifikasi')[0];
        
        if(elemenNotifikasi !== undefined){
            
            hapusElemen('notifikasi', 'class');
            
        }

        
            if(modeDiv === null && PesanDiv !== null){
                
                var elemenDiv               = document.createElement('div');
                elemenDiv.className         = "notifikasi";
                elemenDiv.innerHTML         = '<div class="isiNotif">'+ PesanDiv + '</div>' + '<div class="sembunyikan">TUTUP</div>';
                
                masukinElement('sebelum', 'header', 'tag', elemenDiv);
                
                posisikanNotifikasi();

                document.getElementsByClassName("sembunyikan")[0].onclick = function(){
                    
                    if(document.getElementsByClassName("sembunyikan")[0] !== undefined){

                        hapusElemen('notifikasi', 'class');

                    }

                };

            }else{

                hapusElemen('notifikasi', 'class');

            }
        
    }

    if(boolNotifikasi === Mode){
        
        return buatDiv(Pesan, null);

    }else{

        return buatDiv(null, Mode);

    }
}


function messageNotification(Pesan, Mode){
    
    function buatDiv(PesanDiv, modeDiv){

        var elemenNotifikasi = document.getElementsByClassName('notifikasi')[0];
        
        if(elemenNotifikasi !== undefined){
            
            hapusElemen('notifikasi', 'class');
            
        }

        
            if(modeDiv === null && PesanDiv !== null){
                
                var elemenDiv               = document.createElement('div');
                elemenDiv.className         = "notifikasi";
                elemenDiv.innerHTML         = '<div class="isiNotif">'+ PesanDiv + '</div>' + '<div class="sembunyikan">TUTUP</div>';
                
                masukinElement('sebelum', 'header', 'tag', elemenDiv);
                
                posisikanNotifikasi();

                document.getElementsByClassName("sembunyikan")[0].onclick = function(){
                    
                    if(document.getElementsByClassName("sembunyikan")[0] !== undefined){

                        hapusElemen('notifikasi', 'class');

                    }

                };

            }else{

                hapusElemen('notifikasi', 'class');

            }
        
    }

    if(boolNotifikasi === Mode){
        
        return buatDiv(Pesan, null);

    }else{

        return buatDiv(null, Mode);

    }
}

function errorBidangInputData(bidangInputId, Pesan, Mode){
    
    var errorBidangIntId = document.querySelectorAll("#" + bidangInputId)[0];

    if(tempBidangError.length > 0){

        var errorTempBidangData     = document.querySelectorAll("#" + tempBidangError)[0];
        
    }

    notifikasiPesan(Pesan, Mode);
    
    if(errorBidangIntId !== undefined){

        if(tempBidangError.length === 0){
            
            errorBidangIntId.style.cssText =  "border: 1px solid #e91e63; color: #88606d; background-color: #ffd5e3;";
            errorBidangIntId.focus();
            tempBidangError = bidangInputId;

        }else if(tempBidangError === bidangInputId){

            errorBidangIntId.style.cssText =   "border: 1px solid #e91e63; color: #88606d; background-color: #ffd5e3;";
            errorBidangIntId.focus();
            tempBidangError = bidangInputId;

        }else{

            errorTempBidangData.style.cssText =  "border: 1px solid #5cb3e7; color: #6f6f6f; background-color: #ffffff;";
            errorBidangIntId.style.cssText =  "border: 1px solid #e91e63; background-color: #ffd5e3; color: #88606d;";
            errorBidangIntId.focus();
            tempBidangError = bidangInputId;

        }
    
    }else{

        if(errorTempBidangData !== undefined){
        
            errorTempBidangData.style.cssText =  "border: 1px solid #5cb3e7; color: #6f6f6f; background-color: #ffffff;";
        
        }
    }
}

function muatDivAja(metode, div, lokasi, fungsiSukses){
    
    var mintaXML = new XMLHttpRequest();
    var parseDOM = new DOMParser();

    mintaXML.open(metode, lokasi, true);
    mintaXML.onreadystatechange = function(){
    
        if(mintaXML.readyState != 4 || mintaXML.status != 200) return false;

            window.document.getElementsByClassName(div)[0].innerHTML =  parseDOM.parseFromString(mintaXML.responseText,"text/html").getElementsByClassName(div)[0].innerHTML;
            fungsiSukses;
        }

    mintaXML.send();
}

function masukinElement (mode, elementAwal, tipeElementAwal, elemen3){                   

    switch(tipeElementAwal){

        case 'tag' :
            var elemen1 = document.getElementsByTagName(elementAwal)[0];
        break;

        case 'id' :
            var elemen1 = document.getElementById(elementAwal);
        break;

        case 'class' :
            var elemen1 = document.getElementsByClassName(elementAwal)[0];
        break;

        default :
            alert("Maaf tipe tag tidak di ketahui !");
            return false;
        break;

    }


    if(elemen1 === undefined || elemen1 === null || elemen3 == undefined || elemen3 === null){

       console.log("elemen tidak di temukan");
       return false;

    }else{

        var elemen2 = elemen1.parentNode;
        
        if(mode === "sebelum"){
            elemen2.insertBefore(elemen3, elemen1);
        }else if(mode === "sesudah"){
            elemen1.appendChild(elemen3);
        }

    }

}