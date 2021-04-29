<?php

if(!preg_match('/^[\s]*$/', $_SERVER['QUERY_STRING'])){

    die("JANGAN DI MASUKAN YANG ENGGAK2");
    return false;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Some Page</title>
</head>

<body>
    <?php include('../home.php'); ?>
    <!-- format buat nambahin page / halaman baru -->
    <div class="page-wrapper new-theme toggled">
        <main class="page-content">
        <div class="container-fluid">
                <!-- format isi buat nambahin page / halaman baru -->

                <!-- List vila -->
                <!-- NOTE MAX LIST YANG DITAMPILKAN CUMA 6 -->

                <div class="bg-white rounded box-shadow">
                    <h2 class="border-bottom border-gray ">List Villa</h2>

                    <!-- menu list -->
                    <div class="row">
                        <div class="col-md-6">
                            <a href="add_villa.php" class="btn btn-success ">
                                add new villa &nbsp;
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nama Villa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    
                    $queryDataVilla = mysqli_query($koneksi, "SELECT * FROM villa  WHERE primkey_data_villa <= 6 order by primkey_data_villa desc");

                            if(!$queryDataVilla){

                                die("Terjadi kegagalan Fungsi ".mysqli_error($koneksi));
                                return false;

                            }else{

                                if(mysqli_num_rows($queryDataVilla) <= 0){

                                    echo "BELUM TERDAPAT DATA VILLA !";

                                }else{

                                    while($dataVilla = mysqli_fetch_array($queryDataVilla)){

                                        echo '<div class="media text-muted pt-3">
                                                <img src="../../../Villa/'.$dataVilla['idunikvilla']."/".$dataVilla['thumbnail'].'" alt=" 32x32 " class="mr-2 rounded" style="width: 32px; height: 32px;" data-holder-rendered="true">
                                                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                    <strong class="d-block text-gray-dark">'.$dataVilla['namavilla'].'</strong>
                                                    ID VILLA : '.$dataVilla['idunikvilla'].' || STATUS VILLA : '.$dataVilla['statusvilla'].'
                                                </p>
                                                <div class="m-auto pb-3">
                                                    <a href="update_villa.php" class="btn btn-warning">
                                                        <i class="fa fa-cog text-white"></i>
                                                    </a>
                                                    <button type="button" id="'.$dataVilla['idunikvilla'].'" class="HVilla btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>';

                                    }

                                }

                            }

                    ?>

                    <!-- pagination -->
                    <small class="d-block text-right mt-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end m-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </small>
                </div>

                <!-- end format isi buat nambahin page / halaman baru -->
            </div>
        </main>
    </div>
    <script src="../../Settings/js/listVillaSystem.js"></script>
</body>

</html>