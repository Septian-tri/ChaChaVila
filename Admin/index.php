<?php 

    include "../Settings/ProsesSystem/mainsystem.php";
    include "../Settings/ConfigDB/index.php";
    
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chacha Villa's</title>
</head>
<body id="Bg">
<?php include "../Navbar.php"; ?>
<?php
if(cekDataMasterAdmin($koneksi) === true){

    //from login admin di gunakan ketika di database sudag =h terdapat  nama admin dan email admin yang memeilki type akun master admin
    //silhakan percantik..
    echo '
        <input type="text" placeholder="email" id="email"></br>
        <input type="password" placeholder="password" id="password"></br>
        <button type="button" id="lgnBtn">LOGIN ADMIN</button>
    ';

}else if(cekDataMasterAdmin($koneksi) === false){

    echo "<script>
            
            var notificationMode = \"Tampilkan\";
            messageNotification('Pesan ini di tampilkan karna sistem kamu belum memiliki akun Master admin. Silahkan Daftar Dibawah !', 'Tampilkan');
         
         </script>";

    //from dafatar admin di gunakan ketika di database tidak di temukan nama admin dan email admin yang memeilki type akun master admin
    //silhakan percantik..   
    echo '
        <input type="text" placeholder="Nomor Nik KTP" id="nikktp"></br>
        <input type="text" placeholder="Nama" id="username"></br>
        <input type="text" placeholder="email" id="email"></br>
        <input type="text" placeholder="nomor handphone" id="phonenumber"></br>
        <input type="password" placeholder="password" id="password"></br>
        <input type="password" placeholder="repassword" id="repassword"></br>
        <button type="button" id="regAbtn">DAFTAR ADMIN</button>
    ';

}else{

    echo cekDataMasterAdmin($koneksi);

}
?>
<script src="../Settings/js/main.js"></script>
<?php 

if(cekDataMasterAdmin($koneksi) === false){

    echo "<script src=\"../Settings/js/registerSystemAdmin.js\"></script>";

}else{

    echo "<script src=\"../Settings/js/loginSystem.js\"></script>";

}

?>
</body>
</html>