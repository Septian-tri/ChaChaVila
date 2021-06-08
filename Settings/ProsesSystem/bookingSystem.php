<?php
if(!preg_match('/^[\s]*$/', $_SERVER['QUERY_STRING'])){

    die("JANGAN DI MASUKAN YANG ENGGAK2");
    return false;

}else{

    include "mainSystem.php";
    include "../ConfigDB/index.php";
    session_name('_lgnUs');
    session_start();
    session_regenerate_id(true);

    if(cekSession() === false){
        
        session_destroy();
        sendErrorMessage("Silahkan Login, terlebih dahulu Untuk Melanjutkan Check in dan Pembayaran !", "notificationErrorField", null);
        return false;
        
    }else{

        if(!preg_match('/^[a-zA-Z0-9\.\*\_\-\?]{135}$/', $_SESSION['TokenSementara'])){

            sendErrorMessage("Token Failed !", "notificationErrorField", null);
            return false;
            session_destroy();

        }else{

            $queryCekDataSession = mysqli_query($koneksi, "SELECT email, token, idrandom FROM temptokenmasuk WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and token = BINARY('".md5(explode('?', $_SESSION['TokenSementara'])[0])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

            if(!$queryCekDataSession){

                session_destroy();

            }else{

                if(mysqli_num_rows($queryCekDataSession) !== 1){

                    session_destroy();
                    sendErrorMessage("Akun Sedang di buka di tempat lain !", "notificationErrorField", null);
                    return false;

                }else{

                    $queryCekDataUser = mysqli_query($koneksi, "SELECT idrandom, email, namapengguna, namapanggilan FROM userdata WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

                    if(!$queryCekDataUser){
            
                        session_destroy();
            
                    }else{

                        if(mysqli_num_rows($queryCekDataUser) !== 1){

                            session_destroy();
                            sendErrorMessage("Akun Di Keluarkan karna teridikasi error / sedang di buka di tepat lain", "notificationErrorField", null);
                            return false;

                        }else{

                            if(cekValidasiEmail($koneksi, 'userdata') === false){

                                header("location:../../verifikasiEmailUser.php");
                                return false;
                    
                            }else{

                                $dataPengguna = mysqli_fetch_array($queryCekDataUser);
                                $data         = array("namaPengguna" => base64_decode($dataPengguna['namapengguna']), "namaPanggilan" => $dataPengguna['namapanggilan']);

                            }

                        }

                    }

                }

            }

        }

    }

}
?>