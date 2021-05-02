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
    <title>Document</title>

    <style>
        /* biar deskripsi iput width 100% */
        .tox {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include('../home.php'); ?>
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
                            <input type="text" class="FV form-control" id="NamaVilla" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Alamat</label>
                            <div class="input-group">
                                <textarea class="FV form-control" id="AlamatVilla" aria-label="With textarea"></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address">Harga Permalam</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="btn bg-success text-white">
                                        Rp.
                                    </span>
                                </div>
                                <input type="text" class="FV form-control" id="HargaVilla" placeholder="Total harga permalam">
                            </div>
                        </div>

                        <div class="mb-3">
                        <script type="text/javascript">
                            tinymce.init({
                                selector: '#deskripsi',
                                plugins : 'autoresize',
                                width   : '98%'
                            });
                        </script>
                            <label>Desripsi</label>
                            <div class="input-group DSV">
                                <textarea class="FV form-control" id="deskripsi" aria-label="With textarea"></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address2">Thumbnail</label>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <input type="file" class="FV" accept="image/*" id="ThumbnailVilla">
                                </li>
                            </ul>
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
                                        <input type="text" class="FV form-control border-0" id="FVT_KamarTidur" placeholder="Jumlah kamar">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-bath text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="FV form-control border-0" id="FVT_KamarMandi" placeholder="jumlah kamar mandi">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-coffee text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="FV form-control border-0" id="FVT_RuangTamu" placeholder="jumlah ruang tamu">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-cutlery text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="FV form-control border-0" id="FVT_Dapur" placeholder="jumlah dapur">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-suitcase text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="FV form-control border-0" id="FVT_RuangKeluarga" placeholder="jumlah ruang multiguna">
                                    </div>
                                </li>
                                
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-pagelines text-white"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="FV form-control border-0" id="FVT_TempatHiburan" placeholder="tempat hiburan seperti taman/kolam renang/area bermain">
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-moon-o text-white"></i>
                                            </span>
                                        </div>
                                        <div class="custom-control custom-checkbox my-auto ml-5" style="left:1.8px;">
                                            <input type="checkbox" class="FV custom-control-input" id="FVC_KamarIbadah" aria-label="...">
                                            <label class="custom-control-label text-secondary" for="FVC_KamarIbadah">Kamar Ibadah yes/no</label>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-snowflake-o text-white"></i>
                                            </span>
                                        </div>
                                        <div class="custom-control custom-checkbox my-auto ml-5" style="left:1.8px;">
                                            <input type="checkbox" class="FV custom-control-input" id="FVC_Ac" aria-label="...">
                                            <label class="custom-control-label text-secondary" for="FVC_Ac">AC yes/no</label>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-shower text-white"></i>
                                            </span>
                                        </div>
                                        <div class="custom-control custom-checkbox my-auto ml-5">
                                            <input type="checkbox" class="FV custom-control-input" id="FVC_AirPanas" aria-label="...">
                                            <label class="custom-control-label text-secondary" for="FVC_AirPanas">Air panas yes/no</label>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-wifi text-white"></i>
                                            </span>
                                        </div>
                                        <div class="custom-control custom-checkbox my-auto ml-5">
                                            <input type="checkbox" class="FV custom-control-input" id="FVC_Wifi" aria-label="...">
                                            <label class="custom-control-label text-secondary" for="FVC_Wifi">Wifi</label>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-television text-white"></i>
                                            </span>
                                        </div>
                                        <!-- <input type="text" class="FV form-control border-0" id="FVT_Televisi" placeholder="Tv ya/tidak"> -->
                                        <div class="custom-control custom-checkbox my-auto ml-5">
                                            <input type="checkbox" class="FV custom-control-input" id="FVC_Televisi" aria-label="...">
                                            <label class="custom-control-label text-secondary" for="FVC_Televisi">Tv yes/no</label>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="btn bg-success">
                                                <i class="fa fa-car text-white"></i>
                                            </span>
                                        </div>
                                        <!-- <input type="text" class="FV form-control border-0" id="FVT_AreaParkir" placeholder="Area parkir ya/tidak"> -->
                                        <div class="custom-control custom-checkbox my-auto ml-5">
                                            <input type="checkbox" class="FV custom-control-input" id="FVC_AreaParkir" aria-label="...">
                                            <label class="custom-control-label text-secondary" for="FVC_AreaParkir">Area parkir yes/no</label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <label>Foto Villa dan ruangan lain nya</label>
                            <ul class="list-group">
                                <label class="mb-2 ml-4">Bangunan Luar / Luar Villa</label>
                                <li class="list-group-item ml-4 mb-2">
                                    <input type="file" class="FV form-control-file" id="FVG_Bangunan_Luar_Villa" multiple accept="image/*" maxlength="4">
                                </li>

                                <label class="mb-2 ml-4">Foto Ruangan Villa, E.g Kamar Mandi, kamar tidur Dll</label>
                                <li class="list-group-item ml-4 mb-2">
                                    <input type="file" class="FV form-control-file" id="FVG_Bagunan_Dalam_Villa" multiple accept="image/*">
                                </li>

                                <label class="mb-2 ml-4">Fasilitas Tambahan</label>
                                <li class="list-group-item ml-4 mb-2">
                                    <input type="file" class="FV form-control-file" id="FVG_Fasilitas_Tambahan_Villa" multiple accept="image/*">
                                </li>

                                <label class="mb-2 ml-4">Area Rekreasi, E.g Taman Bermain, Taman Bungan, kolam renang dll</label>
                                <li class="list-group-item ml-4 mb-2">
                                    <input type="file" class="FV form-control-file" id="FVG_Area_Rekreasi_Villa" multiple accept="image/*">
                                </li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <label for="address2">Alamat maps</label>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span>
                                        cOMING sOON admin bisa input lokasi dengan maps
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit" id="advBtn">tambah</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="../../Settings/js/dashboardAdmin.js"></script>
</body>

</html>