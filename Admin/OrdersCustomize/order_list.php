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
                <!-- NOTE MAX LIST YANG DITAMPILKAN CUMA 4 DAN URUTKAN SESUAI TANGGAL PAING BARU -->

                <div class="bg-white rounded box-shadow">
                    <h2 class="border-bottom border-gray mb-4">List Pemesanan</h2>

                    <div class=" text-muted px-3 pt-3 mb-3 border rounded">
                        <div class=" pb-2 mb-2 border-bottom border-gray">
                            <p class="m-0">
                                <strong class="d-block text-gray-dark h5 m-0">
                                    Nama Pemesan
                                </strong>
                                <small class="text-danger ">
                                    ( Value tanggal batas pembayaran user )
                                    <!-- bila tanggal terlewat otomatis hapus -->
                                </small>
                                <hr class="m-0 mb-3" style="max-width: 280px;">
                                <strong class="d-block text-gray-dark">Nama Vila</strong>
                            </p>
                            <div class="row">
                                <!-- value tanggal booking -->
                                <div class="col-md-6">Tanggal Booking</div>
                                <!-- value max tamu -->
                                <div class="col-md-6">Max tamu</div>
                            </div>
                            <div class="row">
                                <!-- value Total Hari -->
                                <div class="col-md-6">Totah Hari</div>
                                <!-- value total Harga-->
                                <div class="col-md-6 h5">Total Harga</div>
                            </div>
                        </div>

                        <div class="m-auto pb-3 d-flex justify-content-end">
                            <a href="update_villa.php" class="btn btn-info mr-2">
                                <i class="fa fa-check-circle text-white"></i>
                                Pembayaran Selesai
                            </a>
                            <a href="" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>

                    <div class=" text-muted px-3 pt-3 mb-3 border rounded">
                        <div class=" pb-2 mb-2 border-bottom border-gray">
                            <p class="m-0">
                                <strong class="d-block text-gray-dark h5 m-0">
                                    Nama Pemesan
                                </strong>
                                <small class="text-danger ">
                                    ( Value tanggal batas pembayaran user )
                                    <!-- bila tanggal terlewat otomatis hapus -->
                                </small>
                                <hr class="m-0 mb-3" style="max-width: 280px;">
                                <strong class="d-block text-gray-dark">Nama Vila</strong>
                            </p>
                            <div class="row">
                                <!-- value tanggal booking -->
                                <div class="col-md-6">Tanggal Booking</div>
                                <!-- value max tamu -->
                                <div class="col-md-6">Max tamu</div>
                            </div>
                            <div class="row">
                                <!-- value Total Hari -->
                                <div class="col-md-6">Totah Hari</div>
                                <!-- value total Harga-->
                                <div class="col-md-6 h5">Total Harga</div>
                            </div>
                        </div>

                        <div class="m-auto pb-3 d-flex justify-content-end">
                            <a href="update_villa.php" class="btn btn-info mr-2">
                                <i class="fa fa-check-circle text-white"></i>
                                Pembayaran Selesai
                            </a>
                            <a href="" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>

                    <div class=" text-muted px-3 pt-3 mb-3 border rounded">
                        <div class=" pb-2 mb-2 border-bottom border-gray">
                            <p class="m-0">
                                <strong class="d-block text-gray-dark h5 m-0">
                                    Nama Pemesan
                                </strong>
                                <small class="text-danger ">
                                    ( Value tanggal batas pembayaran user )
                                    <!-- bila tanggal terlewat otomatis hapus -->
                                </small>
                                <hr class="m-0 mb-3" style="max-width: 280px;">
                                <strong class="d-block text-gray-dark">Nama Vila</strong>
                            </p>
                            <div class="row">
                                <!-- value tanggal booking -->
                                <div class="col-md-6">Tanggal Booking</div>
                                <!-- value max tamu -->
                                <div class="col-md-6">Max tamu</div>
                            </div>
                            <div class="row">
                                <!-- value Total Hari -->
                                <div class="col-md-6">Totah Hari</div>
                                <!-- value total Harga-->
                                <div class="col-md-6 h5">Total Harga</div>
                            </div>
                        </div>

                        <div class="m-auto pb-3 d-flex justify-content-end">
                            <a href="update_villa.php" class="btn btn-info mr-2">
                                <i class="fa fa-check-circle text-white"></i>
                                Pembayaran Selesai
                            </a>
                            <a href="" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>

                    <div class=" text-muted px-3 pt-3 mb-3 border rounded">
                        <div class=" pb-2 mb-2 border-bottom border-gray">
                            <p class="m-0">
                                <strong class="d-block text-gray-dark h5 m-0">
                                    Nama Pemesan
                                </strong>
                                <small class="text-danger ">
                                    ( Value tanggal batas pembayaran user )
                                    <!-- bila tanggal terlewat otomatis hapus -->
                                </small>
                                <hr class="m-0 mb-3" style="max-width: 280px;">
                                <strong class="d-block text-gray-dark">Nama Vila</strong>
                            </p>
                            <div class="row">
                                <!-- value tanggal booking -->
                                <div class="col-md-6">Tanggal Booking</div>
                                <!-- value max tamu -->
                                <div class="col-md-6">Max tamu</div>
                            </div>
                            <div class="row">
                                <!-- value Total Hari -->
                                <div class="col-md-6">Totah Hari</div>
                                <!-- value total Harga-->
                                <div class="col-md-6 h5">Total Harga</div>
                            </div>
                        </div>

                        <div class="m-auto pb-3 d-flex justify-content-end">
                            <a href="update_villa.php" class="btn btn-info mr-2">
                                <i class="fa fa-check-circle text-white"></i>
                                Pembayaran Selesai
                            </a>
                            <a href="" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>

                    

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