<?php

if(!preg_match('/^[\s]*$/', $_SERVER['QUERY_STRING'])){

die("JANGAN DI MASUKAN YANG ENGGAK2");
return false;

}else{

    include "../../Settings/ConfigDB/index.php";

    if(!isset($_POST['IDUV'], $_POST['KODE'])){

        header("location:list_villa_admin.php");
        return false;

    }else{

        
        if(preg_match('/^[\s]*$/', $_POST['KODE'])){

            header("location:list_villa_admin.php");
            return false;

        }else{

            if(preg_match('/^[\s]*$/', $_POST['IDUV'])){

                header("location:list_villa_admin.php");
                return false;

            }else{
                
                if(!preg_match('/^[0-9a-fA-F]*$/', $_POST['IDUV'])){

                    header("location:list_villa_admin.php");
                    return false;

                }else{

                    $queryCekIDVilla = mysqli_query($koneksi, "SELECT * FROM villa WHERE idunikvilla = BINARY('".$_POST['IDUV']."') ");
                    
                    if(!$queryCekIDVilla){
                        
                        die("Maaf Kami Gagal Menemukan Data Yang Di minta ".mysqli_error($koneksi));
                        return false;
                    
                    }else{
                        
                        if(mysqli_num_rows($queryCekIDVilla) !== 1){
                            
                            die("Data Villa tidak di temukan, data Mungkin Sudah Di Hapus, jika ini terus Terjadi Refresh Halaman !");
                            return false;
                        
                        }else{

                            $dataVilla = mysqli_fetch_array($queryCekIDVilla);

                        }
                    }
                }
            }
        }

    }  

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

                <h2 class="border-bottom border-gray mb-4">Update Data <?php echo $dataVilla['namavilla']; ?></h2>

                <!-- NOTE VALUE NANTI DI SHOW PER INPUTAN NYA -->

                <div class=" pl-0">
                    <form class="needs-validation" novalidate="">
                        <div class="mb-3">
                            <label>Nama Villa</label>
                            <input type="text" class="FV form-control" id="NamaVilla" value="<?php echo $dataVilla['namavilla']; ?>">
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Alamat</label>
                            <div class="input-group">
                                <textarea class="FV form-control" id="AlamatVilla" aria-label="With textarea"><?php echo $dataVilla['lokasivilla']; ?></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                        <script type="text/javascript">
                            tinymce.init({
                                selector    : '#deskripsi',
                                plugins     : 'autoresize, table, emoticons'
                            });
                        </script>
                            <label>Desripsi</label>
                            <div class="input-group">
                                <textarea class="FV form-control" id="deskripsi" aria-label="With textarea"><?php echo $dataVilla['deskripsi'];?></textarea>
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
                                <input type="text" class="FV form-control" id="HargaVilla" placeholder="Total harga permalam" value="<?php echo preg_replace('/\B(?<!\.)(?=(\d{3})+(?!\d))/', ".", $dataVilla['hargavilla']); ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address2">Tumbnail</label>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <?php echo '<img style="width:30%;" src="../../villa/'.$dataVilla['idunikvilla'].'/'.$dataVilla['thumbnail'].'" />'; ?>
                                    <input type="file" class="FV" accept="image/*" id="ThumbnailVilla">
                                </li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <label>Fasilitas</label>
                            <ul class="list-group">

                                <?php

                                    $fasilitasEncode    = json_decode($dataVilla['fasilitasvilla']);
                                    $fotoVilla          = $fasilitasEncode -> fotoVilla;
                                    $fasilitas          = $fasilitasEncode -> fasilitasVilla;
                                    $fotoTidakDiSet     = $fasilitasEncode -> fotoTidakDiSet;
                                    $jumlahFasilitas    = count($fasilitas);
                                    $arrayFasilitas     = [];
                                
                                    for($a = 0; $a < $jumlahFasilitas; $a++){

                                        foreach((array) $fasilitas[$a] as $nomorUrut => $text){

                                            $arrayFasilitas[$nomorUrut] = $text;

                                        }

                                    }

                                    for($b = 0; $b < count($arrayFasilitas); $b++){
                                        
                                    $namaIdFasilitas = array_keys($arrayFasilitas)[$b];
                                    
                                        if(explode("_", $namaIdFasilitas)[0] === "FVT"){
                                            
                                            if($arrayFasilitas[$namaIdFasilitas] === "TIDAK DI ISI"){
                                                
                                                $statusBidangText = "";
                                                $labelText        = "";
                                                
                                            }else{
                                                
                                                $labelText        = '<label class="text-secondary" for="'.$namaIdFasilitas.'">'.explode("_", $namaIdFasilitas)[1].'</label>';
                                                $statusBidangText = $arrayFasilitas[$namaIdFasilitas];
                                            
                                            }
                                            
                                            //edit field fasilitas vila disini
                                            echo'
                                                <li class="list-group-item">
                                                    '.$labelText.'
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="btn bg-success">
                                                                <i class="fa fa-pencil text-white"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="FV form-control border-0" id="'.$namaIdFasilitas.'" placeholder="'.explode("_", $namaIdFasilitas)[1].'" value="'.$statusBidangText.'">
                                                    </div>
                                                </li>';

                                        }else if(explode("_", $namaIdFasilitas)[0] === "FVC"){

                                            if($arrayFasilitas[$namaIdFasilitas] === "true"){

                                                $statusCentang = "checked";

                                            }else{

                                                $statusCentang = "";

                                            }

                                            //edit checkbox villa disini
                                            echo'
                                                <li class="list-group-item">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="btn bg-success">
                                                                <i class="fa fa-check text-white"></i>
                                                            </span>
                                                        </div>
                                                        <div class="custom-control custom-checkbox my-auto ml-5" style="left:1.8px;">
                                                            <input type="checkbox" class="FV custom-control-input" id="'.$namaIdFasilitas.'" aria-label="..." '.$statusCentang.'>
                                                            <label class="custom-control-label text-secondary" for="'.$namaIdFasilitas.'">'.explode("_", $namaIdFasilitas)[1].'</label>
                                                        </div>
                                                    </div>
                                                </li>';

                                        }

                                    }

                                ?>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <label>Foto-foto</label>
                            <?php
                                
                                $totalFotoTDS       = count($fotoTidakDiSet);
                                $typeGambar         = [];
                                
                                for($i = 0; $i < count($fotoVilla); $i++){
                                    
                                    if(!in_array($fotoVilla[$i] -> typeGambar, $typeGambar)){
                                        
                                        array_push($typeGambar, $fotoVilla[$i] -> typeGambar);
                                    
                                    }
                                
                                }
                                
                                for($j = 0; $j < count($typeGambar); $j++){
                                    
                                    $hitungJumlahAddFile = 0;
                                    $nomorUrutGambar     = 1;
                                
                                    echo '<div id="'.$typeGambar[$j].'" style="display: flex; margin:20px auto;  flex-flow: wrap;align-items: center;justify-content: center;background-color: #ebf9eb;padding: 5px;border-radius: 5px;">';    
                                        echo '<h6 style="width:100%;">FASILITAS '.str_replace("_", " ", str_replace("FVG_", "", $typeGambar[$j])).'</h6>';

                                        for($k = 0; $k < count($fotoVilla); $k++){
                                            
                                            if($fotoVilla[$k] -> typeGambar === $typeGambar[$j]){
                                            
                                                //EDIT GAMBAR DISINI
                                                echo '<div class="boxGambar" style="margin :10px; display:flex;align-content: center; width:20%; align-items: center;flex-wrap: wrap;justify-content: center;">';

                                                    echo '<input type="checkbox" class="FV CKH custom-checkbox" id="HCK_'.$fotoVilla[$k] -> namaGambar.'"><label for="'.$fotoVilla[$k] -> namaGambar.'">HAPUS</label>';
                                                    echo '<img class="FV" style="width :100%;   margin:5px;" src="'.$fotoVilla[$k] -> urlGambar.$fotoVilla[$k] -> namaGambar.'">';
                                                    echo '<input type="file" style="width:200px; text-align:center; font-size:12px;" id="'.$fotoVilla[$k] -> namaGambar.'" class="FV UPG form-control-file" accept="image/*">';

                                                echo '</div>';

                                                $hitungJumlahAddFile+=1;
                                                $nomorUrutGambar+=1;
                                            
                                            }
                                        }
                                    
                                        echo '<ul class="list-group">';
                                        
                                        if(abs(5 -  $hitungJumlahAddFile) > 0){
                                            
                                            for($n = 1; $n <= abs($hitungJumlahAddFile - 5); $n++){
                                                
                                                echo '<label class="mb-2">Tambah FASILITAS '.str_replace("_", " ", str_replace("FVG_", "", $typeGambar[$j])).' '.$nomorUrutGambar.'</label>
                                                      <li class="list-group-item mb-2">
                                                            
                                                            <input type="file" class="FV form-control-file" id="U'.$typeGambar[$j]."_".$nomorUrutGambar.'" accept="image/*">
                                                        
                                                      </li>';
                                                
                                                $nomorUrutGambar++;
                                            
                                            }
                                        
                                        }   
                                        
                                        echo '</ul>';
                                    echo '</div>';

                                }

                                if($totalFotoTDS > 0){

                                    //eDIT FILE INPUT DISINI, hanya akan menampilkan field file yang tidak di isi foto pada saat add villa
                                    echo '<ul class="list-group">';

                                        for($l = 0; $l < $totalFotoTDS; $l++){
                                            
                                            echo '<label class="mb-2">'.str_replace("_", " ", str_replace("FVG_", "", $fotoTidakDiSet[$l])).'</label>
                                                  <li class="list-group-item mb-2">
                                                        <input type="file" class="FV form-control-file" id="'.$fotoTidakDiSet[$l].'" multiple accept="image/*">
                                                  </li>';
                                        
                                        }   
                                        
                                    echo '</ul>';

                                }
                                echo '<script>
                                    
                                        function IDUV(){

                                            var IDUV;

                                            return IDUV = "'.$dataVilla['idunikvilla'].'";

                                        }

                                        function KODE(){

                                            var KODE;

                                            return KODE = "UPDATE";

                                        }

                                    </script>';

                            ?>
                        <div class="mb-3">
                            <label for="address2">Alamat maps</label>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span>
                                       COMIING SOOOON admin bisa input lokasi dengan maps
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <hr class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="list_villa_admin.php" class="btn btn-warning btn-lg btn-block" type="submit" >Batal</a>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-info btn-lg btn-block" type="button" id="updBtn">Update</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- end format isi buat nambahin page / halaman baru -->
            </div>
        </main>
    </div>
    <script src="../../Settings/js/updateVillaSystem.js"></script>
</body>

</html>