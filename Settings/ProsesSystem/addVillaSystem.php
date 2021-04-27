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

                            if(preg_match('/^[\s]*$/', $_POST['NamaVilla'])){

                                sendErrorMessage("Nama Vila Belum Di isi", "notificationErrorField", "NamaVilla");
                                return false;

                            }else{

                                if(strlen($_POST['NamaVilla']) > 100 || strlen($_POST['NamaVilla']) < 3){

                                    sendErrorMessage("Panjang Nama Villa Tidak Valid ".print_r($_POST), "notificationErrorField", "NamaVilla");
                                    return false;
    
                                }else{

                                    if(preg_match('/^[\s]*$/', $_POST['AlamatVilla'])){

                                        sendErrorMessage("Alamat Villa Belum Di isi", "notificationErrorField", "AlamatVilla");
                                        return false;
        
                                    }else{
        
                                        if(strlen($_POST['AlamatVilla']) > 300 || strlen($_POST['AlamatVilla']) < 10){
        
                                            sendErrorMessage("Panjang Alamat Villa Tidak Valid", "notificationErrorField", "AlamatVilla");
                                            return false;
            
                                        }else{
        
                                            if(preg_match('/^[\s]*$/', $_POST['HargaVilla'])){

                                                sendErrorMessage("Harga Villa Belum Di isi", "notificationErrorField", "HargaVilla");
                                                return false;
                
                                            }else{
                
                                                if(strlen($_POST['HargaVilla']) > 20 || strlen($_POST['HargaVilla']) < 5){
                
                                                    sendErrorMessage("Panjang Harga Villa Tidak Valid", "notificationErrorField", "HargaVilla");
                                                    return false;
                    
                                                }else{

                                                    if(!preg_match('/^[\0-9]*$/', $_POST['HargaVilla'])){

                                                        sendErrorMessage("Harga Villa Tidak Valid", "notificationErrorField", "HargaVilla");
                                                        return false;
                        
                                                    }else{
                
                                                        if($_POST['HargaVilla'] < 10000){

                                                            sendErrorMessage("Harga Villa Tidak Valid. masukan harga lebih dari 10.000 Rupiah", "notificationErrorField", "HargaVilla");
                                                            return false;
                            
                                                        }else{

                                                            if(preg_match('/^[\s]*$/', $_POST['deskripsi'])){

                                                                sendErrorMessage("Silahkan Isi Deksripsi Villa".$_POST['deskripsi'], "notificationErrorField", "DSV");
                                                                return false;
                                
                                                            }else{
                        
                                                                if(strlen($_POST['deskripsi']) > 3000){

                                                                    sendErrorMessage("Limit Deksripsi Villa Tercapai".strlen($_POST['deskripsi']), "notificationErrorField", "DSV");
                                                                    return false;
                                    
                                                                }else{
                                                                    
                                                                    $tempJumlahFVT  = 0;
                                                                    $tempIdFVT      = 0;
                                                                    $tempNonFVT     = 0;
                                                                    $tempFVTKosong  = "";
        
                                                                    for($i = 0; $i < count($_POST); $i++){
        
                                                                        $tempNonFVT+=1;
        
                                                                        if(explode("_", array_keys($_POST)[$i])[0] === "FVT"){
        
                                                                            $tempIdFVT+=1;
        
                                                                            if(!preg_match('/^[\s]*$/',$_POST[array_keys($_POST)[$i]])){
        
                                                                                if(!preg_match('/^[1-9]{1,2}$/', $_POST[array_keys($_POST)[$i]])){
                                                                                    
                                                                                    sendErrorMessage("Data yang di masukan pada Vasilitas villa tidak valid", "notificationErrorField",  array_keys($_POST)[$i]);
                                                                                    return false;
                                                                                    
                                                                                }else{

                                                                                    $tempJumlahFVT+=1;
                                                                                
                                                                                }
                                                                               
                                                                           }else{
        
                                                                                $tempFVTKosong = "";
                                                                                $tempFVTKosong = array_keys($_POST)[$tempNonFVT-$tempIdFVT];
        
                                                                           }
        
                                                                        }
                                                                       
                                                                    }
        
                                                                    
        
                                                                    if($tempJumlahFVT <= 0){
        
                                                                        sendErrorMessage("Silahkan isi minimal satu fasilitas ", "notificationErrorField", $tempFVTKosong);
                                                                        return false;
        
                                                                    }else{
        
                                                                        if(!isset($_FILES['ThumbnailVilla'])){
        
                                                                            sendErrorMessage("Silahkan isi Thumbnail Villa ", "notificationErrorField", 'ThumbnailVilla');
                                                                            return false;
            
                                                                        }else{
                
                                                                            if(preg_match('/^[\s]*$/', $_FILES['ThumbnailVilla']['name'])){
        
                                                                                sendErrorMessage("Thumbnail Villa Masih Kosong", "notificationErrorField", 'ThumbnailVilla');
                                                                                return false;
                
                                                                            }else{


                                                                                if($_FILES['ThumbnailVilla']['size'] > 1048576){
        
                                                                                    sendErrorMessage("Maksimal Ukuran Gambar Thumbnail 1 Mb", "notificationErrorField", 'ThumbnailVilla');
                                                                                    return false;
                    
                                                                                }else{
                        
                                                                                    if(exif_imagetype($_FILES['ThumbnailVilla']['tmp_name']) !== IMAGETYPE_JPEG && exif_imagetype($_FILES['ThumbnailVilla']['tmp_name']) !== IMAGETYPE_PNG){
        
                                                                                        sendErrorMessage("Maaf Gambar Tidak Support", "notificationErrorField", 'ThumbnailVilla');
                                                                                        return false;
                        
                                                                                    }else{
                            
                                                                                        if(exif_imagetype($_FILES['ThumbnailVilla']['tmp_name']) !== IMAGETYPE_JPEG && exif_imagetype($_FILES['ThumbnailVilla']['tmp_name']) !== IMAGETYPE_PNG){
        
                                                                                            sendErrorMessage("Maaf Gambar Tidak Support", "notificationErrorField", 'ThumbnailVilla');
                                                                                            return false;
                            
                                                                                        }else{
                                                                                            
                                                                                            if(count($_FILES) <= 1){

                                                                                                sendErrorMessage("Silhakan Masukan 1 atau lebih foto pendukung", "notificationErrorField", "a");
                                                                                                return false;

                                                                                            }else{

                                                                                                for($j = 0; $j < count($_FILES); $j++){

                                                                                                    if(explode("_", array_keys($_FILES)[$j])[0] === "FVG"){

                                                                                                        if(count($_FILES[array_keys($_FILES)[$j]]['name']) > 5){

                                                                                                            sendErrorMessage('Maaf Batas multiple hanya sampai 5 gambar', "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                            return false;

                                                                                                        }else{

                                                                                                            for($k = 0; $k < count($_FILES[array_keys($_FILES)[$j]]['size']); $k++){

                                                                                                                if($_FILES[array_keys($_FILES)[$j]]['size'][$k] > 1048576){
    
                                                                                                                    sendErrorMessage('Gambar Dengan nama '.$_FILES[array_keys($_FILES)[$j]]['name'][$k].' melebihin 1 MB Proses di hentikan' , "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                                    return false;
    
                                                                                                                }else{
    
                                                                                                                    if(exif_imagetype($_FILES[array_keys($_FILES)[$j]]['tmp_name'][$k]) !== IMAGETYPE_JPEG && exif_imagetype($_FILES[array_keys($_FILES)[$j]]['tmp_name'][$k]) !==  IMAGETYPE_PNG){
    
                                                                                                                        sendErrorMessage('Gambar Dengan nama '.$_FILES[array_keys($_FILES)[$j]]['name'][$k].' Bukan merupakan format gambar yang di support' , "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                                        return false;
        
                                                                                                                    }else{
        
                                                                                                                        
        
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