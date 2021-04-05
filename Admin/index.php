<?php 

    include "../Settings/ProsesSystem/mainsystem.php";
    include "../Settings/ConfigDB/index.php";

    function cekDataMasterAdmin($koneksi){

        $queryCekMasterAdmin = mysqli_query($koneksi, "SELECT * FROM admindata where typeadmin = 'MASTER_ADMIN' and emailadmin != null and namaadmin != null ");

        if(!$queryCekMasterAdmin){

            return 'Hai..Maaf, kami mengalami ke gagalan sistem '.mysqli_error($koneksi)."<br />";
    
        }else{

            if(mysqli_num_rows($queryCekMasterAdmin) <= 0){

                return false;

            }else{

                return true;

            }
        }
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chacha Villa's</title>
    <script src="../Settings/js/jquery-3.2.1.slim.min.js"></script>
</head>
<body id="Bg">

<nav></nav>

<?php

if(cekDataMasterAdmin($koneksi) === true){

    //from login admin di gunakan ketika di database sudag =h terdapat  nama admin dan email admin yang memeilki type akun master admin
    //silhakan percantik..
    echo '
        <input type="text" placeholder="Nama" id="namaadmin"></br>
        <input type="text" placeholder="email" id="emailadmin"></br>
        <input type="text" placeholder="nomor handphone" id="nomorhandphone"></br>
        <input type="password" placeholder="password" id="password"></br>
        <input type="password" placeholder="repassword" id="repassword"></br>
        <button type="button" id="daftaradmin">DAFTAR ADMIN</button>
    ';

}else if(cekDataMasterAdmin($koneksi) === false){

    //from dafatar admin di gunakan ketika di database tidak di temukan nama admin dan email admin yang memeilki type akun master admin
    //silhakan percantik..
    echo '
        <input type="text" placeholder="Nama" id="namaadmin"></br>
        <input type="text" placeholder="email" id="emailadmin"></br>
        <input type="text" placeholder="nomor handphone" id="nomorhandphone"></br>
        <input type="password" placeholder="password" id="password"></br>
        <input type="password" placeholder="repassword" id="repassword"></br>
        <button type="button" id="regAbtn">DAFTAR ADMIN</button>
    ';

}else{

    echo cekDataMasterAdmin($koneksi);

}

?>

<script src="../Settings/js/main.js"></script>
<script src="../Settings/js/registerSystemAdmin.js"></script>
</body>
</html>