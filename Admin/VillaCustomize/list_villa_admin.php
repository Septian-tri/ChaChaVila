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

                        $queryDataVilla = mysqli_query($koneksi, "SELECT * FROM villa");

                        if(!$queryDataVilla){

                            die("Terjadi kegagalan Fungsi ".mysqli_error($koneksi));
                            return false;

                        }else{

                            if(mysqli_num_rows($queryDataVilla) <= 0){

                                echo "BELUM TERDAPAT DATA VILLA !";

                            }else{

                                while($dataVilla = mysqli_fetch_array($queryDataVilla)){

                                    echo '<div class="media text-muted pt-3">
                                            <img src="../../../Villa/'.$dataVilla['idunikvilla']."/".$dataVilla['thumbnail'].'" alt=" 32x32 " class="mr-2 rounded" style="width: 32px; height: 32px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_178e2de5049%20text%20%7B%20fill%3A%23007bff%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_178e2de5049%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23007bff%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2212.166666746139526%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                <strong class="d-block text-gray-dark">'.$dataVilla['namavilla'].'</strong>
                                                ID VILLA : '.$dataVilla['idunikvilla'].' || STATUS VILLA : '.$dataVilla['statusvilla'].'
                                            </p>
                                            <div class="m-auto pb-3">
                                                <a href="update_villa.php" class="btn btn-warning">
                                                    <i class="fa fa-cog text-white"></i>
                                                </a>
                                                <a href="" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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

    <script src="../../Settings/js/dashboardAdmin.js"></script>
</body>

</html>