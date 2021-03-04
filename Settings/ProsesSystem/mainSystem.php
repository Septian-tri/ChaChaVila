<?php

//cek domain email jika penyedia layanan email tidak di temukan maka aka mebertikan nilai false, jika di temukan akan memberikan nilai true
function domainEmailCheck($Email){
    $PisahDomain = 'https://'.explode('@', filter_var($Email, FILTER_SANITIZE_EMAIL))[1];
    
    if(!filter_var($PisahDomain, FILTER_VALIDATE_URL)){
        return false;
    }

    $InisialCurl = curl_init($PisahDomain);
    
    curl_setopt($InisialCurl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($InisialCurl, CURLOPT_HEADER, true);
    curl_setopt($InisialCurl, CURLOPT_NOBODY, true);
    curl_setopt($InisialCurl, CURLOPT_RETURNTRANSFER, true);

    $ResponUrl = curl_exec($InisialCurl);

    curl_close($InisialCurl);

    if($ResponUrl) return false;

    return true;
}


//Kirim notifikasi ke gagalan 
function sendErrorMessage($isiPesan, $typePesan, $bidangDataError){
    
    $Pesan = array("isiPesan" => $isiPesan, "typePesan" => $typePesan, "bidangError" => $bidangDataError);
    echo json_encode($Pesan);

}


?>