<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include('../navbar_admin.php'); ?>
    <!-- format buat nambahin page / halaman baru -->
    <div class="page-wrapper new-theme toggled">
        <main class="page-content">
            <div class="container-fluid">
                <!-- format isi buat nambahin page / halaman baru -->

                <h2 class="border-bottom border-gray mb-4">Add New Villa</h2>

                <div class=" pl-0">
                    <form class="needs-validation" novalidate="">
                        <div class="mb-3">
                            <label>Nama Villa</label>
                            <input type="text" class="form-control" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Alamat</label>
                            <div class="input-group">
                                <textarea class="form-control" aria-label="With textarea"></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Fasilitas</label>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-bed text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control border-0" placeholder="Jumlah kamar">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-bath text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control border-0" placeholder="jumlah kamar mandi">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-shower text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control border-0" placeholder="Air panas yes/no">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-wifi text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control border-0" placeholder="Wifi ya/tidak">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-coffee text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control border-0" placeholder="jumlah ruang tamu">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-suitcase text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control border-0" placeholder="jumlah ruang multiguna">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-pagelines text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control border-0" placeholder="tempat hiburan seperti taman/kolam renang/area bermain">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-snowflake-o text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control border-0" placeholder="AC yes/no">
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <label for="address">Harga Permalam</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="btn bg-success text-white">
                                        Rp.
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Total harga permalam">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address2">Foto-foto</label>
                            
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1" multiple>
                                </li>
                            </ul>
                            <!-- <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile02">
                                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div> -->
                        </div>

                        <div class="mb-3">
                            <label for="address2">Alamat maps</label>
                            
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span>
                                        admin bisa input lokasi dengan maps
                                    </span>
                                </li>
                            </ul>
                        </div>

                       
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">tambah</button>
                    </form>
                </div>

                <!-- end format isi buat nambahin page / halaman baru -->
            </div>
        </main>
    </div>
    <!-- end format buat nambahin page / halaman baru -->
</body>

</html>