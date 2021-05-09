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
                                                                                                    
                                                                                                    // if(count($_FILES) <= 1){
                                                            
                                                                                                    //     for($ha = 0; $ha < count($_POST); $ha++){
                                                            
                                                                                                    //         if(explode("_", array_keys($_POST)[$ha])[0] === "FVG"){
                                                            
                                                                                                    //             sendErrorMessage(print_r($_FILES), "notificationErrorField", array_keys($_POST)[$ha]);
                                                                                                    //             return false;
                                                                                                            
                                                                                                    //         }
                                                                                                        
                                                                                                    //     }
                                                                                                    
                                                                                                    // }else{
                                                                                                        
                                                                                                            $namaVillaFolder    = md5(htmlentities($_POST['NamaVilla'], ENT_QUOTES));
                                                                                                            $namaVilla          = addslashes(htmlentities($_POST['NamaVilla'], ENT_QUOTES));
                                                                                                            $alamatVilla        = addslashes(htmlentities($_POST['AlamatVilla'], ENT_QUOTES));
                                                                                                            $hargaVilla         = $_POST['HargaVilla'];
                                                                                                            $deskripsiVilla     = addslashes(htmlentities($_POST['deskripsi'], ENT_QUOTES));
                                                                                                            $admin              = base64_decode(mysqli_fetch_array($queryCekDataAdmin)['namapengguna']);
                                                                                                            $fotoVIllaJson      = json_decode($dataVilla['fasilitasvilla']) -> fotoVilla;
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
                                                                    
                                                                                                                }

                                                                                                            }
                                                                                                            
                                                                                                            // for($j = 0; $j < count($_FILES); $j++){
                                                                
                                                                                                            //     if(explode("_", array_keys($_FILES)[$j])[0] === "FVG"){
                                                                
                                                                                                            //         if(count($_FILES[array_keys($_FILES)[$j]]['name']) > 5){
                                                                
                                                                                                            //             sendErrorMessage('Maaf Batas multiple hanya sampai 5 gambar', "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                            //             return false;
                                                                                                                    
                                                                                                            //         }else{
                                                                                                                        
                                                                                                            //             $nomorUrutGambar = 1;
                                                                                                                        
                                                                                                            //             for($k = 0; $k < count($_FILES[array_keys($_FILES)[$j]]['name']); $k++){
                                                                                                                            
                                                                                                            //                 $namaGambarVilla = $_FILES[array_keys($_FILES)[$j]]['name'][$k];
                                                                                                                            
                                                                                                            //                 if($_FILES[array_keys($_FILES)[$j]]['size'][$k] > 1048576){
                                                                                                                                
                                                                                                            //                     sendErrorMessage('Gambar Dengan nama '.$namaGambarVilla.' melebihin 1 MB Proses di hentikan' , "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                            //                     return false;
                                                                                                                            
                                                                                                            //                 }else{
                                                                                                                                
                                                                                                            //                     if(exif_imagetype($_FILES[array_keys($_FILES)[$j]]['tmp_name'][$k]) !== "IMAGETYPE_JPEG" XOR exif_imagetype($_FILES[array_keys($_FILES)[$j]]['tmp_name'][$k]) !==  "IMAGETYPE_PNG"){
                                                                
                                                                                                            //                         sendErrorMessage('Gambar Dengan nama '.$namaGambarVilla.' Bukan merupakan format gambar yang di support' , "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                            //                         return false;
                                                                
                                                                                                            //                     }else{
                                                                                                                                    
                                                                                                            //                         $direktoriNamaVilla     = $linkDefaultVilla.$idUnikVilla;
                                                                                                            //                         $subDirektoriNamaVilla  = $linkDefaultVilla.$idUnikVilla."/".array_keys($_FILES)[$j];
                                                                                                                                                            
                                                                                                            //                         if(!is_dir($subDirektoriNamaVilla)){
                                                                                                                                        
                                                                                                            //                             if(!mkdir($subDirektoriNamaVilla)){
                                                                                                                                            
                                                                                                            //                                 hapusFolder($subDirektoriNamaVilla);
                                                                                                            //                                 sendErrorMessage('Pembuatan Sub Direktori nama Vila Gagal Di buat Proses Di hentikan. folder Di Cleanup' , "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                            //                                 return false;
                                                                                                                                        
                                                                                                            //                             }
                                                                                                                                    
                                                                                                            //                         }
                                                                                                                                    
                                                                                                            //                         if(!move_uploaded_file($_FILES[array_keys($_FILES)[$j]]['tmp_name'][$k], $subDirektoriNamaVilla."/".$namaGambarVilla)){
                                                                
                                                                                                            //                             sendErrorMessage('Pembuatan Sub Direktori nama Vila Gagal Di buat Proses Di hentikan. folder Di Cleanup' , "notificationErrorField", array_keys($_FILES)[$j]);
                                                                                                            //                             return false;
                                                                                                                                    
                                                                                                            //                         }else{
                                                                                                                                        
                                                                                                            //                             $namaGambarRename = $idUnikVilla."_".array_keys($_FILES)[$j]."_".$nomorUrutGambar.substr($namaGambarVilla, strlen($namaGambarVilla)-4, strlen($namaGambarVilla));
                                                                                                                                        
                                                                                                            //                             if(rename($subDirektoriNamaVilla."/".$namaGambarVilla, $subDirektoriNamaVilla."/".$namaGambarRename)){
                                                                
                                                                                                            //                                 array_push($objekJsonGambar, array("typeGambar" => array_keys($_FILES)[$j], "namaGambar" => $namaGambarRename, "urlGambar" => $subDirektoriNamaVilla."/"));
                                                                
                                                                                                            //                             }else{
                                                                                                                                            
                                                                                                            //                                 sendErrorMessage('File Dengan nama '.$_FILES[array_keys($_FILES)[$j]]['name'][$k]." Gagal Di upload", "notificationErrorField", array_keys($_FILES)[$j]);
                                                                
                                                                                                            //                             }
                                                                                                                                    
                                                                                                            //                         }
                                                                                                                                
                                                                                                            //                     }
                                                                                                                            
                                                                                                            //                 } $nomorUrutGambar++;
                                                                                                                        
                                                                                                            //             }
                                                                                                                    
                                                                                                            //         }
                                                                                                                
                                                                                                            //     }
                                                                                                            
                                                                                                            // }

                                                                                                            //update hapus villa
                                                                                                            if(isset($_POST['HAPUS'])){

                                                                                                                if(!preg_match('/^[\s]*$/', $_POST['HAPUS'])){

                                                                                                                    if(is_array($_POST['HAPUS'])){

                                                                                                                        sendErrorMessage("Proses Tidak dapat di lanjutkan !", "notificationErrorField", null);
                                                                                                                        return false;
    
                                                                                                                    }else{

                                                                                                                        $arrayHapusFotoVilla    = explode(",", $_POST['HAPUS']);
                                                                                                                        $jumlahHapusFotoVilla   = count($arrayHapusFotoVilla);
                                                                                                                        $fotoVIllaJson          = json_decode($dataVilla['fasilitasvilla']) -> fotoVilla;
                                                                                                                        $jumlahFotoVilla        = count($fotoVIllaJson);
                                                                                                                        $typeGambarArray        = [];
                                                                                                                        $fotoVIllaJsonBaru      = [];

                                                                                                                        foreach($fotoVIllaJson as $typeGambar){
                                                                                                                            
                                                                                                                            if(!in_array($typeGambar -> typeGambar, $typeGambarArray)){
                                                                                                                                
                                                                                                                                array_push($typeGambarArray, $typeGambar -> typeGambar);
                                                                                                                                
                                                                                                                            }
                                                                                                                            
                                                                                                                        }
                                                                                                                        
                                                                                                                        for($l = 0; $l < $jumlahHapusFotoVilla; $l++){

                                                                                                                            $original = json_decode($dataVilla['fasilitasvilla']) -> fotoVilla;

                                                                                                                            for($m = 0; $m < count($original); $m++){
                                                                                                                                
                                                                                                                                $fotoListHapus = substr($arrayHapusFotoVilla[$l],4 ,strlen($arrayHapusFotoVilla[$l]));
                                                                                                                                
                                                                                                                                if($original[$m] -> namaGambar === $fotoListHapus){
                                                                                                                                    
                                                                                                                                    unset($fotoVIllaJson[$m]);

                                                                                                                                    if(file_exists($original[$m] -> urlGambar.$original[$m] -> namaGambar)){
                                                                                                                                        
                                                                                                                                        unlink($original[$m] -> urlGambar.$original[$m] -> namaGambar);
                                                                                                                                        
                                                                                                                                    }

                                                                                                                                }
                                                                                                                                
                                                                                                                            }
                                                                                                                            
                                                                                                                        }
                                                                                                                        
                                                                                                                    }
                                                                                                                    
                                                                                                                }
                                                                                                                
                                                                                                            }
                                                                                                            
                                                                                                            $queryInputDataVilla = mysqli_query($koneksi, "UPDATE villa SET namavilla = '".$namaVilla."', lokasivilla = '".$alamatVilla."', statusvilla = 'KOSONG', fasilitasvilla = '".json_encode(array("fotoVilla" => array_values($fotoVIllaJson), "fasilitasVilla" => $dataJsonFasilitas, "fotoTidakDiSet" => $fasilitasGambarKSG))."', hargavilla = '".$hargaVilla."', deskripsi = '".$deskripsiVilla."' $Villa WHERE idunikvilla = BINARY('".$idUnikVilla."') ");
                                                                
                                                                                                            if(!$queryInputDataVilla){

                                                                                                                sendErrorMessage("Gagal Menyimpan data Villa ".mysqli_error($koneksi), "notificationErrorField", null);
                                                                                                                return false;
                                                                                                            
                                                                                                            }else{
                                                                                                                
                                                                                                                sendErrorMessage("DATA BERHASIL DI SIMPAN !", "notificationErrorField", null);
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