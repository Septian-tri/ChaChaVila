<?php
if(!preg_match('/^[\s]*$/', $_SERVER['QUERY_STRING'])){

    die("JANGAN DI MASUKAN YANG ENGGAK2");
    return false;

}else{

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

                                if(!isset($_POST['KODE'], $_POST['IDUV'])){

                                    sendErrorMessage("JANGAN DI EDIT !", "notificationErrorField", null);
                                    return false;

                                }else{

                                    if(preg_match('/^[\s]*$/', $_POST['KODE'])){

                                        sendErrorMessage("JANGAN DI EDIT !", "notificationErrorField", null);
                                        return false;

                                    }else{

                                        if(preg_match('/^[\s]*$/', $_POST['IDUV'])){

                                            sendErrorMessage("JANGAN DI EDIT !", "notificationErrorField", null);
                                            return false;
    
                                        }else{
                                            
                                            if(!preg_match('/^[0-9a-fA-F]*$/', $_POST['IDUV'])){

                                                sendErrorMessage("JANGAN DI EDIT !", "notificationErrorField", null);
                                                return false;
        
                                            }else{

                                                function HAPUS($koneksi, $id){

                                                    $queryCekIDVilla = mysqli_query($koneksi, "SELECT * FROM villa WHERE idunikvilla = BINARY('".$_POST['IDUV']."') ");

                                                    if(!$queryCekIDVilla){

                                                        sendErrorMessage("Maaf Kami Gagal Menghapus Data Yang Di minta ".mysqli_error($koneksi), "notificationErrorField", $_POST['IDUV']);
                                                        return false;

                                                    }else{

                                                        if(mysqli_num_rows($queryCekIDVilla) !== 1){

                                                            sendErrorMessage("Tidak Dapat Menghapus, Terjadi Error Database Hubungi Pengembang !", "notificationErrorField", $_POST['IDUV']);
                                                            return false;

                                                        }else{

                                                            

                                                            $queryHapusDatabase = mysqli_query($koneksi, "DELETE FROM villa WHERE idunikvilla = BINARY('".$_POST['IDUV']."') ");

                                                            if(!$queryHapusDatabase){

                                                                sendErrorMessage("Maaf Kami Gagal Menghapus Data Yang Di minta ".mysqli_error($koneksi), "notificationErrorField", $_POST['IDUV']);
                                                                return false;

                                                            }else{

                                                                if(!is_dir("../../Villa/".$_POST['IDUV'])){

                                                                    sendErrorMessage("Data Villa Pada Database Berhasil Di hapus tetapi kami tidak menemukan, File Untuk Villa ini", "notificationErrorField", $_POST['IDUV']);
                                                                    return false;

                                                                }else{

                                                                    if(!hapusFolder("../../Villa/".$_POST['IDUV'])){

                                                                        sendErrorMessage("Gagal meghapus sisa file villa silahkan hapus manual folder villa dengan id ".$_POST['IDUV'], "notificationErrorField", $_POST['IDUV']);
                                                                        return false;

                                                                    }else{

                                                                        sendErrorMessage("Villa Berhasil Di hapus :)", "notificationErrorField", $_POST['IDUV']);
                                                                        return false;

                                                                    }

                                                                }

                                                            }

                                                        }

                                                    }

                                                }

                                                switch($_POST['KODE']){

                                                    case 'HAPUS'  :
                                                        HAPUS($koneksi, $_POST['IDUV']);
                                                        return false;
                                                    break;

                                                    case 'UPDATE' :
                                                        UPDATE();
                                                    break;

                                                    default :

                                                        sendErrorMessage("JANGAN DI WOY !", "notificationErrorField", null);
                                                        return false;

                                                    break;

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