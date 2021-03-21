var boolNotification      = "Tampilkan";
var mappingErrorNetwork   = {
    "0"   : "Opps..Maaf Periksa Kembali Jaringan Kamu ya. Code : NW",
    "400" : "Permintaan Buruk",
    "403" : "Akses Telah di larang",
    "409" : "Terjadi Konflik",
    "401" : "Permintaan Tidak Resmi",
    "404" : "Halaman Yang di tuju tidak di temukan",
    "500" : "Internal Server Error"
};

//tambah / kurangi style bidang input data errror disini. silahkan ikuti aturan penulisan 
var styleWrongField     = Array(
    "background-color : red;",
    "Font-size : 20px;",
    "color : red;"
);

var sendToHome          = {
        send : function(){
            return window.document.location = window.document.location.origin;
        } 
    } 



// Fungsi matikan tombol ketika pengiriman data berlangsung, ganti style element pada bari 88 kode 22
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

//fungsi menampilkan floating notifkasi
function messageNotification(Pesan, Mode){
    
    function buatDiv(PesanDiv, modeDiv){

        var elemenNotifikasi = document.getElementsByClassName('notifikasi')[0];
        
        if(elemenNotifikasi !== undefined){
            
            deleteObjectElement('notifikasi', 'class');
            
        }

        
            if(modeDiv === null && PesanDiv !== null){
                
                var elemenDiv               = document.createElement('div');
                elemenDiv.className         = "notifikasi";
                elemenDiv.innerHTML         = '<div class="isiNotif">'+ PesanDiv + '</div>' + '<div class="sembunyikan">TUTUP</div>'; //Kode : 22 , ganti style notifikasi disini, style terdapat di file navbar
                
                insertElement('sebelum', 'nav', 'tag', elemenDiv); // silahkan rubah posisi div disini
                
                notificationPosition();

                document.getElementsByClassName("sembunyikan")[0].onclick = function(){
                    
                    if(document.getElementsByClassName("sembunyikan")[0] !== undefined){

                        deleteObjectElement('notifikasi', 'class');

                    }

                };

            }else{

                deleteObjectElement('notifikasi', 'class');

            }
        
    }

    if(boolNotification === Mode){
        
        return buatDiv(Pesan, null);

    }else{

        return buatDiv(null, Mode);

    }
}

//fungsi seperti append atau prepend
function insertElement(mode, elementAwal, tipeElementAwal, elemen3){                   

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

       console.log("elemen tidak di temukan" + elemen1);
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

//fungsing menghapus object
function deleteObjectElement(objectElement, tipeElemen){

    switch(tipeElemen){

        case 'tag' :
            
            var deleteElement = document.getElementsByTagName(objectElement)[0];

        break;

        case 'id' :

            var deleteElement = document.getElementById(objectElement);
            
        break;

        case 'class' :
            
            var deleteElement = document.getElementsByClassName(objectElement)[0];
        
        break;

        default :
            alert("Maaf tipe tag tidak di ketahui !");
            return false;
        break;

    }


    if(deleteElement === undefined || deleteElement === null){

        alert("Opps..Sorry kami kehilangan sala satu file, Coba lagi ! " + deleteElement + " " + objectElement + " " +tipeElemen);
        // sendToHome.send();

    }else{

        deleteElement.parentNode.removeChild(deleteElement);
        close;

    }

}

//posisikan notifikasi
function notificationPosition(){
                
    var elemenNotifikasi2   = document.getElementsByClassName('notifikasi')[0];

    if(elemenNotifikasi2 !== undefined){
    
        var ukuranLayar         = window.innerWidth;
        var ukuranNotifikasi    = elemenNotifikasi2.clientWidth;
        var kalkulasiPosisi     = Math.ceil((ukuranLayar-ukuranNotifikasi)/2);
        elemenNotifikasi2.style.cssText = "left: " + kalkulasiPosisi + "px;";
    
    }
    
}

//input error data
function styleWrongField(){ 

    let className       = document.getElementsByClassName("form-control");
    let errorObjectId   = "username";

    if(className[0] === null || className[0] === undefined){

        messageNotification('Objek id tidak di temukan !', 'Tampilkan');
        close;
        
    }else{

        for(let i = 0; i < className.length; i++){

            let identifikasiId = className[i].id;
    
            if(identifikasiId === errorObjectId){
    
                className[i].style.cssText = styleWrongField.join("").split(";").join(" !important;");
            
            }
        }
    }
}


