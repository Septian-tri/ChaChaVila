var mappingErrorNetwork    = {
    "0"   : "Opps..Maaf Periksa Kembali Jaringan Kamu ya. Code : NW",
    "400" : "Permintaan Buruk",
    "403" : "Akses Telah di larang",
    "409" : "Terjadi Konflik",
    "401" : "Permintaan Tidak Resmi",
    "404" : "Halaman Yang di tuju tidak di temukan",
    "500" : "Internal Server Error"
};


// Fungsi matikan tombol ketika pengiriman data berlangsung
function disabledButtonSend(type, button, action, buttonValue){


    var tempButtonName = button;
    var sendToHome     = {
        send : function(){
            return window.document.location = window.document.location.origin;
        } 
    } 

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

// fungsi tampilkan pesa, edit disini  untuk mengatur pesan notifikasi yang tampil
function messageNotification(Pesan, Mode){
    
    function buatDiv(PesanDiv, modeDiv){

        var elemenNotifikasi = document.getElementsByClassName('notifikasi')[0];
        
        if(elemenNotifikasi !== undefined){
            
            hapusElemen('notifikasi', 'class');
            
        }

        
            if(modeDiv === null && PesanDiv !== null){
                
                var elemenDiv               = document.createElement('div');
                elemenDiv.className         = "notifikasi";
                elemenDiv.innerHTML         = '<div class="isiNotif">'+ PesanDiv + '</div>' + '<div class="sembunyikan">TUTUP</div>'; //edit modal notifikasi disini 
                
                addObject('sebelum', 'header', 'tag', elemenDiv);
                
                notificationCentered();

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

//untuk fungsi seperti apend atau prepend
function addObject(mode, elementAwal, tipeElementAwal, elemen3){                   

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


    if(elemen1 === undefined || elemen1 === null || elemen3 === undefined || elemen3 === null){

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

//Posisikan ketengah object notifikasi
function notificationCentered(){
                
    var elemenNotifikasi2   = document.getElementsByClassName('notifikasi')[0];

    if(elemenNotifikasi2 !== undefined){
    
        var ukuranLayar         = window.innerWidth;
        var ukuranNotifikasi    = elemenNotifikasi2.clientWidth;
        var kalkulasiPosisi     = Math.ceil((ukuranLayar-ukuranNotifikasi)/2);
        elemenNotifikasi2.style.cssText = "left: " + kalkulasiPosisi + "px;";
    
    }
    
}
