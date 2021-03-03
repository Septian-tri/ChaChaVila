<?php

//hanya dapat mengeset cokie situs jika sambungan menggunakan https
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
session_set_cookie_params(['samesite' => 'none']); 


//rubah di sini untuk mengatur segala aktivitas yang menyangkut dengan database
$namaServer         = "localhost";
$userNameDatabese   = "root";
$passwordDataBase   = ""; 
$namaDataBase       = "chachavilla";


//jika terdapat parameter pada alamat URL maka akan di alihkan ke halaman beranda
if(count($_GET) !== 0){

    header("location:../../");
    exit;

}else{


    //menyambungkan ke database jika sukses akan blank putih dan jika terjadi gegalan koneksi akan menampilkan informasi kesalahan koneksi
    $koneksi = mysqli_connect($namaServer, $userNameDatabese, $passwordDataBase, $namaDataBase);

    if(!$koneksi){

        echo "gagal melakukan koneksi ".mysqli_error();
        exit;

    }
}
?>