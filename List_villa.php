<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
                                <a href="/Detail_villa.php">
                                    <div class="card mb-5 mx-auto" style="max-width: 20rem;">
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
