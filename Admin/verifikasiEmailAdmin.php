<?php

if(!preg_match('/^[\s]*$/', $_SERVER['QUERY_STRING'])){

    die("JANGAN DI MASUKAN YANG ENGGAK2");
    return false;

}else{

    include "../Settings/ProsesSystem/mainsystem.php";
    include "../Settings/ConfigDB/index.php";

    session_name("_lgn");
    session_start();

if(cekSession() === false){

    session_destroy();
    header("location:index.php");
    return false;

}else{

    if(!preg_match('/^[a-zA-Z0-9\.\*\_\-\?]{135}$/', $_SESSION['TokenSementara'])){

        session_destroy();
        header("location:index.php");
        return false;

    }else{

        $queryCekDataSession = mysqli_query($koneksi, "SELECT * FROM temptokenmasuk WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and token = BINARY('".md5(explode('?', $_SESSION['TokenSementara'])[0])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

        if(!$queryCekDataSession){

            session_destroy();
            header("location:index.php");
            return false;

        }else{

            if(mysqli_num_rows($queryCekDataSession) !== 1){

                session_destroy();
                header("location:index.php");
                return false;

            }else{

                $queryCekDataAdmin = mysqli_query($koneksi, "SELECT * FROM admindata WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

                if(!$queryCekDataAdmin){
        
                    session_destroy();
                    header("location:index.php");
                    return false;
        
                }else{

                    if(cekValidasiEmail($koneksi, 'admindata') === true){

                        header("location:home.php");
                
                    }else{

                        if(mysqli_num_rows($queryCekDataAdmin) !== 1){
        
                            session_destroy();
                            header("location:index.php");
                            return false;
            
                        }else{
            
                           $dataAdmin       = mysqli_fetch_array($queryCekDataAdmin);
                           $namaPengguna    = base64_decode($dataAdmin['namapengguna']);
                           $namaPanggilan   = $dataAdmin['namapanggilan'];

                           if(isset($_POST['verBtn'])){
                               
                                if(isset($_POST['kodeVerifikasi'])){
                                    
                                    if(preg_match('/^\s*$/', $_POST['kodeVerifikasi'])){
                                
                                        $pesan = "Kode verifikasi Masih Kosong";
                                    
                                    }else{
                        
                                        if(strlen($_POST['kodeVerifikasi']) !== strlen(base64_decode($_SESSION['IR']))){
                                
                                            $pesan = "Kode verifikasi tidak valid";
                                        
                                        }else{

                                            if(!preg_match('/^[a-zA-Z0-9]{'.strlen(base64_decode($_SESSION['IR'])).'}$/', $_POST['kodeVerifikasi'])){
                                
                                                $pesan = "Kode verifikasi tidak valid";
                                            
                                            }else{
    
                                                
                                                 $Garem             = "*|_*_|* Semoga Semua Yang Di Kerja Kan Menghasilkan Kesuksesan...Aamiin *|_*_|*";
                                                 $kodeVerifikasi    = md5($_POST['kodeVerifikasi']." ".$Garem);
                                                 $kodeVerifikasiEm  = explode(".", $dataAdmin['kodeverifikasi'])[1];

                                                 if($kodeVerifikasi !== $kodeVerifikasiEm){

                                                    $pesan = "Kode verifikasi tidak sesuai";

                                                 }else{
                                                     
                                                     $update = mysqli_query($koneksi, "UPDATE admindata SET kodeverifikasi = 'Terverifikasi.".$kodeVerifikasi."' where idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and email = BINARY('".base64_decode($_SESSION['EM'])."') ");
                                                   
                                                     if(!$update){

                                                        $pesan = "Gagal melakukan verifikasi ".mysqli_error($koneksi);

                                                     }else{

                                                        header("location:home.php");
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
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hai <?php echo $namaPengguna; ?> Selamat datang di menu Verfikasi Email</title>

    <link rel="stylesheet" href="/settings/font-awesome/css/font-awesome.min.css">        
    <link rel="stylesheet" href="/Settings/css/bootstrap.min.css">
    <script src="/Settings/js/jquery-3.2.1.slim.min.js"></script>
    <script src="/Settings/js/main.js"></script>
    <script src="/Settings/js/bootstrap.min.js"></script>

</head>
<body class="bg-success">
    <div class="container">
        <div class="jumbotron">
            <h1>Hai <?php echo $namaPanggilan; ?></h1>
            <p class="lead">Mengapa Kamu Di Arah Kesini ? Kami hanya ingin memastikan bawha email yang kamu gunakan untuk mendaftar adalah email yang bersifat pribadi dan bukan milik orang lain. silahkan masukan kode verfikasi yang kami kirim melalui email, Terimakasih</p>
            <p>
                <?php 
                    
                    //Tampilkan Pesan disini
                    if(isset($pesan)){

                        echo $pesan;

                    }
                
                ?>
            </p>
            <form name="verfikasiEmail" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" class="form-control" placeholder="Kode Verifikasi" id="kodeverifikasiemail" maxlength="<?php echo strlen(base64_decode($_SESSION['IR'])); ?>" name="kodeVerifikasi" value="">
                <br>
                <button type="submit" class="btn btn-lg btn-primary text-white"  id="verBtn" name="verBtn">Konfirmasi</button>
            </form>
        </div>
    </div>
    <!-- 372351F7D -->
</body>
</html>