<?php

//rubah di sini untuk mengatur segala aktivitas yang menyangkut dengan database
$namaServer         = "127.0.0.1";
$userNameDatabese   = "root";
$passwordDataBase   = ""; 
$namaDataBase       = "chachavilla";

    //menyambungkan ke database jika sukses akan blank putih dan jika terjadi gegalan koneksi akan menampilkan informasi kesalahan koneksi
    $koneksi = mysqli_connect($namaServer, $userNameDatabese, $passwordDataBase, $namaDataBase);

    if(!$koneksi){

        echo "gagal melakukan koneksi ".mysqli_error($koneksi);
        exit;

    }
    
?>