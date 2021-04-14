<?php
    include "mainSystem.php";

    session_name("ResetPassword");
    session_start();

    function buatSession($idrandom, $email, $durasitoken, $nohandphone){

        $_SESSION['iR'] = $idrandom;
        $_SESSION['em'] = $email;
        $_SESSION['nH'] = $nohandphone;
        $_SESSION['dT'] = $durasitoken;
        session_write_close();
    
    }

    function kirimEmail($emailPengguna, $namaPengguna, $finalKodeVer){

        $mimePesan      = "MIME-Version: 1.0"."\r\n";
        $typePesan      = "Content-type:text/html; charset=UTF-8"."\r\n";
        $pengirimPesan  = "From: ".$_SERVER['HTTP_HOST'];
        $ccPesan        = "";
        $bccPesan       = "";
        $isiPesan       = ' 
                <body style="
                    background-color: #D3D3D3;
                    text-align: center;
                    font-family: verdana;
                    border-radius:10px;
                    
                    ">
                    <div style="padding-right:20%;
                            padding-left:20%;">
                        <div style="
                            background-color: #ffffff;
                            ">
                
                            <div class="nav" style="
                                background-color: #7ABD7E;
                                width:auto;
                                height:auto;
                                padding:10px;
                                ">
                                
                                <img src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/Pengaturan/Gambar/LogoUtama/Logo.png" />
                                
                            </div>
                
                            <h1 style="
                                width: auto;
                                text-align: center;
                                color: #0B8142;
                                line-height: 31px;
                                margin: auto;
                                padding-top: 30px;
                                padding-bottom: 30px;
                                /* border-bottom: solid 2px #042035;     */
                                /* text-shadow: #fbdf03 1px 1px 0px; */
                                font-weight: none;">
                
                                Kode verfikasi reset sandi '.base64_decode($namaPengguna).'
                            </h1>
                
                            <hr style="
                                /* color: #FFFFFF; */
                                height: 12px;
                                border: 0;
                                box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);
                                ">
                
                            <p style="
                                text-indent:50px;
                                text-align:left;
                                padding:30px;
                                /* color: white; */
                                ">
                
                                <strong  style="color:#ffdf7a;">'.base64_decode($namaPengguna).'</strong>, kami Mendapat kabar bahwa kamu lupa kata sandi, kami sudah berikan kode verifikasi ya dibawah, berlaku selama lima menit dan 
                                kami meminta maaf atas ketidak nyamanan nanti yang kamu temukan, karna website kami masih berstatus beta. kamu juga dapat memeberi masukan memelalui menu saran ya, terimakasih. <strong>HAVE A NICE DAY</strong>
                
                                <br>
                                
                                <div class="verfikasi" style="
                                    color:#ffffff;
                                    text-align:center;
                                    background-color: #a0e892;
                                    padding: 10px">
                
                                    Ini Kode Verfikasi Kamu ya : <strong style="color:#FF6961">'.$finalKodeVer.'</strong>
                                </div>
                                
                                <br>
                
                                <div class="salam" style="
                                    width:auto; 
                                    /* font-weight: bold;  */
                                    padding:7px; 
                                    margin:7px;
                                    text-align:left;
                                    /* color: white; */
                                    ">
                
                                    Salam Hangat CEO & OWNER,
                                    <br/>
                                    <br>
                                    Septian & Ahmad 
                                    <hr style="width: 140px;margin-left:0px;">
                                </div>
                                <br>
                                <div class="bawah" style="
                                    text-align:center;
                                    font-size:10px;
                                    width:auto;
                                    padding:10px;
                                    color:white;
                                    background-color: #2c5f2d;
                                    border-bottom-left-radius: 5px;
                                    border-bottom-right-radius: 5px;
                                    border-top: solid 2px #3a4957;">
                
                                    jika kamu tidak merasa melakukan pendaftaran / melakukan aktivitas pada '.$_SERVER['HTTP_HOST'].', Silahkan abaikan atau Hapus Pesan ini, atas pengertian nya   
                                    <br>
                                    team '.$_SERVER['HTTP_HOST'].' mengucapkan terimakasih.
                                </div>
                            </p>
                        </div>
                    </div>
                </body>
                                
                        ';
                            
                        if(!mail(base64_decode($emailPengguna), 'Permintaan Reset Sandi '.$_SERVER['HTTP_HOST'], $isiPesan, $mimePesan.$typePesan.$pengirimPesan)){
                            
                            return true;
                        
                        }else{
                        
                            return false;
    
                        }
    }

    function cekDataResetUdahAdaAtauBelum($koneksi, $data, $valData){

        $cekDataPengguna = mysqli_query($koneksi, "SELECT * FROM logresetpassword WHERE  ".$data." = BINARY('".$valData."') ");
        
        if(!$cekDataPengguna){
            
            sendErrorMessage(mysqli_error($koneksi),  "notificationErrorField", null);
            exit;
        
        }else{
            
            if(mysqli_num_rows($cekDataPengguna) <= 0){
                
                return true;
            
            }else{
                
                return false;
            
            }
        
        }
    }
    

 if(!isset($_POST['riquestMode'])){

        sendErrorMessage("Proses tidak dapat di lanjutkan !", "notificationErrorField", "form-control");
        exit;
        return false;
    
}else{

    if($_POST['riquestMode'] == "mReset"){

        if(strlen($_POST['phonenumber']) <= 0 && strlen($_POST['email']) <= 0){

            sendErrorMessage("silahka isi bidang data terlebih dahulu !", "notificationErrorField", "form-control");
            exit;
            return false;
    
        }else{

            if(preg_match('/^\s*$/', $_POST["email"])){
                        
                sendErrorMessage("Hai..email Seperti nya masih Kosong", "notificationErrorField", "email");
                exit;
                return false;
            
            }else{
    
                if(strlen($_POST["email"]) > 225){
    
                    sendErrorMessage("email teralu panjang !", "notificationErrorField", "email");
                    exit;
                    return false;
                
                }else{
    
                    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    
                        sendErrorMessage("Penulisan email Salah !", "notificationErrorField", "email");
                        exit;
                        return false;
                    
                    }else{
        
                        if(domainemailCheck($_POST["email"])){
    
                            sendErrorMessage("Proses tidak dapat di lanjutkan, penyedia layanan email tidak dapat di temukan !", "notificationErrorField", "email");
                            exit;
                            return false;
                        
                        }else{
    
                            if(preg_match('/^[\s]*$/', $_POST["phonenumber"])){
                            
                                sendErrorMessage("Hai..Maaf, Seperti nya Nomor Hp kamu masih kosong ", "notificationErrorField", "phonenumber");
                                exit;
                                return false;
                            
                            }else{
                    
                                if(strlen($_POST['phonenumber']) < 11 || strlen($_POST['phonenumber']) > 13){
    
                                    if(strlen($_POST['phonenumber']) < 11){
                                        
                                        $panjangPendek = "Pendek";
    
                                    }else if(strlen($_POST['phonenumber']) > 13){
    
                                        $panjangPendek = "Panjang";
    
                                    }
    
                                    sendErrorMessage("Hai..Maaf, Nomor hp kamu terlalu ". $panjangPendek ." coba cek lagi ya.", "notificationErrorField", "phonenumber");
                                    exit;
                                    return false;
                                
                                }else{
                            
                                    if(!preg_match('/^[0][8][0-9]{9,11}$/', $_POST['phonenumber'])){
    
                                        sendErrorMessage("Hai..Maaf, hanya dapat di masukan angka dan hanya dapat menggunakan 08 pada 2 digit pertama", "notificationErrorField", "phonenumber");
                                        exit;
                                        return false;
                                    
                                    }else{
    
                                        include "../ConfigDB/index.php";
    
                                        function cekDataUdahAdaAtauBelum($koneksi, $data, $valData){
    
                                            $cekuserdata = mysqli_query($koneksi, "SELECT * FROM userdata WHERE  ".$data." = BINARY('".$valData."') ");
    
                                            if(!$cekuserdata){
                                                
                                            sendErrorMessage(mysqli_error($koneksi), 'notificationErrorField', null);
                                            exit;
                                            
                                            
                                            }else{
    
                                                if(mysqli_num_rows($cekuserdata) > 0){
                                                    
                                                    return true;
                                                
                                                }else{
    
                                                    return false;
    
                                                }
    
                                            }
    
                                        }
    
                                        if(explode('@', strtolower($_POST["email"]))[1]  === 'gmail.com'){
                                                                                        
                                            $cariTitik          = str_replace('.', '', explode('@', strtolower($_POST["email"]))[0]);
                                            $filterDomainemail  = $cariTitik.'@'.explode('@', strtolower($_POST["email"]))[1];
                                        
                                        }else{
    
                                            $filterDomainemail = strtolower($_POST["email"]);
                                        
                                        }
    
                                        $emailPengguna     = base64_encode($filterDomainemail);
                                        $nomorHp           = base64_encode($_POST["phonenumber"]);
    
                                        if(cekDataUdahAdaAtauBelum($koneksi, 'email', $emailPengguna) == false){
                                                                                            
                                            sendErrorMessage("Oppsss...maaf email kamu tidak dapat di temukan", 'notificationErrorField', 'email');
                                            exit;
                                            
                                        }else{
    
                                            if(cekDataUdahAdaAtauBelum($koneksi, 'phonenumber', $nomorHp) == false){
                                                                                        
                                                sendErrorMessage("Oppsss...maaf nomor hp kamu tidak dapat di temukan", 'notificationErrorField', 'phonenumber');
                                                exit;
                                                
                                            }else{
                                                
                                                $cekSemuaData = mysqli_query($koneksi, "SELECT * FROM userdata WHERE phonenumber = '".$nomorHp."' and email =  BINARY('".$emailPengguna."') ");
                                                
                                                if(!$cekSemuaData){
                                                    
                                                    sendErrorMessage("Maaf kami gagal melakukan Pengecekan data kamu, mohon ulangi ".mysqli_error($koneksi), "notificationErrorField", null);
                                                    exit;
                                                
                                                }else{
                                                    
                                                    if(mysqli_num_rows($cekSemuaData) <= 0){
                                                        
                                                        sendErrorMessage("Maaf kami tidak dapat menemukan seluruh data yang kamu masukan", "notificationErrorField", "form-control");
                                                        exit;
                                                    
                                                    }else{

                                                        $ambilDataPegguna   = mysqli_fetch_array($cekSemuaData);
                                                        $idRandomPengguna   = $ambilDataPegguna['idrandom'];
                                                        $namaPengguna       = $ambilDataPegguna['namapengguna'];
                                                        $nikPengguna        = $ambilDataPegguna['nikktp'];
                                                        $waktuVerifikasi    = strtotime("+ 5 minute today ".date("H:i:s"));
                                                        $randomKodeVer      = str_shuffle("*_#abcdefghijklmnopqrstuvwxyz".strtoupper("abcdefghijklmnopqrstuvwxyz")."0123456789");
                                                        $finalKodeVer       = substr($randomKodeVer, 33, strlen($randomKodeVer));
                                                        $ecryptKodeVer      = md5($finalKodeVer."*|*Semoga Apa Yang kita Kerjakan Ini Berkah dan Sukses .Aamiin*|*");
                                                        
                                                        $cekDataReset       = mysqli_query($koneksi,"SELECT * FROM logresetpassword WHERE  idrandom = BINARY('".$idRandomPengguna."') and nikktp = '".$nikPengguna."' and email = BINARY('".$emailPengguna."') ");
                                                        
                                                        if(!$cekDataReset){
                                                            
                                                            sendErrorMessage(mysqli_error($koneksi), "notificationErrorField", null);
                                                            exit;

                                                        }else{
                                                                        
                                                            if(mysqli_num_rows($cekDataReset) <= 0){
                                                                            
                                                                $MasukanIdReset = mysqli_query($koneksi, "INSERT INTO logresetpassword (email, idrandom, nikktp, tanggalresetpassword, kodeverifikasi) VALUES ('$emailPengguna', '$idRandomPengguna', '$nikPengguna', '$waktuVerifikasi', '$ecryptKodeVer')");
                                                                            
                                                                if(!$MasukanIdReset){
                                                                            
                                                                    sendErrorMessage(mysqli_error($koneksi), "notificationErrorField", null);
                                                                    exit;

                                                                }else{

                                                                    if(kirimEmail($emailPengguna,$namaPengguna,$finalKodeVer)){

                                                                        $hapusReset = mysqli_query($koneksi, "DELETE FROM logresetpassword WHERE idrandom = BINARY('".$idRandomPengguna."') and nikktp = '".$nikPengguna."' and email = BINARY('".$emailPengguna."') ");
                                                                        sendErrorMessage("emm..Maaf kami gagal mengirimkan kamu email, silahkan coba lagi ya ", "notificationErrorField", null);
                                                                        exit;

                                                                    }else{
                                                                                    
                                                                        buatSession($idRandomPengguna, $emailPengguna, $waktuVerifikasi, base64_encode($_POST['phonenumber']));
                                                                        sendErrorMessage("Oke..silahkan cek email untuk mendapat kan kode verfikasi ya", 'OK', null);
                                                                        exit;

                                                                    }
                                                                }

                                                            }else{

                                                                $dataReset       = mysqli_fetch_array($cekDataReset);
                                                                $dbWktuVerfikasi = $dataReset['tanggalresetpassword'];
                                                                $kodeLama        = $dataReset['kodeverifikasi'];

                                                                if($dbWktuVerfikasi > strtotime("today ".date("H:i:s"))){

                                                                    sendErrorMessage("emm..Maaf kamu baru dapat meminta reset kembali setelah 5 menit, Pukul ".date("H:i:s",$dbWktuVerfikasi), "notificationErrorField", null);
                                                                    exit;

                                                                }else{
                                                                                
                                                                    $updateResetSandi = mysqli_query($koneksi,"UPDATE logresetpassword SET tanggalresetpassword = '$waktuVerifikasi', kodeverifikasi = '$ecryptKodeVer' WHERE   idrandom = BINARY('".$idRandomPengguna."') and nikktp = '".$nikPengguna."' and email = BINARY('".$emailPengguna."') ");

                                                                    if(!$updateResetSandi){

                                                                        sendErrorMessage(mysqli_error($koneksi), "notificationErrorField", null);
                                                                        exit;
            
                                                                    }else{
                                                                                    
                                                                        if(kirimEmail($emailPengguna,$namaPengguna,$finalKodeVer)){

                                                                            $updateResetGagal = mysqli_query($koneksi,"UPDATE logresetpassword SET tanggalresetpassword = '$dbWktuVerfikasi', kodeverifikasi = '$kodeLama' WHERE   idrandom = BINARY('".$idRandomPengguna."') and nikktp = '".$nikPengguna."' and email = BINARY('".$emailPengguna."') ");
                                                                            sendErrorMessage("emm..Maaf kami gagal mengirimkan kamu email, silahkan coba lagi ya ", "notificationErrorField", null);
                                                                            exit;

                                                                        }else{

                                                                            buatSession($idRandomPengguna, $emailPengguna, $waktuVerifikasi, base64_encode($_POST['phonenumber']));
                                                                            sendErrorMessage("Oke..silahkan cek email untuk mendapat kan kode verfikasi ya", 'OK', null);
                                                                            exit;
                                                                                    
                                                                        }
                                                                        
                                                                    }  
                                                                    
                                                                }  
                                                            
                                                            }
                                                        
                                                        }
                                                    
                                                    }

                                                }
                                            
                                            }
    
                                        }
                                    
                                    }
    
                                }
    
                            }
    
                        }
    
                    }
    
                }
    
            }
        
        }

    }else if($_POST['riquestMode'] == "lReset"){
        if(!isset($_POST["kodeToken"], $_POST["password"], $_POST["repassword"])){
    
            sendErrorMessage("Opss...ada sesuatu yang gak beres !", "failedFieldPost", null);
            exit;
            return false;
        
        }else{
            
            if(!isset($_SESSION['iR'], $_SESSION['em'], $_SESSION['nH'], $_SESSION['dT'])){
    
                sendErrorMessage("Opps..Maaf Session Reset Sandi Kamu telah Berkahir, Silahkan Meminta Ulang Reset", "notificationErrorField", null);
                return false;
                
            }else{
    
                if($_SESSION['dT'] < strtotime(date("d-m-Y H:i:s", strtotime("today ".date("H:i:s"))))){
                                                                        
                    sendErrorMessage("Haii..Kode Verifikasi Kamu sudah expired, silahkan ulangin permintaan", "notificationErrorField", null);
                    return false;
    
                }else{
    
                    include "../ConfigDB/index.php";
    
                    if(cekDataResetUdahAdaAtauBelum($koneksi, 'idrandom', $_SESSION['iR'])){
    
                        sendErrorMessage("MuatUlang", "failedFieldPost", null);
                        exit;
    
                    }else{
    
                        if(cekDataResetUdahAdaAtauBelum($koneksi, 'email', $_SESSION['em'])){
    
                            sendErrorMessage("MuatUlang", "failedFieldPost", null);
                            exit;
            
                        }else{
    
                            if(preg_match('/^[\s]*$/', $_POST["kodeToken"])){
                        
                                sendErrorMessage("Hai..Maaf, Seperti nya kode Verifikasi kamu masih kosong ", "notificationErrorField", 'kodeToken');
                                return false;
                                    
                            }else{
                                    
                                if(strlen($_POST["kodeToken"]) !== 32){
                                        
                                    sendErrorMessage("Hai..Maaf, Masukan 32 digit Kode Verfikasi Kamu tidak dapat Kurang atau lebih ", "notificationErrorField", 'kodeToken');
                                    return false;
                                    
                                }else{
                                    
                                    if(!preg_match('/^[a-zA-Z0-9\*\_\#]*$/', $_POST["kodeToken"])){
                        
                                        sendErrorMessage("Hai..Maaf, Penulisan Kode Verfikasi tidak valid coba lagi", "notificationErrorField", 'kodeToken');
                                        return false;
                                            
                                    }else{
                                
                                        if(preg_match('/^[\s]*$/', $_POST["password"])){
                            
                                            sendErrorMessage("Hai..Maaf, Seperti nya kata sandi kamu masih kosong", "notificationErrorField", 'password');
                                            return false;
                                                
                                        }else{
                                                
                                            if(strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 100){
                                                    
                                                sendErrorMessage("Hai..Maaf, Masukan paling sedikit 8 digit, dan maksimal 100 digit", "notificationErrorField", 'password');
                                                return false;
                                                
                                            }else{
                                            
                                                if(preg_match('/^[\s]*$/', $_POST["repassword"])){
                            
                                                    sendErrorMessage("Hai..Maaf, Seperti nya Konfirmasi kata sandi kamu masih kosong ", "notificationErrorField", 'repassword');
                                                    return false;
                                                        
                                                }else{
                                                        
                                                    if(strlen($_POST["repassword"]) < 8 || strlen($_POST["repassword"]) > 100){
                                                            
                                                        sendErrorMessage("Hai..Maaf, Masukan paling sedikit 8 digit, dan maksimal 100 digit", "notificationErrorField", 'repassword');
                                                        return false;
                                                        
                                                    }else{
                                                    
                                                        if($_POST["repassword"] !== $_POST["password"]){
                                                            
                                                            sendErrorMessage("Hai..Maaf, Konfirmasi kata sandi tidak sesuai", "notificationErrorField", 'repassword');
                                                            return false;
                                                            
                                                        }else{
                                                        
                                                            $Garem              = "*|_*_|* Semoga Semua Yang Di Kerja Kan Menghasilkan Kesuksesan...Aamiin *|_*_|*";
                                                            $kodeVerfikasi      = md5($_POST['kodeToken']."*|*Semoga Apa Yang kita Kerjakan Ini Berkah dan Sukses .Aamiin*|*");
                                                            $password           = md5($_POST["password"]." ".$Garem);
    
                                                            $cekKodeVerfikasi   = mysqli_query($koneksi, "SELECT * FROM logresetpassword WHERE  email = BINARY('".$_SESSION['em']."') and idrandom = BINARY('".$_SESSION['iR']."') and kodeverifikasi = BINARY('".$kodeVerfikasi."') ");
    
                                                            if(!$cekKodeVerfikasi){
    
                                                                sendErrorMessage("Opss...ada sesuatu yang gak beres !".mysqli_error($koneksi), "notificationErrorField", null);
                                                                exit;
    
                                                            }else{
                                                                    
                                                                if(mysqli_num_rows($cekKodeVerfikasi) <= 0){
    
                                                                    sendErrorMessage("Hai..Maaf, Kode verfikasi Kamu Kurang tepat, Perhatikan penulisan huruf besar dan kecil nya ya",  "notificationErrorField", "kodeToken");
                                                                    return false;
    
                                                                }else{
                                                                    
                                                                    $waktuVerifikasiDB = mysqli_fetch_array($cekKodeVerfikasi)['tanggalresetpassword'];
                                                                    
                                                                    if($waktuVerifikasiDB < strtotime(date("d-m-Y H:i:s", strtotime("today ".date("H:i:s"))))){
                                                                        
                                                                        sendErrorMessage("Haii..Kode Verifikasi Kamu sudah expired, silahkan ulangin permintaan",  "notificationErrorField", null);
                                                                        return false;
    
                                                                    }else{
    
                                                                        $updatePassword = mysqli_query($koneksi, "UPDATE userdata, logresetpassword SET userdata.password = '".$password."',  logresetpassword.tanggalresetpassword = '".strtotime(date("d-m-Y H:i:s", strtotime("today ".date("H:i:s"))))."' WHERE  userdata.idrandom = logresetpassword.idrandom and userdata.email = logresetpassword.email and userdata.idrandom = BINARY('".$_SESSION['iR']."') and  userdata.email = BINARY('".$_SESSION['em']."') ");                                                     
                                                                            
                                                                        if(!$updatePassword){
    
                                                                            sendErrorMessage("Hai..Maaf, kami gagal melakukan reset sandi kamu silahkan ulangi".mysqli_error($koneksi),  "notificationErrorField", null);
                                                                            return false;
                                                                                
                                                                        }else{
                                                                                
                                                                            sendErrorMessage('terimakasih reset kata sandi berhasil silahkan <strong style="color:#ff7800;">MASUK</strong>', "SUKSES", null);
                                                                            return false;

                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }else{

        sendErrorMessage("Proses tidak dapat di lanjutkan !", "SendToHome", "form-control");
        return false;

    }

}
?>