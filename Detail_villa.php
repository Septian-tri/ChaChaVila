<?php
if(!preg_match('/^[V]{1}[I]{1}[D]{1}[\=]{1}[a-zA-Z0-9]{15,}$/', $_SERVER['QUERY_STRING'])){

    header("location:/");
    return false;

}else{

    if(!isset($_GET['VID'])){

        header("location:/");
        return false;

    }else{

        if(!preg_match('/^[a-zA-Z0-9]{15,}$/', $_GET['VID'])){

            header("location:/");
            return false;
    
        }else{

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
            

            $queryCekIDVilla = mysqli_query($koneksi, "SELECT idunikvilla, namavilla, lokasivilla, deskripsi, fasilitasvilla, hargavilla FROM villa WHERE idunikvilla = BINARY('".$_GET['VID']."') ");
            
            if(!$queryCekIDVilla){
                
                die("Maaf Kami Gagal Menemukan Data Yang Di minta ".mysqli_error($koneksi));
                return false;
            
            }else{
                
                if(mysqli_num_rows($queryCekIDVilla) !== 1){
                    
                    die("UPSS...Maaf Villa Tidak Di temukan !");
                    return false;
                
                }else{
                    
                    if(!file_exists("Villa/".$_GET['VID'])){

                        die("Folder Villa Tidak Dapat Di temukan !");
                        return false;

                    }else{

                        $dataVilla              = mysqli_fetch_array($queryCekIDVilla);
                        $namaVilla              = stripslashes(html_entity_decode($dataVilla['namavilla'])); 
                        $deskripsiVilla         = stripslashes(html_entity_decode($dataVilla['deskripsi']));
                        $fasilitasVilla         = json_decode($dataVilla['fasilitasvilla']);
                        $fasilitasVillaFoto     = $fasilitasVilla -> fotoVilla;
                        $fasilitasVillaText     = $fasilitasVilla -> fasilitasVilla;
                        $jumlahFasilitasFoto    = count($fasilitasVillaFoto);
                        $haragaVilla            = $dataVilla['hargavilla'];
                        $lokasivilla            = $dataVilla['lokasivilla'];
                        $idUnikVilla            = $dataVilla['idunikvilla'];

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

        <title>Sewa Penginapan <?php echo $namaVilla; ?></title>

        <style>

            img{
                max-width:100%;
                min-width:100%;
            }

            .btn-group img{
                width : 100%;
            }

            /* Styles the thumbnail */

            a.lightbox img {
            width   : 30%;
            height  : auto;
            border  : 3px solid white;
            box-shadow: 0px 0px 8px rgba(0,0,0,.3);
            /* display: block; */
            }

            /* Styles the lightbox, removes it from sight and adds the fade-in transition */

            .lightbox-target {
            position: fixed;
            top: -100%;
            width: 100%;
            background: rgba(0,0,0,.7);
            width: 100%;
            opacity: 0;
            -webkit-transition: opacity .5s ease-in-out;
            -moz-transition: opacity .5s ease-in-out;
            -o-transition: opacity .5s ease-in-out;
            transition: opacity .5s ease-in-out;
            overflow: hidden;
            }

            /* Styles the lightbox image, centers it vertically and horizontally, adds the zoom-in transition and makes it responsive using a combination of margin and absolute positioning */

            .lightbox-target img {
            margin: auto;
            position: absolute;
            top: 0;
            left:0;
            right:0;
            bottom: 0;
            max-height: 0%;
            max-width: 0%;
            border: 3px solid white;
            box-shadow: 0px 0px 8px rgba(0,0,0,.3);
            box-sizing: border-box;
            -webkit-transition: .5s ease-in-out;
            -moz-transition: .5s ease-in-out;
            -o-transition: .5s ease-in-out;
            transition: .5s ease-in-out;
            }

            /* Styles the close link, adds the slide down transition */

            a.lightbox-close {
            display: block;
            width:50px;
            height:50px;
            box-sizing: border-box;
            background: white;
            color: black;
            text-decoration: none;
            position: absolute;
            top: -80px;
            right: 0;
            -webkit-transition: .5s ease-in-out;
            -moz-transition: .5s ease-in-out;
            -o-transition: .5s ease-in-out;
            transition: .5s ease-in-out;
            }

            /* Provides part of the "X" to eliminate an image from the close link */

            a.lightbox-close:before {
            content: "";
            display: block;
            height: 30px;
            width: 1px;
            background: black;
            position: absolute;
            left: 26px;
            top:10px;
            -webkit-transform:rotate(45deg);
            -moz-transform:rotate(45deg);
            -o-transform:rotate(45deg);
            transform:rotate(45deg);
            }

            /* Provides part of the "X" to eliminate an image from the close link */

            a.lightbox-close:after {
            content: "";
            display: block;
            height: 30px;
            width: 1px;
            background: black;
            position: absolute;
            left: 26px;
            top:10px;
            -webkit-transform:rotate(-45deg);
            -moz-transform:rotate(-45deg);
            -o-transform:rotate(-45deg);
            transform:rotate(-45deg);
            }

            /* Uses the :target pseudo-class to perform the animations upon clicking the .lightbox-target anchor */

            .lightbox-target:target {
            opacity: 1;
            top: 0;
            bottom: 0;
            }

            .lightbox-target:target img {
            max-height: 100%;
            max-width: 100%;
            }

            .lightbox-target:target a.lightbox-close {
            top: 0px;
            }

            .typeGambar{
                width : 100%;
            }
        </style>

    </head>
    <body id="bg">
    <?php include('Navbar.php'); ?>
    <div class="container">
        <div class="kembali lightbox">
            <i class="fa fa-arrow-left fa-3x text-white mb-3" aria-hidden="true"></i>
        </div>
        <?php
        
            $vipotTypeGambar = [];
            
            for($a = 0; $a < count($fasilitasVillaFoto); $a++){
                
                if(!in_array($fasilitasVillaFoto[$a] -> typeGambar, $vipotTypeGambar)){
                    
                    array_push($vipotTypeGambar, $fasilitasVillaFoto[$a] -> typeGambar);
                
                }
            
            }
            
            for($b = 0; $b < count($vipotTypeGambar); $b++){
                
                $explodeType = explode("_", $vipotTypeGambar[$b]);
                $textJudul   = "";

                for($ba = 0; $ba < count($explodeType); $ba++){
                    
                    if($ba !== 0){
                        
                        if($ba === 1){
                            
                            $spasi = "";
                            
                        }else{
                            
                            $spasi = " ";
                        }
                        
                        $textJudul.=$spasi.$explodeType[$ba];
                        
                    }
                    
                }
                
                //type Gambar villa
                echo '<div class="btn-group">';
                echo '<div class="typeGambar">'.$textJudul.'</div>';

                for($c = 0; $c < count($fasilitasVillaFoto); $c++){
                    
                    
                    if($fasilitasVillaFoto[$c] -> typeGambar === $vipotTypeGambar[$b]){
                        
                        echo '<a class="lightbox" href="#'.$vipotTypeGambar[$b].'">
                                <img class="fv" src="'.$fasilitasVillaFoto[$c] -> urlGambar.$fasilitasVillaFoto[$c] -> namaGambar.'"/>
                              </a>';
                    
                    }
                    
                    
                }
                
                echo '</div>';
            }

        ?>
        <div class="rounded-bottom bg-white p-3">
            <a href="Foto_villa.php" class="float-right btn btn-light text-primary py-0">
                <small> Lihat Semua Foto </small>
            </a>
            <h2 class="mt-4">
                <?php echo $namaVilla; ?>
            </h2>
            <hr/>
            <p>
                <?php echo $deskripsiVilla; ?>
            </p>
            <i class="fa fa-users mr-1 mb-3"></i> 6 Tamu
            <?php

                    if(isset($fasilitasVilla -> Discount)){
                       
                        if($fasilitasVilla -> Discount !== "TIDAK TERSEDIA"){

                            $disc = $fasilitasVilla -> Discount;

                            echo '<p class="mb-2 text-muted">
                                    Rp. <s>'.preg_replace('/\B(?<!\.)(?=(\d{3})+(?!\d))/', ".", $haragaVilla).'</s> / Night 
                                    <span class="badge badge-primary"> 
                                        Disc '.round(($fasilitasVilla -> Discount / $haragaVilla) * 100, 2).'%
                                    </span>
                                  </p>
                                  <h4 class="">
                                    Rp. '.preg_replace('/\B(?<!\.)(?=(\d{3})+(?!\d))/', ".", ($haragaVilla - $fasilitasVilla -> Discount)).'
                                    <small class="e mb-2 text-muted"> / Night</small>
                                  </h4>';
                        }else{

                            $disc = 0;
                            goto HargaNormal;

                        }

                    }else{

                        HargaNormal:
                        echo '<h4 class="">
                                Rp. '.preg_replace('/\B(?<!\.)(?=(\d{3})+(?!\d))/', ".", $haragaVilla).'
                                <small class="e mb-2 text-muted"> / Night</small>
                              </h4>';

                    }

                ?>
                <div class="container p-0">
        <a class="lightbox" href="s">
            <i class="fa fa-arrow-left fa-3x text-white mb-3" aria-hidden="true"></i>
        </a>
    </div>

    
            </div>
        </div>

        
        <!-- modal -->
        <div class="lightbox-target" id="1">
            <img src="http://placehold.it/700x400"/>
            <a class="lightbox-close" href="#"></a>
        </div>
        <div class="lightbox-target" id="2">
            <img src="http://placehold.it/400x400"/>
            <a class="lightbox-close" href="#"></a>
        </div>
        <div class="lightbox-target" id="3">
            <img src="http://placehold.it/700x400"/>
            <a class="lightbox-close" href="#"></a>
        </div>
        <div class="lightbox-target" id="4">
            <img src="http://placehold.it/400x400"/>
            <a class="lightbox-close" href="#"></a>
        </div>
        <div class="lightbox-target" id="5">
            <img src="http://placehold.it/400x400"/>
            <a class="lightbox-close" href="#"></a>
        </div>
        <!-- modal -->

        <div class="container">
            <div class="rounded bg-white mt-3 p-3">
                <h4>FASILTAS & RUANGAN</h4>
                <hr/>
                <p>
                   <?php 
                        for($d = 0; $d < count($fasilitasVillaText); $d++){

                            $fasilitasArray = (array)$fasilitasVillaText[$d];

                            for($e =0; $e < count(array_keys($fasilitasArray)); $e++){

                                $valueFasilitasArray = $fasilitasArray[array_keys($fasilitasArray)[$e]];
                                $labelFasilitas      = preg_replace("/(?<=[^A-Z])[A-Z]/", " $0", explode("_", array_keys($fasilitasArray)[$e])[1]);

                                if($valueFasilitasArray !== "TIDAK DI ISI"){

                                    if($valueFasilitasArray === "true"){

                                        echo $labelFasilitas." : Tersedia<br />";

                                    }else if($valueFasilitasArray === "false"){

                                        echo $labelFasilitas." : Tidak Tersedia<br />";

                                    }else if(preg_match("/^[1-9]*$/" , $valueFasilitasArray)){

                                        echo  $valueFasilitasArray." ".$labelFasilitas."<br />";

                                    }
                                }

                            }

                        }
                   ?>
                </p>
            </div>
            <div class="container bg-light rounded p-4">
        <div class="py-5 text-center">
            <h2>CheckIn form</h2>
            <!-- <p class="lead mt-4">Code Book : #WOjdsaWdnaWQ212nsoa</p> -->
        </div>

        <div class="row">
            <div class="col-md-10 order-md-1 mx-auto">
                <h4 class="mb-3">Tanggal Booking</h4>
                <form class="needs-validation was-validated" novalidate="">
                    <div class="row">
                        <div class="col-md-3 mr-1">
                            <!-- <label for="TCI">Tanggal Check in</label> -->
                            <!-- <input type="date" class="form-control" id="TCI" placeholder="dd/mm/yyyy" min="<?php echo date("d/m/Y"); ?>"> -->
                            <label for="TCO"><small>Tanggal Check In</small></label>
                            <select class="form-control TCI TB" id="TCITanggal">
                                <?php

                                    for($t = 1; $t <= 31; $t++){

                                        if($t == date("j")){

                                            $pilih = ' selected="select"';
    
                                        }else{ 
                                            $pilih = "";
    
                                        }

                                        if($t <= 9){

                                            echo '<option value="0'.$t.'"'.$pilih.'>0'.$t.'</option>';

                                        }else{

                                            echo '<option value="'.$t.'"'.$pilih.'>'.$t.'</option>';

                                        }

                                    }

                                ?>
                            </select>
                         </div>
                         <div class="col-md-3 mr-1">
                            <label for="TCO"><small>Bulan Check In</small></label>
                            <select class="form-control TCI TB" id="TCIBulan">
                                <?php

                                    for($b = 1; $b <= 12; $b++){

                                        if($b == date("n")){

                                            $pilih = ' selected="select"';

                                        }else{

                                            $pilih = "";

                                        }

                                        if($b <= 9){

                                            echo '<option value="0'.$b.'"'.$pilih.'>0'.$b.'</option>';

                                        }else{

                                            echo '<option value="'.$b.'"'.$pilih.'>'.$b.'</option>';

                                        }

                                    }

                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 mr-1">
                            <label for="TCO"><small>Tahun Check In</small></label>
                            <select class="form-control TCI TB" id="TCITahun">
                                <?php

                                    for($t = date("Y"); $t <= date("Y", strtotime("+1 year today")); $t++){

                                        if($t == date("Y")){

                                            $pilih = ' selected="select"';

                                        }else{

                                            $pilih = "";

                                        }

                                        if($t <= 9){

                                            echo '<option value="0'.$t.'"'.$pilih.'>0'.$t.'</option>';

                                        }else{

                                            echo '<option value="'.$t.'"'.$pilih.'>'.$t.'</option>';

                                        }

                                    }

                                ?>
                            </select>
                        </div>
                        <!-- <div class="col-md-6 mb-3">
                            <label for="TCO">Tanggal Check Out</label>
                            <input type="date" class="form-control" id="TCO" placeholder="dd/mm/yyyy" max="<?php echo date("d/m/Y", strtotime("+1 day today")); ?>">
                            <div class="invalid-feedback">
                                Valid last date is required.
                            </div>
                        </div> -->
                        <div class="col-md-3 mr-1">
                            <label for="TCO"><small>Tanggal Check Out</small></label>
                            <select class="form-control TCO TB" id="TCOTanggal">
                            <?php

                                for($t = 1; $t <= 31; $t++){

                                    if($t == date("j", strtotime("+1 day today"))){

                                        
                                        $pilih = ' selected="select"';

                                    }else{

                                        $pilih = "";

                                    }

                                    if($t <= 9){

                                        echo '<option value="0'.$t.'"'.$pilih.'>0'.$t.'</option>';

                                    }else{

                                        echo '<option value="'.$t.'"'.$pilih.'>'.$t.'</option>';

                                    }

                                }

                            ?>
                            </select>
                        </div>
                        <div class="col-md-3 mr-1">
                        <label for="TCO"><small>Bulan Check Out</small></label>
                            <select class="form-control TCO TB" id="TCOBulan">
                                <?php

                                    for($b = 1; $b <= 12; $b++){

                                        if($b == date('n', strtotime("+1 day today"))){

                                            $pilih = ' selected="select"';

                                        }else{

                                            $pilih = "";

                                        }

                                        if($b <= 9){

                                            echo '<option value="0'.$b.'"'.$pilih.'>0'.$b.'</option>';

                                        }else{

                                            echo '<option value="'.$b.'"'.$pilih.'>'.$b.'</option>';

                                        }

                                        echo date('n', strtotime("+1 day today"));  
                                    }

                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 mr-1">
                            <label for="TCO"><small>Tahun Check Out</small></label>
                            <select class="form-control TCO TB" id="TCOTahun">
                                <?php

                                    for($t = date("Y"); $t <= date("Y", strtotime("+1 year today")); $t++){

                                        if($t == date("Y", strtotime("+1 day today"))){

                                            $pilih = ' selected="select"';

                                        }else{

                                            $pilih = "";

                                        }

                                        if($t <= 9){

                                            echo '<option value="0'.$t.'"'.$pilih.'>0'.$t.'</option>';

                                        }else{

                                            echo '<option value="'.$t.'"'.$pilih.'>'.$t.'</option>';

                                        }

                                    }

                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Duration</label>
                        <div class="input-group">
                            <i class="fa fa-clock-o fa-lg mr-2"></i>
                            <span id="durasiBooking"></span>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="username">Max Guest</label>
                        <div class="input-group">
                            <i class="fa fa-user fa-lg mr-2"></i>
                            <span>6 People</span>
                        </div>
                    </div>

                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-3">
                        <label for="username">Rental Costs</label>
                        <h2 id="totalHarga"></h2>
                    </div>

                    <hr class="mb-5">
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="bProses">Bayar Dan Check In</button>
                </form>
            </div>
        </div>
        <footer class="my-4 col-md-10 mx-auto px-0 text-muted text-center text-small">
            <span class="d-block text-center mb-4 text-muted"> or </span>

            <label class="lead mb-3" id="aa">Meet in Person</label>
            
            <div class="card card-body">
                <p>
                    Some contact +62 999 9999 9999
                </p>
                <p>
                    some location weeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeew
                </p>
            </div>

        </footer>
    </div> 
            <div class="rounded bg-white mt-3 mb-3 p-3">
                <h4>LOCATION</h4>
                <hr/>
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $namaVilla.",".$lokasivilla; ?>&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        <style>
                            .mapouter{
                                position:relative;
                                text-align:right;
                                height:500px;
                                width:100%;
                            }
                            .gmap_canvas {
                                overflow:hidden;
                                background:none!important;
                                height:100%;
                                width:100%;
                            }
                        </style>
                    </div>
                </div>
            </div>
            <div class="rounded bg-white mt-3 p-3">
                <h4>REVIEW</h4>
                <hr/>
                <div class="border rounded" >
                    <div class="card-header bg-white">
                        User Name
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star-half text-warning"></i>
                        </p>
                        <p>
                            some text some text some text some text some text some text
                            some text some text some text some text some text some text
                            some text some text some text some text some text some text 
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script language="javascript">

            var TCI         = [];
            var TCO         = [];
            var orderData   = {
                
                        "idUnikVilla"   : "<?php echo $idUnikVilla; ?>",
                        "TCI"           : TCI,
                        "TCO"           : TCO 
                };


            function durasiBooking(){

                for(var bkd = 0; bkd < document.getElementsByClassName("TB").length; bkd++){

                    if(document.getElementsByClassName("TB")[bkd].className === "form-control TCI TB"){

                        if(Object.keys(TCI).length >= 3){

                            TCI = [];

                        }

                        TCI.push(document.getElementById(document.getElementsByClassName("TB")[bkd].id).value);
                    
                    }else if(document.getElementsByClassName("TB")[bkd].className === "form-control TCO TB"){

                        if(Object.keys(TCO).length >= 3){

                            TCO = [];

                        }

                        TCO.push(document.getElementById(document.getElementsByClassName("TB")[bkd].id).value);

                    }

                }

            }

            function totalHargaDurasi(){

                var waktuTCI        = new Date(TCI[1] + "/" + TCI[0] + "/" + TCI[2]);
                var waktuTCO        = new Date(TCO[1] + "/" + TCO[0] + "/" + TCO[2]);

                var perbedaanWaktu  = waktuTCO.getTime() - waktuTCI.getTime();
        
                if(waktuTCO < waktuTCI){

                    alert("Tanggal Check out tidak dapat lebih kecil dari tanggal check in !");

                }else if(waktuTCI < new Date("<?php echo date("m/d/Y"); ?>").getTime()){

                    alert("Tanggal Check In tidak dapat kurang dari hari ini");

                }else{

                    dBo         = perbedaanWaktu/(1000 * 60 * 60 * 24);
                    totalHarga  = <?php echo $haragaVilla - $disc; ?> * dBo;

                    document.getElementById("totalHarga").innerHTML = "Rp. " + totalHarga.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
                    return document.getElementById("durasiBooking").innerHTML = dBo + " Hari";

                }

            }


            document.onchange = function(e){

                var id  = e.target.id;
                var val = e.target.value;

                if(id === "TCITahun" || id === "TCOTahun"){
                   
                    if(val <  <?php echo date("Y"); ?> || val > <?php echo date("Y", strtotime("+1 year today")) ?>){

                        alert("Tahun tidak valid !");
                        window.location.reload(true);
                        
                    }else{

                        if(id === "TCITahun"){

                            TCI[2] = val;

                        }else if(id === "TCOTahun"){

                            TCO[2] = val;
                            
                        }

                    }

                    totalHargaDurasi();
                }else if(id === "TCITanggal" || id === "TCOTanggal"){
                   
                   if(val <  1 || val > 31){

                       alert("Tanggal tidak Valid !");
                       window.location.reload(true);
                       
                   }else{

                        if(id === "TCITanggal"){

                            TCI[0] = val;

                        }else if(id === "TCOTanggal"){

                            TCO[0] = val;

                        }

                    }

                    totalHargaDurasi();
               }else if(id === "TCIBulan" || id === "TCOBulan"){
                   
                   if(val <  1 || val > 12){

                       alert("bulan tidak Valid !");
                       window.location.reload(true);
                       
                   }else{

                        if(id === "TCIBulan"){

                            TCI[1] = val;

                        }else if(id === "TCOBulan"){

                            TCO[1] = val;
                            
                        }
                  }

                  totalHargaDurasi();
               }
               
            }
            
            durasiBooking();
            totalHargaDurasi();
                                                            
        </script>
        <script src="Settings/js/main.js"></script>
        <script src="Settings/js/bookingSystem.js"></script>
    </body>
</html>
