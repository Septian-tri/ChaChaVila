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

                                if(!isset($_POST['IDUV'], $_POST['KODE'])){

                                    header("location:../../admin/villaCustomize/list_villa_admin.php");
                                    return false;
                            
                                }else{
                            
                                    
                                    if(preg_match('/^[\s]*$/', $_POST['KODE'])){
                            
                                        header("location:../../admin/villaCustomize/list_villa_admin.php");
                                        return false;
                            
                                    }else{
                            
                                        if(preg_match('/^[\s]*$/', $_POST['IDUV'])){
                            
                                            header("location:../../admin/villaCustomize/list_villa_admin.php");
                                            return false;
                            
                                        }else{
                                            
                                            if(!preg_match('/^[0-9a-fA-F]*$/', $_POST['IDUV'])){
                            
                                                header("location:../../admin/villaCustomize/list_villa_admin.php");
                                                return false;
                            
                                            }else{
                            
                                                $queryCekIDVilla = mysqli_query($koneksi, "SELECT * FROM villa WHERE idunikvilla = BINARY('".$_POST['IDUV']."') ");
                                                
                                                if(!$queryCekIDVilla){
                                                    
                                                    die("Maaf Kami Gagal Menemukan Data Yang Di minta ".mysqli_error($koneksi));
                                                    return false;
                                                
                                                }else{
                                                    
                                                    if(mysqli_num_rows($queryCekIDVilla) !== 1){
                                                        
                                                        sendErrorMessage("Data Villa tidak di temukan, data Mungkin Sudah Di Hapus, jika ini terus Terjadi Refresh Halaman !", "notificationErrorField", null);
                                                        return false;
                                                    
                                                    }else{
                            
                                                        $dataVilla = mysqli_fetch_array($queryCekIDVilla);

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
                                                                                                
                                                                                                $tempJumlahFVT      = 0;
                                                                                                $tempIdFVT          = 0;
                                                                                                $tempNonFVT         = 0;
                                                                                                $tempFVTKosong      = "";
                                                                                                $dataJsonFasilitas  = [];
                                                            
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
                                                                                                                array_push($dataJsonFasilitas, array(array_keys($_POST)[$i] => $_POST[array_keys($_POST)[$i]]));
                                                                                                            
                                                                                                            }
                                                                                                        
                                                                                                        }else{
                                                            
                                                                                                                $tempFVTKosong = "";
                                                                                                                $tempFVTKosong = array_keys($_POST)[$tempNonFVT-$tempIdFVT];
                                                                                                                array_push($dataJsonFasilitas, array(array_keys($_POST)[$i] => "TIDAK DI ISI"));
                                                            
                                                                                                        }
                                                            
                                                                                                    }else if(explode("_", array_keys($_POST)[$i])[0] === "FVC"){
                                                            
                                                                                            
                                                                                                        if($_POST[array_keys($_POST)[$i]] === "true" XOR $_POST[array_keys($_POST)[$i]] === "false"){
                                                            
                                                                                                            array_push($dataJsonFasilitas, array(array_keys($_POST)[$i] => $_POST[array_keys($_POST)[$i]]));
                                                            
                                                                                                        }else{
                                                            
                                                                                                            sendErrorMessage("Data yang di masukan pada Vasilitas villa tidak valid", "notificationErrorField",  array_keys($_POST)[$i]);
                                                                                                            return false;
                                                            
                                                                                                        }
                                                            
                                                                                                    }
                                                                                                
                                                                                                }

                                                                                                if(isset($_FILES['ThumbnailVilla'])){
                                                            
                                                                                                    if(preg_match('/^[\s]*$/', $_FILES['ThumbnailVilla']['name'])){
                                                            
                                                                                                        $Villa              = "";
                                                                                                        $kirimT             = false;
                                                        
                                                                                                    }else{
                                                        
                                                        
                                                                                                        if($_FILES['ThumbnailVilla']['size'] > 1048576){
                                                        
                                                                                                            sendErrorMessage("Maksimal Ukuran Gambar Thumbnail 1 Mb", "notificationErrorField", 'ThumbnailVilla');
                                                                                                            return false;
                                                        
                                                                                                        }else{
                                                        
                                                                                                            if(exif_imagetype($_FILES['ThumbnailVilla']['tmp_name']) !== IMAGETYPE_JPEG && exif_imagetype($_FILES['ThumbnailVilla']['tmp_name']) !== IMAGETYPE_PNG){
                                                        
                                                                                                                sendErrorMessage("Maaf Gambar Tidak Support", "notificationErrorField", 'ThumbnailVilla');
                                                                                                                return false;
                                                        
                                                                                                            }else{

                                                                                                                $kirimT = true;
                                                                                                                $Villa = ", thumbnail='".$_POST['IDUV']."_"."Thumbnail".substr($_FILES['ThumbnailVilla']['name'], strlen($_FILES['ThumbnailVilla']['name'])-4, strlen($_FILES['ThumbnailVilla']['name']))."'";

                                                                                                            }

                                                                                                        }

                                                                                                    }

                                                                                                }else{

                                                                                                    $Villa = "";
                                                                                                    $kirimT = false;

                                                                                                }
                                                            
                                                                                                if($tempJumlahFVT <= 0){
                                                            
                                                                                                    sendErrorMessage("Silahkan isi minimal satu fasilitas ", "notificationErrorField", $tempFVTKosong);
                                                                                                    return false;
                                                            
                                                                                                }else{
                                                                                                    
                                                                                                    if(isset($_POST['HargaVillaDisc'])){

                                                                                                        if(preg_match('/^[\s]*$/', $_POST['HargaVillaDisc'])){
                                                                                                            
                                                                                                            $discount = "TIDAK TERSEDIA";
                                                                                                            
                                                                                                        }else{
                                                                                                            
                                                                                                            if(strlen($_POST['HargaVillaDisc']) > 20){
                                                                                                                
                                                                                                                sendErrorMessage("Jumlah Digit discount melebihin batas", "notificationErrorField", 'HargaVillaDisc');
                                                                                                                return false;
    
                                                                                                            }else{
       
                                                                                                                if(!preg_match('/^[0-9]*$/', $_POST['HargaVillaDisc'])){
                                                                                                                    
                                                                                                                    sendErrorMessage("Silahkan Hanya Masukan Angka pada Field Diskon !", "notificationErrorField", 'HargaVillaDisc');
                                                                                                                    return false;
    
                                                                                                                }else{
    
                                                                                                                    if($_POST['HargaVillaDisc'] > $_POST['HargaVilla']){
                                                                                                                    
                                                                                                                        sendErrorMessage("Jumlah Diskon tidak dapat lebih besar dari harga villa !", "notificationErrorField", 'HargaVillaDisc');
                                                                                                                        return false;
            
                                                                                                                    }else{
    
                                                                                                                        if($_POST['HargaVillaDisc'] <= 0){
    
                                                                                                                            $discount = "TIDAK TERSEDIA";
                                                                                                                            
                                                                                                                        }else{
                                                                                                                            
                                                                                                                            if(($_POST['HargaVilla'] - $_POST['HargaVillaDisc']) < 10000){
                                                                                                                            
                                                                                                                                sendErrorMessage("Maaf saat ini harga vilaa setelah discount tidak dapat kurang dari 10 ribu !", "notificationErrorField", 'HargaVillaDisc');
                                                                                                                                return false;
    
                                                                                                                            }else{
    
                                                                                                                                $discount = $_POST['HargaVillaDisc'];
    
                                                                                                                            }
    
                                                                                                                        }
    
                                                                                                                    }
    
                                                                                                                }
    
                                                                                                            }
    
                                                                                                        }
    
                                                                                                    }else{
    
                                                                                                        $discount = "TIDAK TERSEDIA";
    
                                                                                                    }
                                                                                                        
                                                                                                            $namaVillaFolder    = md5(htmlentities($_POST['NamaVilla'], ENT_QUOTES));
                                                                                                            $namaVilla          = addslashes(htmlentities($_POST['NamaVilla'], ENT_QUOTES));
                                                                                                            $alamatVilla        = addslashes(htmlentities($_POST['AlamatVilla'], ENT_QUOTES));
                                                                                                            $hargaVilla         = $_POST['HargaVilla'];
                                                                                                            $deskripsiVilla     = addslashes(htmlentities($_POST['deskripsi'], ENT_QUOTES));
                                                                                                            $admin              = base64_decode(mysqli_fetch_array($queryCekDataAdmin)['namapengguna']);
                                                                                                            $originalFotoVilla  = json_decode($dataVilla['fasilitasvilla']) -> fotoVilla;
                                                                                                            $tanggalDiBuat      = date("d-m-Y H:i:s", strtotime("today ".date("H:i:s")));
                                                                                                            $idUnikVilla        = $dataVilla['idunikvilla'];
                                                                                                            $linkDefaultVilla   = "../../Villa/"; 
                                                                                                            $objekJsonGambar    = [];
                                                                                                            $fasilitasGambarKSG = [];
                                                                                                            $totalPost          = count($_POST);
                                                                                                            
                                                                                                            for($h = 0; $h < $totalPost; $h++){
                                                                                                                
                                                                                                                if(explode("_", array_keys($_POST)[$h])[0] === "FVG"){
                                                                                                                    
                                                                                                                    array_push($fasilitasGambarKSG, array_keys($_POST)[$h]);
                                                                                                                
                                                                                                                }
                                                                                                            
                                                                                                            }
                                                                                                            
                                                                                                            if(!is_dir($linkDefaultVilla.$idUnikVilla)){
                                                                                                                
                                                                                                                if(!mkdir($linkDefaultVilla.$idUnikVilla)){
                                                                                                                    
                                                                                                                    sendErrorMessage('Pembuatan Direktori nama Vila Gagal Di buat Proses Di hentikan' , "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                                    return false;
                                                                                                                
                                                                                                                }
                                                                                                            
                                                                                                            }
                                                                                                            
                                                                                                            if($kirimT){
                                                                                                                
                                                                                                                if(!move_uploaded_file($_FILES['ThumbnailVilla']['tmp_name'], $linkDefaultVilla.$idUnikVilla."/".$idUnikVilla."_"."Thumbnail".substr($_FILES['ThumbnailVilla']['name'], strlen($_FILES['ThumbnailVilla']['name'])-4, strlen($_FILES['ThumbnailVilla']['name'])))){
                                                                
                                                                                                                    hapusFolder($linkDefaultVilla.$idUnikVilla);
                                                                                                                    sendErrorMessage("Gagal Menyimpan data Villa Thumnail gagal di upload", "notificationErrorField", null);
                                                                                                                    return false;
                                                                    
                                                                                                                }else{

                                                                                                                    $notifThumbnail = "Thumbnail Serta ";

                                                                                                                }

                                                                                                            }

                                                                                                            for($j = 0; $j < count($_FILES); $j++){
                                                                                                                
                                                                                                                $explodeTypeGambar = explode("_", array_keys($_FILES)[$j])[0];

                                                                                                                if($explodeTypeGambar === "FVG"){
                                                                
                                                                                                                    if(count($_FILES[array_keys($_FILES)[$j]]['name']) > 5){
                                                                
                                                                                                                        sendErrorMessage('Maaf Batas multiple hanya sampai 5 gambar', "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                                        return false;
                                                                                                                    
                                                                                                                    }else{
                                                                                                                        
                                                                                                                        $nomorUrutGambar = 1;
                                                                                                                        
                                                                                                                        for($k = 0; $k < count($_FILES[array_keys($_FILES)[$j]]['name']); $k++){
                                                                                                                            
                                                                                                                            $namaGambarVilla = $_FILES[array_keys($_FILES)[$j]]['name'][$k];
                                                                                                                            
                                                                                                                            if($_FILES[array_keys($_FILES)[$j]]['size'][$k] > 1048576){
                                                                                                                                
                                                                                                                                sendErrorMessage('Gambar Dengan nama '.$namaGambarVilla.' melebihin 1 MB Proses di hentikan' , "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                                                return false;
                                                                                                                            
                                                                                                                            }else{
                                                                                                                                
                                                                                                                                if(exif_imagetype($_FILES[array_keys($_FILES)[$j]]['tmp_name'][$k]) !== 2 && exif_imagetype($_FILES[array_keys($_FILES)[$j]]['tmp_name'][$k]) !==  3){
                                                                
                                                                                                                                    sendErrorMessage('Gambar Dengan nama '.$namaGambarVilla.' Bukan merupakan format gambar yang di support' , "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                                                    return false;
                                                                
                                                                                                                                }else{
                                                                                                                                    
                                                                                                                                    $direktoriNamaVilla     = $linkDefaultVilla.$idUnikVilla;
                                                                                                                                    $subDirektoriNamaVilla  = $linkDefaultVilla.$idUnikVilla."/".array_keys($_FILES)[$j];
                                                                                                                                                            
                                                                                                                                    if(!is_dir($subDirektoriNamaVilla)){
                                                                                                                                        
                                                                                                                                        if(!mkdir($subDirektoriNamaVilla)){
                                                                                                                                            
                                                                                                                                            hapusFolder($subDirektoriNamaVilla);
                                                                                                                                            sendErrorMessage('Pembuatan Sub Direktori nama Vila Gagal Di buat Proses Di hentikan. folder Di Cleanup' , "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                                                            return false;
                                                                                                                                        
                                                                                                                                        }
                                                                                                                                    
                                                                                                                                    }
                                                                                                                                    
                                                                                                                                    if(!move_uploaded_file($_FILES[array_keys($_FILES)[$j]]['tmp_name'][$k], $subDirektoriNamaVilla."/".$namaGambarVilla)){
                                                                
                                                                                                                                        sendErrorMessage('Pembuatan Sub Direktori nama Vila Gagal Di buat Proses Di hentikan. folder Di Cleanup' , "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                                                        return false;
                                                                                                                                    
                                                                                                                                    }else{
                                                                                                                                        
                                                                                                                                        if($nomorUrutGambar <= 5){
                                                                                                                                            
                                                                                                                                            $namaGambarRename = $idUnikVilla."_".array_keys($_FILES)[$j]."_".$nomorUrutGambar.substr($namaGambarVilla, strlen($namaGambarVilla)-4, strlen($namaGambarVilla));
                                                                                                                                            
                                                                                                                                            if(rename($subDirektoriNamaVilla."/".$namaGambarVilla, $subDirektoriNamaVilla."/".$namaGambarRename)){
                                                                    
                                                                                                                                                array_push($objekJsonGambar, array("typeGambar" => array_keys($_FILES)[$j], "namaGambar" => $namaGambarRename, "urlGambar" => $subDirektoriNamaVilla."/"));
                                                                    
                                                                                                                                            }else{
                                                                                                                                                
                                                                                                                                                sendErrorMessage('File Dengan nama '.$_FILES[array_keys($_FILES)[$j]]['name'][$k]." Gagal Di upload", "notificationErrorField", array_keys($_FILES)[$j]);
                                                                    
                                                                                                                                            }

                                                                                                                                        }
                                                                                                                                    
                                                                                                                                    }
                                                                                                                                
                                                                                                                                }
                                                                                                                            
                                                                                                                            } $nomorUrutGambar++;
                                                                                                                        
                                                                                                                        }
                                                                                                                    
                                                                                                                    }
                                                                                                                
                                                                                                                }else if($explodeTypeGambar === "Update"){

                                                                                                                    //update foto villa
                                                                                                                    if($_FILES[array_keys($_FILES)[$j]]['size'] > 1048576){
                                                                                                                            
                                                                                                                        sendErrorMessage('Gambar Dengan nama '.$_FILES[array_keys($_FILES)[$j]]['name'].' melebihin 1 MB Proses di hentikan' , "notificationErrorField", null);
                                                                                                                        return false;
                                                                                                                        
                                                                                                                    }else{

                                                                                                                        if(exif_imagetype($_FILES[array_keys($_FILES)[$j]]['tmp_name']) !== 2 && exif_imagetype($_FILES[array_keys($_FILES)[$j]]['tmp_name']) !==  3){
                                                                                                                            
                                                                                                                            sendErrorMessage('Gambar Dengan nama '.$_FILES[array_keys($_FILES)[$j]]['name'].' Bukan merupakan format gambar yang di support' , "notificationErrorField", null);
                                                                                                                            return false;
                                                            
                                                                                                                        }else{
                                                                                                                            
                                                                                                                            for($r = 0; $r < count($originalFotoVilla); $r++){
                                                                                                                                
                                                                                                                                if($originalFotoVilla[$r] -> namaGambar === str_replace("Update", $idUnikVilla, str_replace("-", ".", array_keys($_FILES)[$j]))){
                                                                                                                                    
                                                                                                                                    $alamatGambar       = $originalFotoVilla[$r] -> urlGambar;
                                                                                                                                    $gambarLama         = $alamatGambar.$originalFotoVilla[$r] -> namaGambar;
                                                                                                                                    $gambarUploadBaru   = $alamatGambar.$_FILES[array_keys($_FILES)[$j]]['name'];
                                                                                                                                    $tmpName            = $_FILES[array_keys($_FILES)[$j]]['tmp_name'];

                                                                                                                                    if(move_uploaded_file($tmpName, $gambarUploadBaru)){

                                                                                                                                        if(file_exists($gambarLama)){

                                                                                                                                            if(unlink($gambarLama)){
            
                                                                                                                                            }
            
                                                                                                                                        }
                                                                                                                                        
                                                                                                                                        rename($gambarUploadBaru, $gambarLama);
                                                                                                                                    }

                                                                                                                                }

                                                                                                                            }
                                                                                                                        
                                                                                                                        }
                                                                                                                    
                                                                                                                    }

                                                                                                                }else if($explodeTypeGambar === "UFVG"){

                                                                                                                    if($_FILES[array_keys($_FILES)[$j]]['size'] > 1048576){
                                                                                                                            
                                                                                                                        sendErrorMessage('Gambar Dengan nama '.$_FILES[array_keys($_FILES)[$j]]['name'].' melebihin 1 MB Proses di hentikan' , "notificationErrorField", null);
                                                                                                                        return false;
                                                                                                                        
                                                                                                                    }else{

                                                                                                                        if(exif_imagetype($_FILES[array_keys($_FILES)[$j]]['tmp_name']) !== 2 && exif_imagetype($_FILES[array_keys($_FILES)[$j]]['tmp_name']) !==  3){
                                                                                                                            
                                                                                                                            sendErrorMessage('Gambar Dengan nama '.$_FILES[array_keys($_FILES)[$j]]['name'].' Bukan merupakan format gambar yang di support' , "notificationErrorField", null);
                                                                                                                            return false;
                                                            
                                                                                                                        }else{

                                                                                                                            $namaVillaTambah         = $_FILES[array_keys($_FILES)[$j]]['name'];
                                                                                                                            $replaceUFVG             = str_replace("UFVG", "FVG", array_keys($_FILES)[$j]);
                                                                                                                            $typeGambarBaru          = preg_replace('/[\_0-9]*$/', "", $replaceUFVG);
                                                                                                                            $namaVillaTambahBaru     = $idUnikVilla."_".$replaceUFVG.substr($namaVillaTambah, strlen($namaVillaTambah)-4, strlen($namaVillaTambah));

                                                                                                                            if(!file_exists($linkDefaultVilla.$idUnikVilla."/".$typeGambarBaru."/".$namaVillaTambahBaru)){

                                                                                                                                if(move_uploaded_file($_FILES[array_keys($_FILES)[$j]]['tmp_name'], $linkDefaultVilla.$idUnikVilla."/".$typeGambarBaru."/".$namaVillaTambah)){
                                                                                                                                    
                                                                                                                                    if(rename($linkDefaultVilla.$idUnikVilla."/".$typeGambarBaru."/".$namaVillaTambah, $linkDefaultVilla.$idUnikVilla."/".$typeGambarBaru."/".$namaVillaTambahBaru)){

                                                                                                                                        if(count($originalFotoVilla) > 0){
                                                                                                                                            
                                                                                                                                            if(in_array($namaVillaTambahBaru, array_column($originalFotoVilla, 'namaGambar'), true) === false){
                    
                                                                                                                                                array_push($objekJsonGambar, array('typeGambar' => $typeGambarBaru, 'namaGambar' => $namaVillaTambahBaru, 'urlGambar' => $linkDefaultVilla.$idUnikVilla."/".$typeGambarBaru."/"));
                    
                                                                                                                                            }
                    
                                                                                                                                        
                                                                                                                                    }

                                                                                                                                    }else{

                                                                                                                                        if(file_exists($linkDefaultVilla.$idUnikVilla."/".$typeGambarBaru."/".$namaVillaTambah)){
                                                                                                                                        
                                                                                                                                            unlink($linkDefaultVilla.$idUnikVilla."/".$typeGambarBaru."/".$namaVillaTambah);

                                                                                                                                        } 

                                                                                                                                    }

                                                                                                                                }
                                                                                                                            }
                                                                                                                        }
                                                                                                                        
                                                                                                                    }
                                                                                                                    
                                                                                                                }
                                                                                                                
                                                                                                            }

                                                                                                            //update hapus villa
                                                                                                            if(isset($_POST['HAPUS'])){

                                                                                                                if(!preg_match('/^[\s]*$/', $_POST['HAPUS'])){

                                                                                                                    if(is_array($_POST['HAPUS'])){

                                                                                                                        sendErrorMessage("Proses Tidak dapat di lanjutkan !", "notificationErrorField", null);
                                                                                                                        return false;
    
                                                                                                                    }else{

                                                                                                                        $arrayHapusFotoVilla    = explode(",", $_POST['HAPUS']);
                                                                                                                        $jumlahHapusFotoVilla   = count($arrayHapusFotoVilla);
                                                                                                                        $original               = json_decode($dataVilla['fasilitasvilla']) -> fotoVilla;
                                                                                                                        $fotoVIllaJson          = json_decode($dataVilla['fasilitasvilla']) -> fotoVilla;
                                                                                                                        $fototidakDiSet         = json_decode($dataVilla['fasilitasvilla']) -> fotoTidakDiSet;
                                                                                                                        $jumlahFotoVilla        = count($fotoVIllaJson);
                                                                                                                        $typeGambarArray        = [];
                                                                                                                        $totalDiHapus           = [];
                                                                                                                        $totalFotoDiSet         = [];

                                                                                                                        foreach($fotoVIllaJson as $typeGambar){
                                                                                                                            
                                                                                                                            if(!in_array($typeGambar -> typeGambar, $typeGambarArray)){
                                                                                                                                
                                                                                                                                array_push($typeGambarArray, $typeGambar -> typeGambar);
                                                                                                                                
                                                                                                                            }
                                                                                                                            
                                                                                                                        }
                                                                                                                        
                                                                                                                        foreach($typeGambarArray as $type){
                                                                                                                            
                                                                                                                            $test =0;

                                                                                                                            for($m = 0; $m < count($original); $m++){
                                                                                                                                
                                                                                                                                if($type === $original[$m] -> typeGambar){
                                                                                                                                    
                                                                                                                                    $test++;
                                                                                                                                    
                                                                                                                                }
                                                                                                                            }

                                                                                                                            $totalFotoDiSet[$type] = $test;
                                                                                                                        }
                                                                                                                        
                                                                                                                        for($l = 0; $l < $jumlahHapusFotoVilla; $l++){

                                                                                                                            for($m = 0; $m < count($original); $m++){
                                                                                                                                
                                                                                                                                $fotoListHapus = substr($arrayHapusFotoVilla[$l],4 ,strlen($arrayHapusFotoVilla[$l]));
                                                                                                                                

                                                                                                                                if($original[$m] -> namaGambar === $fotoListHapus){
                                                                                                                                    
                                                                                                                                    unset($fotoVIllaJson[$m]);

                                                                                                                                    if(file_exists($original[$m] -> urlGambar.$original[$m] -> namaGambar)){
                                                                                                                                        
                                                                                                                                        if(unlink($original[$m] -> urlGambar.$original[$m] -> namaGambar)){


                                                                                                                                        }
                                                                                                                                        
                                                                                                                                    }

                                                                                                                                    array_push($totalDiHapus, $original[$m] -> typeGambar);
                                                                                                                                
                                                                                                                                }
                                                                                                                            }
                                                                                                                        }

                                                                                                                        $vipotTypeGambar = array_count_values($totalDiHapus);

                                                                                                                        foreach(array_keys($vipotTypeGambar) as $o){
            
                                                                                                                            if($vipotTypeGambar[$o] >= $totalFotoDiSet[$o]){
                                                                                                                                
                                                                                                                                if(!in_array($o, $fasilitasGambarKSG)){
                                                                                                                                    
                                                                                                                                    array_push($fasilitasGambarKSG, $o);
                                                                                                                                
                                                                                                                                }
            
                                                                                                                            }
                                                                                                                            
                                                                                                                        }

                                                                                                                    }
                                                                                                                    
                                                                                                                }
                                                                                                                
                                                                                                            }


                                                                                                            if(isset($fotoVIllaJson)){

                                                                                                                $jumlahObjekJsonGambar = count($objekJsonGambar);

                                                                                                                if($jumlahObjekJsonGambar > 0){

                                                                                                                    for($q = 0; $q < $jumlahObjekJsonGambar; $q++){

                                                                                                                        if(in_array($objekJsonGambar[$q]['namaGambar'], array_column($originalFotoVilla, 'namaGambar'), true) === false){

                                                                                                                            array_push($fotoVIllaJson, $objekJsonGambar[$q]);

                                                                                                                        }

                                                                                                                    }   

                                                                                                                }

                                                                                                            }else{

                                                                                                                $fotoVIllaJson = $originalFotoVilla;

                                                                                                                if(count($objekJsonGambar) > 0){

                                                                                                                    for($r = 0; $r < count($objekJsonGambar); $r++){
                                                                                                                     
                                                                                                                        if(in_array($objekJsonGambar[$r]['namaGambar'], array_column($originalFotoVilla, 'namaGambar'), true) === false){

                                                                                                                            array_push($fotoVIllaJson, $objekJsonGambar[$r]);

                                                                                                                        }

                                                                                                                    } 
                                                                                                                }

                                                                                                            }

                                                                                                            
                                                                                                            $queryInputDataVilla = mysqli_query($koneksi, "UPDATE villa SET namavilla = '".$namaVilla."', lokasivilla = '".$alamatVilla."', fasilitasvilla = '".json_encode(array("Discount" => $discount, "fotoVilla" => array_values($fotoVIllaJson), "fasilitasVilla" => $dataJsonFasilitas, "fotoTidakDiSet" => array_values($fasilitasGambarKSG)))."', hargavilla = '".$hargaVilla."', deskripsi = '".$deskripsiVilla."' $Villa WHERE idunikvilla = BINARY('".$idUnikVilla."') ");
                                                                
                                                                                                            if(!$queryInputDataVilla){

                                                                                                                sendErrorMessage("Gagal Menyimpan data Villa ".mysqli_error($koneksi), "notificationErrorField", null);
                                                                                                                return false;
                                                                                                            
                                                                                                            }else{
                                                                                                                
                                                                                                                if(!isset($notifThumbnail)){

                                                                                                                    $notifThumbnail = "";

                                                                                                                }

                                                                                                                sendErrorMessage($notifThumbnail."DATA BERHASIL DI UPDATE, Silahkan Refresh Halaman Untuk Melihat Data Terupadte !", "OKE", null);
                                                                                                                return false;
                                                                                                            
                                                                                                            }
                                                                                                        
                                                                                                        }
                                                                                                    
                                                                                                    }
                                                                                                
                                                                                                // }
                                                                                        
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