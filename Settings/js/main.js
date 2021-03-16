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
function ModalNotif() {
    // var exitFucntion = this.parentElement.style.display ='none';
    // bool boolNotiClose = true;
    var lines = [
        '<div class="bg-danger text-white">',
            '<div class="py-2 px-3">',
                'some error',
                '<a class="float-right" onclick=" ">&times;</a>',
            '</div>',
        '</div>'].join('');
    document.getElementById("ErrorMessage").innerHTML = lines;
}