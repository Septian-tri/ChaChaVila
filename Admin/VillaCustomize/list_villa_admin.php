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
                <?php

                $limit            = 6;
                $tempHalamanVilla = 0;
                
                for($a = 0; $a < count($_POST); $a++){
                       
                    $pecah = explode("_", array_keys($_POST)[$a]);

                    if($pecah[0] === "bHalaman"){

                        if(count($pecah) > 1){

                            if(preg_match('/[0-9]{1,}/', $pecah[1])){

                                if($tempHalamanVilla <= 1){

                                    $tempHalamanVilla = 0;

                                }
                                
                                $tempHalamanVilla = $pecah[1] - 1;

                                

                            }

                        }

                    }

                }

                if(isset($_POST['fieldCariVilla'])){

                    $namaCariVilla = addslashes(htmlentities($_POST['fieldCariVilla'], ENT_QUOTES));

                    if(preg_match('/^[\s]*$/', $namaCariVilla)){
                    
                        $notifFieldErr = "SILAHKAN ISI BIDANG PENCARIAN TERLEBIH DAHULU";
                        goto SKIP;
                        
                    }else{
                        
                        $cariVilla      = "WHERE namavilla like '%".$namaCariVilla."%'";
                        $notif          = "DENGAN NAMA ".$namaCariVilla." ";
                        $field          = '<input type="hidden" class="form-control" name="fieldCariVilla" value="'.$namaCariVilla.'">'; 

                    }

                }else{

                    SKIP:
                    $cariVilla = "";
                    $notif     = "";
                    $field     = "";

                }

                $hitungJumlahVilla  = mysqli_query($koneksi, "SELECT * FROM villa $cariVilla");
                
                if(!$hitungJumlahVilla){
                    
                    die("Terjadi kegagalan Fungsi ".mysqli_error($koneksi));
                    return false;
                    
                }else{
                    
                    $jumlahTotalVilla   = mysqli_num_rows($hitungJumlahVilla);
                    $offset             = ceil($jumlahTotalVilla / $limit);
                    $queryDataVilla     = mysqli_query($koneksi, "SELECT * FROM villa $cariVilla order by namavilla asc limit ".($tempHalamanVilla * $limit).",$limit ");
                    
                    if(!$queryDataVilla){
                        
                        die("Terjadi kegagalan Fungsi ".mysqli_error($koneksi));
                        return false;
                        
                    }

                }

                ?>
                <div class="bg-white rounded box-shadow">
                    <h2 class="border-bottom border-gray ">List Villa, <?php echo $jumlahTotalVilla; ?> Terdaftar</h2>
                    <!-- menu list -->
                    <div class="row">
                        <div class="col-md-6">
                            <a href="add_villa.php" class="btn btn-success ">
                                add new villa &nbsp;
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <form class="input-group mb-3" name="carivilla" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <small><?php if(isset($notifFieldErr)){ echo $notifFieldErr; } ?></small>
                                <input type="text" class="form-control" name="fieldCariVilla" placeholder="Nama Villa" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" name="buttonFieldCV" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <?php

                    if(mysqli_num_rows($queryDataVilla) <= 0){
                        
                        echo "BELUM TERDAPAT DATA VILLA ".$notif."!";
                    
                    }else{
                        
                        while($dataVilla = mysqli_fetch_array($queryDataVilla)){
                            
                            echo '<div class="media text-muted pt-3">
                                    <img src="../../../Villa/'.$dataVilla['idunikvilla']."/".$dataVilla['thumbnail'].'" alt=" 32x32 " class="mr-2 rounded" style="width: 32px; height: 32px;" data-holder-rendered="true">
                                                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                                    <strong class="d-block text-gray-dark">'.$dataVilla['namavilla'].'</strong>
                                                    ID VILLA : '.$dataVilla['idunikvilla'].' || STATUS VILLA : '.$dataVilla['statusvilla'].'
                                                </p>
                                                <div class="m-auto pb-3">
                                                    <form name="'.$dataVilla['idunikvilla'].'" method="POST" action="update_villa.php">

                                                        <input type="hidden" value="'.$dataVilla['idunikvilla'].'" name="IDUV" />
                                                        <input type="hidden" value="UPDATE" name="KODE" />

                                                        <button id="U.'.$dataVilla['idunikvilla'].'" type="submit" class="UVilla btn btn-warning">
                                                            <i class="fa fa-cog text-white"></i>
                                                        </button>
                                                    
                                                        <button type="button" id="'.$dataVilla['idunikvilla'].'" class="HVilla btn btn-danger">
                                                            <i id="'.$dataVilla['idunikvilla'].'" class="HVilla fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>';

                                    }

                                }

                            

                    ?>

                    <!-- pagination -->
                    <small class="d-block text-right mt-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end m-0">
                                <?php
                                    function NomorHalaman($HalamanSaatini, $jumlahHalaman, $field){
                                        
                                        if($HalamanSaatini <= $jumlahHalaman && $HalamanSaatini >= 1){
                                            
                                            $link_Halaman = "";

                                            if($HalamanSaatini >= 1){
                                                
                                                $sebelum = $HalamanSaatini-1;
                                                
                                                if($HalamanSaatini >= 4){
                                                    
                                                    $link_Halaman .= '<li class="page-item">
                                                                        <form name="PAGE_1" method="POST" action="'.$_SERVER['PHP_SELF'].'">
                                                                            '.$field.'
                                                                            <button type="submit" name="bHalaman_1" value="bHalaman_1" class="page-link" id="PAGE_1">
                                                                                <i class="fa fa-step-backward" aria-hidden="true"></i>
                                                                            </button>
                                                                        </form>
                                                                      </li>
                                                                      
                                                                      <li class="page-item">
                                                                        <form name="PAGE_'.$sebelum.'" method="POST" action="'.$_SERVER['PHP_SELF'].'">
                                                                            '.$field.'
                                                                            <button type="submit" name="bHalaman_'.$sebelum.'" value="bHalaman_'.$sebelum.'" class="page-link" id="PAGE_'.$sebelum.'">
                                                                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                                                            </button>
                                                                        </form>
                                                                      </li>';
                                                
                                                }else{
                                                    
                                                    $link_Halaman .= '<li class="page-item disabled">
                                                                        <div class="page-link">
                                                                            <i class="fa fa-step-backward" aria-hidden="true"></i>
                                                                        </div>
                                                                      </li>
                                                                      
                                                                      <li class="page-item disabled">
                                                                        <div class="page-link">
                                                                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                                                        </div>
                                                                      </li>';
                                                }

                                            }
                                            
                                            if($HalamanSaatini > 3 ){
                                                
                                                $angka = '<li class="page-item disabled"><div class="page-link">...</div></li>';
                                            
                                            }else{
                                                
                                                $angka = ' ';
                                            
                                            }
                                            
                                            for($i=$HalamanSaatini-2; $i < $HalamanSaatini; $i++){
                                                
                                                if($i < 1){
                                                    
                                                    continue;
                                                
                                                }
                                                
                                                $angka .= '<li class="page-item">
                                                        <form name="PAGE_'.$i.'" method="POST" action="'.$_SERVER['PHP_SELF'].'">
                                                            '.$field.'
                                                            <button type="submit" name="bHalaman_'.$i.'" value="bHalaman_'.$i.'" class="page-link" id="PAGE_'.$i.'">'
                                                                .$i.
                                                            '</button>
                                                        </form>
                                                       </li>';
                                            }
                                        
                                            $angka .= '<li class="page-item active">
                                                            <div class="page-link sama" title="'.$HalamanSaatini.'" id="NoHalaman">'
                                                                .$HalamanSaatini.
                                                            '</div>
                                                        </li>';
                                            
                                            for($i=$HalamanSaatini+1; $i< ($HalamanSaatini+3); $i++){
                                                
                                                if($i > $jumlahHalaman){
                                                    
                                                    break;
                                                
                                                }
                                                
                                                $angka .= '<li class="page-item">
                                                                <form name="PAGE_'.$i.'" method="POST" action="'.$_SERVER['PHP_SELF'].'">
                                                                    '.$field.'
                                                                    <button type="submit" name="bHalaman_'.$i.'" value="bHalaman_'.$i.'" class="page-link" id="PAGE_'.$i.'">'
                                                                        .$i.
                                                                    '</button>
                                                                </form>
                                                            </li>';
                                            }
                                            
                                            if($HalamanSaatini+2 < $jumlahHalaman){
                                                
                                                $angka .= '<li class="page-item disabled">
                                                                <div class="page-link">...
                                                           </li>
                                                           <li class="page-item">
                                                               <form name="PAGE_'.$jumlahHalaman.'" method="POST" action="'.$_SERVER['PHP_SELF'].'">
                                                                    '.$field.'
                                                                    <button type="submit" name="bHalaman_'.$jumlahHalaman.'" value="bHalaman_'.$jumlahHalaman.'" class="page-link" id="PAGE_'.$jumlahHalaman.'">'
                                                                        .$jumlahHalaman.
                                                                    '</button>
                                                                </form>
                                                            </li>';
                                            
                                            }else{
                                                
                                                $angka .= ' ';
                                            
                                            }
                                            
                                            $link_Halaman .= $angka;
                                            
                                            if($HalamanSaatini <= $jumlahHalaman){
                                                
                                                if($HalamanSaatini < $jumlahHalaman){
                                                    
                                                    $berikutNya = $HalamanSaatini+1;
                                                    
                                                    $link_Halaman .= '<li class="page-item">
                                                                        <form name="PAGE_'.$berikutNya.'" method="POST" action="'.$_SERVER['PHP_SELF'].'">
                                                                            '.$field.'
                                                                            <button type="submit" name="bHalaman_'.$berikutNya.'" value="bHalaman_'.$berikutNya.'" class="page-link" id="PAGE_'.$berikutNya.'">
                                                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                        
                                                                    <li class="page-item">
                                                                        <form name="PAGE_'.$jumlahHalaman.'" method="POST" action="'.$_SERVER['PHP_SELF'].'">
                                                                            '.$field.'
                                                                            <button type="submit" name="bHalaman_'.$jumlahHalaman.'" value="bHalaman_'.$jumlahHalaman.'" class="page-link" id="PAGE_'.$jumlahHalaman.'">
                                                                                <i class="fa fa-step-forward" aria-hidden="true"></i>
                                                                            </button>
                                                                        </form>
                                                                    </li>';
                                                }else{

                                                    $link_Halaman .= '<li class="page-item disabled">
                                                                            <div class="page-link">
                                                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                                            </div>
                                                                      </li>
                                                                      <li class="page-item disabled">
                                                                            <div class="page-link">
                                                                                <i class="fa fa-step-forward" aria-hidden="true"></i>
                                                                            </div>
                                                                      </li>';
                
                                                }
                                        
                                            }
                                            
                                            return $link_Halaman;
                                        }

                                    }

                                    echo NomorHalaman(($tempHalamanVilla + 1), $offset, $field); 
                                    
                                    for($cp = 0; $cp < count(array_keys($_POST)); $cp++){
                                        
                                        unset($_POST[array_keys($_POST)[$cp]]);
                                        
                                    }
                                ?>
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