<?php

include "mainSystem.php";
include "../ConfigDB/index.php";

session_name("_lgn");
session_start();

if(cekSession() === false){

    session_destroy();
    header("location:../../admin/index.php");
    return false;

}else{

    if(!preg_match('/^[a-zA-Z0-9\.\*\_\-\?]{135}$/', $_SESSION['TokenSementara'])){

        session_destroy();
        header("location:../../admin/index.php");
        return false;

    }else{

        $queryCekDataSession = mysqli_query($koneksi, "SELECT * FROM temptokenmasuk WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and token = BINARY('".md5(explode('?', $_SESSION['TokenSementara'])[0])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

        if(!$queryCekDataSession){

            session_destroy();
            header("location:../../admin/index.php");
            return false;

        }else{

            if(mysqli_num_rows($queryCekDataSession) !== 1){

                session_destroy();
                header("location:../../admin/index.php");
                return false;

            }else{

                $queryCekDataAdmin = mysqli_query($koneksi, "SELECT * FROM admindata WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

                if(!$queryCekDataAdmin){
                
                    session_destroy();
                    header("location:../../admin/index.php");
                    return false;
                
                }else{

                    if(cekValidasiEmail($koneksi, 'admindata') === false){

                        header("location:../../admin/verifikasiEmailAdmin.php");
                        
                    }else{

                        if(mysqli_num_rows($queryCekDataAdmin) !== 1){
                
                            session_destroy();
                            header("location:../../admin/index.php");
                            return false;
                    
                        }else{
                            
                            sendErrorMessage(print_r($_FILES['thumbnail']), "notificationErrorField", "NamaVilla");

                        }
                    }        
                }
            }
        }
    }
}
?>