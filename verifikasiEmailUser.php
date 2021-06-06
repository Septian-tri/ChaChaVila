<?php
if (!preg_match('/^[\s]*$/', $_SERVER['QUERY_STRING'])) {

    die("JANGAN DI MASUKAN YANG ENGGAK2");
    return false;
} else {

    include "Settings/ProsesSystem/mainsystem.php";
    include "Settings/ConfigDB/index.php";

    session_name("_lgnUs");
    session_start();
    session_regenerate_id(true);

    if (!preg_match('/^[a-zA-Z0-9\.\*\_\-\?]{135}$/', $_SESSION['TokenSementara'])) {

        session_destroy();
        header("location:/");
    } else {

        $queryCekDataSession = mysqli_query($koneksi, "SELECT email, token, idrandom FROM temptokenmasuk WHERE idrandom = BINARY('" . base64_decode($_SESSION['IR']) . "') and token = BINARY('" . md5(explode('?', $_SESSION['TokenSementara'])[0]) . "') and email = BINARY('" . base64_decode($_SESSION['EM']) . "')");

        if (!$queryCekDataSession) {

            session_destroy();
            header("location:/");
        } else {

            if (mysqli_num_rows($queryCekDataSession) !== 1) {

                session_destroy();
                echo "TERJADI KESALAHAN PADA AKUN KAMU, SILIHKAN HUBUNGI CS";
                return false;
            } else {

                $queryCekDataUser = mysqli_query($koneksi, "SELECT idrandom, email, namapengguna, namapanggilan, kodeverifikasi FROM userdata WHERE idrandom = BINARY('" . base64_decode($_SESSION['IR']) . "') and email = BINARY('" . base64_decode($_SESSION['EM']) . "')");

                if (!$queryCekDataUser) {

                    session_destroy();
                    header("location:/");
                } else {

                    if (mysqli_num_rows($queryCekDataUser) !== 1) {

                        session_destroy();
                        header("location:/");
                        return false;
                    } else {

                        if (cekValidasiEmail($koneksi, 'userdata') === true) {

                            header("location:/");
                            return false;
                        } else {


                            $dataUser       = mysqli_fetch_array($queryCekDataUser);
                            $namaPengguna    = base64_decode($dataUser['namapengguna']);
                            $namaPanggilan   = $dataUser['namapanggilan'];

                            if (isset($_POST['verBtn'])) {

                                if (isset($_POST['kodeVerifikasi'])) {

                                    if (preg_match('/^\s*$/', $_POST['kodeVerifikasi'])) {

                                        $pesan = "Kode verifikasi Masih Kosong";
                                    } else {

                                        if (strlen($_POST['kodeVerifikasi']) !== strlen(base64_decode($_SESSION['IR']))) {

                                            $pesan = "Kode verifikasi tidak valid";
                                        } else {

                                            if (!preg_match('/^[a-zA-Z0-9]{' . strlen(base64_decode($_SESSION['IR'])) . '}$/', $_POST['kodeVerifikasi'])) {

                                                $pesan = "Kode verifikasi tidak valid";
                                            } else {


                                                $Garem             = "*|_*_|* Semoga Semua Yang Di Kerja Kan Menghasilkan Kesuksesan...Aamiin *|_*_|*";
                                                $kodeVerifikasi    = md5($_POST['kodeVerifikasi'] . " " . $Garem);
                                                $kodeVerifikasiEm  = explode(".", $dataUser['kodeverifikasi'])[1];

                                                if ($kodeVerifikasi !== $kodeVerifikasiEm) {

                                                    $pesan = "Kode verifikasi tidak sesuai";
                                                } else {

                                                    $update = mysqli_query($koneksi, "UPDATE userdata SET kodeverifikasi = 'Terverifikasi." . $kodeVerifikasi . "' where idrandom = BINARY('" . base64_decode($_SESSION['IR']) . "') and email = BINARY('" . base64_decode($_SESSION['EM']) . "') ");

                                                    if (!$update) {

                                                        $pesan = "Gagal melakukan verifikasi " . mysqli_error($koneksi);
                                                    } else {

                                                        header("location:/");
                                                        return false;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
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
    <title>Hai <?php echo $namaPengguna; ?> Selamat datang di menu Verfikasi Email</title>

    <link rel="stylesheet" href="/settings/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Settings/css/bootstrap.min.css">
    <script src="/Settings/js/jquery-3.2.1.slim.min.js"></script>
    <script src="/Settings/js/main.js"></script>
    <script src="/Settings/js/bootstrap.min.js"></script>

    <style>
        #bg {
            background: url("/Settings/img/bg.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        html,
        body {
            height: 100%;
        }

        #outer {
            min-height: 100%;
        }
    </style>

</head>

<body id="bg">
    <div id="outer" style="background: rgba(0, 0, 0, 0.3); ">
        <div class="container pt-5">
            <div class="jumbotron bg-white">
                <h1>Hai <?php echo $namaPanggilan; ?></h1>
                <p class="lead">Mengapa Kamu Di Arah Kesini ? Kami hanya ingin memastikan bawha email yang kamu gunakan untuk mendaftar adalah email yang bersifat pribadi dan bukan milik orang lain. silahkan masukan kode verfikasi yang kami kirim melalui email, Terimakasih</p>
                <p>
                    <?php

                    //Tampilkan Pesan disini
                    if (isset($pesan)) {

                        echo $pesan;
                    }

                    ?>
                </p>
                <form name="verfikasiEmail" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="text" class="form-control" placeholder="Kode Verifikasi" id="kodeverifikasiemail" maxlength="<?php echo strlen(base64_decode($_SESSION['IR'])); ?>" name="kodeVerifikasi" value="">
                    <br>
                    <button type="submit" class="btn btn-lg btn-primary text-white" id="verBtn" name="verBtn">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>