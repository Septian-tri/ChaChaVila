<?php

//rubah di sini untuk mengatur segala aktivitas yang menyangkut dengan database
$namaServer         = "127.0.0.1";
$userNameDatabese   = "root";
$passwordDataBase   = ""; 
$namaDataBase       = "chachavilla";


//jika terdapat parameter pada alamat URL maka akan di alihkan ke halaman beranda
if(!preg_match('/^[\s]*$/', $_SERVER['QUERY_STRING'])){

    die("JANGAN DI MASUKAN YANG ENGGAK2");
    return false;

}else{


    //menyambungkan ke database jika sukses akan blank putih dan jika terjadi gegalan koneksi akan menampilkan informasi kesalahan koneksi
    $koneksi = mysqli_connect($namaServer, $userNameDatabese, $passwordDataBase, $namaDataBase);

    if(!$koneksi){

        echo "gagal melakukan koneksi ".mysqli_error();
        exit;

    }
}
?>