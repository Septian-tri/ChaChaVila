<?php

    include "mainSystem.php";

    session_name("_lgn");
    session_start();

    if(!isset($_POST['email'], $_POST['password'])){

        sendErrorMessage("Proses tidak dapat di lanjutkan !", "notificationErrorField", "form-control");
        exit;
        return false;
    
    }else{
    
        if(strlen($_POST['email']) <= 0 && strlen($_POST['password']) <= 0){
    
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
                        
                        if(preg_match('/^[\s]*$/', $_POST["password"])){
                            
                            sendErrorMessage('Hai..Maaf, Seperti nya kata sandi kamu masih kosong ', "notificationErrorField", "password");
                            exit;
                            return false;
                            
                        }else{

                            if(strlen($_POST["password"]) < 8){
                                                                            
                                sendErrorMessage('Hai..Maaf, Masukan paling sedikit 8 digit, dan maksimal 100 digit', "notificationErrorField", "repassword");
                                exit;
                                return false;
                            
                            }else{
                                
                                include "../ConfigDB/index.php";

                                function cekDataUdahAdaAtauBelum($koneksi, $data, $valData){

                                    $cekuserdata = mysqli_query($koneksi, "SELECT * FROM admindata WHERE ".$data." = '".$valData."' ");

                                    if(!$cekuserdata){
                                        
                                    sendErrorMessage(mysqli_error($koneksi), 'notificationErrorField', null);
                                    exit;
                                    
                                    
                                    }else{

                                        if(mysqli_num_rows($cekuserdata) > 0){
                                            
                                            return false;
                                        
                                        }else{

                                            return true;

                                        }

                                    }

                                }

                                if(cekDataMasterAdmin($koneksi) === false){

                                    sendErrorMessage('Silahkan Daftar Akun Master Admin Terelebih Dahulu !', "notificationErrorField", null);
                                    exit;
                                    return false;
                                
                                }else{

                                    if(explode('@', strtolower($_POST["email"]))[1]  === 'gmail.com'){
                                                                                        
                                        $cariTitik          = str_replace('.', '', explode('@', strtolower($_POST["email"]))[0]);
                                        $filterDomainemail  = $cariTitik.'@'.explode('@', strtolower($_POST["email"]))[1];
                                    
                                    }else{

                                        $filterDomainemail = strtolower($_POST["email"]);
                                    
                                    }

                                    $emailPengguna     = base64_encode($filterDomainemail);
                                    $Garem             = "*|_*_|* Semoga Semua Yang Di Kerja Kan Menghasilkan Kesuksesan...Aamiin *|_*_|*";
                                    $password          = md5($_POST["password"]." ".$Garem);
                                    $queryDataPengguna = mysqli_query($koneksi,"SELECT * FROM admindata WHERE email = '$emailPengguna' ");

                                    if(!$queryDataPengguna){

                                        sendErrorMessage('Opps..Maaf kami mengalami kegaglan sistem silahkan ulangi', "notificationErrorField", null);                        
                                        exit;
                                        return false;

                                    }else{

                                        if(mysqli_num_rows($queryDataPengguna) !== 1){

                                            catatProsesGagalLogin();
                                            sendErrorMessage('Opps..Maaf email atau sandi Salah Silahkan Ulangi', "notificationErrorField", null);                     
                                            exit;
                                            return false;

                                        }else{

                                            $querySandiPengguna = mysqli_query($koneksi,"SELECT * FROM admindata WHERE email = '$emailPengguna' and password = '".$password."' ");

                                            if(!$querySandiPengguna){

                                                sendErrorMessage('Opps..Maaf kami mengalami kegaglan sistem silahkan ulangi', "notificationErrorField", null);                        
                                                exit;
                                                return false;

                                            }else{

                                                if(mysqli_num_rows($querySandiPengguna) !== 1){

                                                    catatProsesGagalLogin();
                                                    sendErrorMessage('Opps..Maaf email atau sandi Salah Silahkan Ulangi', "notificationErrorField", null);                     
                                                    exit;
                                                    return false;

                                                }else{

                                                    $randomKarakterTokSem   = "abcdefghijklmnopqrstuvwxyz.*1234567890_-.ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                                    $genarateRandomString   = str_shuffle($randomKarakterTokSem);
                                                    $genarateRandomString2  = str_shuffle($randomKarakterTokSem);
                                                    $dataAdmin              = mysqli_fetch_array($querySandiPengguna);
                                                    $idrandom               = $dataAdmin['idrandom'];
                                                    $tipeLogin              = $dataAdmin['typepengguna'];

                                                    
                                                    $_SESSION['TokenSementara'] = $genarateRandomString."?".$genarateRandomString2;
                                                    $_SESSION['IR']             = base64_encode($idrandom);
                                                    $_SESSION['TLOGIN']         = base64_encode($dataAdmin['typeakun']);
                                                    session_regenerate_id(true);

                                                    $cekTokenSementara = mysqli_query($koneksi, "SELECT * FROM temptokenmasuk WHERE idrandom = '".$idrandom."' ");

                                                    if(!$cekTokenSementara){

                                                        sendErrorMessage('Opps..Maaf kami mengalami kegaglan sistem silahkan ulangi', "notificationErrorField", null);                        
                                                        exit;
                                                        return false;
                                                    
                                                    }else{

                                                        function buatUpdateDataMasuk($mode, $koneksi, $tipeLogin, $idrandom, $genarateRandomString, $genarateRandomString2, $cekTokenSementara){

                                                                $jumlahIdUnik = mysqli_fetch_array($cekTokenSementara);
                                                                $tanggalMasuk = strtotime("Today ".date("H:i:s"));
                
                                                                if($jumlahIdUnik <= 0){
                
                                                                    $queryTempLogin = mysqli_query($koneksi, "INSERT INTO temptokenmasuk (tanggalLogin, token, idrandom, typeDataMasuk) VALUES ('$tanggalMasuk', '".md5($genarateRandomString)."', '$idrandom', '$tipeLogin') ");
                                                                
                                                                }else{
                
                                                                    $queryTempLogin = mysqli_query($koneksi, "UPDATE temptokenmasuk SET  tanggalLogin = '$tanggalMasuk', token = '".md5($genarateRandomString)."', typeDataMasuk = '$tipeLogin' WHERE idrandom = '$idrandom' ");
                                    
                                                                }

                                                                if($mode == 'CekStatus'){

                                                                    if(!$queryTempLogin){
                                                                
                                                                        return false;
        
                                                                }else{

                                                                        return true;
        
                                                                }

                                                                }else{

                                                                    if(!$queryTempLogin){
                                                                
                                                                        return  sendErrorMessage("Gagal masuk ".mysqli_error($koneksi), "notificationErrorField", null);  
        
                                                                    }
                                                                }
                                                            }

                                                        if(buatUpdateDataMasuk('CekStatus', $koneksi, $tipeLogin, $idrandom, $genarateRandomString, $genarateRandomString2, $cekTokenSementara) == false){

                                                            buatUpdateDataMasuk(true, $koneksi, $tipeLogin, $idrandom, $genarateRandomString, $genarateRandomString2, $cekTokenSementara);
                                                            exit;
                                                            return false;

                                                        }else{

                                                            sendErrorMessage("Harap Menunggu", "OKE", null); 
                                                            exit;
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

?>