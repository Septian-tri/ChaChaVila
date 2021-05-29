<?php
    
    include "Settings/ProsesSystem/MainSystem.php";
    include "Settings/ConfigDB/index.php";
    session_name('_lgnUs');
    session_start();
    session_regenerate_id(true);

    if(cekSession() === false){
        
        session_destroy();
        
    }else{
        
        
        if(!preg_match('/^[a-zA-Z0-9\.\*\_\-\?]{135}$/', $_SESSION['TokenSementara'])){

            session_destroy();

        }else{

            $queryCekDataSession = mysqli_query($koneksi, "SELECT email, token, idrandom FROM temptokenmasuk WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and token = BINARY('".md5(explode('?', $_SESSION['TokenSementara'])[0])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

            if(!$queryCekDataSession){

                session_destroy();

            }else{

                if(mysqli_num_rows($queryCekDataSession) !== 1){

                    session_destroy();
                    echo "AKUN SEDANG LOGIN DI TEMPAT LAIN";

                }else{

                    $queryCekDataUser = mysqli_query($koneksi, "SELECT idrandom, email, namapengguna, namapanggilan FROM userdata WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

                    if(!$queryCekDataUser){
            
                        session_destroy();
            
                    }else{

                        if(mysqli_num_rows($queryCekDataUser) !== 1){

                            session_destroy();

                        }else{

                            if(cekValidasiEmail($koneksi, 'userdata') === false){

                                header("location:verifikasiEmailUser.php");
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

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            <?php

                if(isset($data)){

                    echo "Hai ".$data['namaPanggilan']." selamat datang di ".$_SERVER['HTTP_HOST']." nikmati sewa villa dengan mudah dan cepat";

                }else{

                    echo "selamat datang di ".$_SERVER['HTTP_HOST']." nikmati sewa villa dengan mudah dan cepat";

                }

            ?>
        </title>

    </head>
    <body id="bg">
    
        <?php include('Navbar.php'); ?>
            
        <div class="container">

            <div class="container mb-5">
                <form class="form-inline my-2 my-lg-0 justify-content-end">
                    <div class="mr-5 text-white">
                        <h4>Search by <span class="text-success">Name</span> : </h4>
                    </div>
                    <input class="form-control mr-sm-2" type="search" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <div class="sections">
                <div class="col-12">
                    <div class="text-white">
                        <p class="text-uppercase h4">Introducing </p>
                        <hr />
                        <h1>CHACHA VILA PUNCAK</h1>
                        <p>
                            A website for renting villas in the area around Cisarua, where you can enjoy comfort while traveling or on vacation with cool air and beautiful hilly views
                        </p>
                    </div>
                </div>
            </div>  
            <div class="row">
            <?php

                $queryVilla      = mysqli_query($koneksi, "SELECT idunikvilla, namavilla, hargavilla, thumbnail, lokasivilla FROM villa order by RAND() ");
                $hitungVilla     = mysqli_num_rows($queryVilla);

                if(!$queryVilla){

                    die("MAAF KAMI MENGALAMI KEGAGALAN SISTEM ! ");
                    return false;

                }else{

                    while($dataVilla = mysqli_fetch_array($queryVilla)){

                        echo  '
                    
                            <div class="col-sm-6 col-lg-4">
                                <div class="card mb-5 mx-auto" style="max-width: 20rem;"> 
                                    <a href="/Detail_villa.php?VID='.$dataVilla['idunikvilla'].'">
                                        <div class="card-header bg-behance content-center p-0">
                                            <img class="card-img-top" src="/Villa/'.$dataVilla['idunikvilla']."/".$dataVilla['thumbnail'].'" alt="First slide">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">'.$dataVilla['namavilla'].'</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">'.$dataVilla['lokasivilla'].'</h6>
                                            <p class="card-text">
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star-half text-warning"></i>
                                            </p>
                                            <small class="card-subtitle mb-2 text-muted">
                                                <s>Rp 2.000.000</s>
                                            </small>
                                            <p class="card-text">
                                                Rp '.preg_replace('/\B(?<!\.)(?=(\d{3})+(?!\d))/', ".", $dataVilla['hargavilla']).' ,-
                                                <small class="card-subtitle mb-2 text-muted">/ Night</small>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>';

                }

                
            }
            ?>
            </div>
        </div>
        <script src="Settings/js/main.js"></script>
    </body>
</html>