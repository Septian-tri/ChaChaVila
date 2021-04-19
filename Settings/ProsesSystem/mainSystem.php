<?php

if(count($_GET) === 0){
    //rubah tanggal sistem menjadi utc +7 bangkok, hanoi, jakarta
    date_default_timezone_set("Asia/Jakarta");

    //hanya dapat mengeset cokkie pada jaringan http
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 1);
    // session_set_cookie_params(['samesite' => 'none']); 


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
    function sendErrorMessage($messageValue, $messageType, $messageFieldError){
        
        $message = array(
            "messageNotif"              => $messageValue,
            "messageType"               => $messageType, 
            "messageFieldErrorObject"   => $messageFieldError,
        );
        echo json_encode($message);

    }

    function cekDataMasterAdmin($koneksi){

        $queryCekMasterAdmin = mysqli_query($koneksi, "SELECT * FROM admindata WHERE typeakun = 'Master_Admin' and typepengguna = 'Non_Customer'");

        if(!$queryCekMasterAdmin){

            return 'Hai..Maaf, kami mengalami ke gagalan sistem '.mysqli_error($koneksi)."<br />";

        }else{

            if(mysqli_num_rows($queryCekMasterAdmin) <= 0){

                return false;

            }else{

                return true;

            }
        }
    }

    function catatProsesGagalLogin(){
                                        
        if(!isset($_SESSION['PercobaanGagalLogin'])){
            
            $_SESSION['PercobaanGagalLogin'] = 1;
        
        }else{

            if($_SESSION['PercobaanGagalLogin'] > 5 || $_SESSION['PercobaanGagalLogin'] < 0){

                sendErrorMessage('Opps..Maaf kami mengalami kegaglan sistem silahkan ulangi', "OKE", null);  
                session_destroy();
                exit;
                return false;
            
            }else{
            
                $_SESSION['PercobaanGagalLogin'] += 1;
            
            }
        
        }

    }

    function cekSession(){

        if(isset($_SESSION['TokenSementara'], $_SESSION['IR'], $_SESSION['TLOGIN'], $_SESSION['EM'])){

            return true;

        }else{

            return false;

        }

    }

    function cekDataSession($koneksi, $namaDatabse, $namaTable, $valueTable){

        $queryCekDataSession = mysqli_query($koneksi, "SELECT * FROM $namaDatabse WHERE  $namaTable = BINARY('".$valueTable."')");

        if(!$queryCekDataSession){

            sendErrorMessage('Opps..Maaf kami mengalami kegaglan sistem silahkan ulangi '.mysqli_error($koneksi), "notificationErrorField", null);                        
            exit;
            return false;

        }else{

            if(mysqli_num_rows($queryCekDataSession) !== 1){

                return false;

            }else{

                return true;

            }

        }

    }


    function cekValidasiEmail($koneksi, $namadatabase){
        $queryCekVerifikasi = mysqli_query($koneksi, "SELECT * FROM $namadatabase WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')"); 
        
        if(!$queryCekVerifikasi){
            
            session_destroy();
            header("location:index.php");
            return false;

        }else{

            if(mysqli_num_rows($queryCekVerifikasi) !== 1){
        
                session_destroy();
                header("location:index.php");
                return false;

            }else{

                $dataVerifikasi = mysqli_fetch_array($queryCekVerifikasi);
                $kodeValidasi   = explode(".", $dataVerifikasi['kodeverifikasi'])[0];

                if($kodeValidasi === "Belum_Verifikasi"){

                    return false;
                
                }else{

                    return true;

                }

            }
        }
    }
}

?>