<?php

    include "../Settings/ProsesSystem/mainsystem.php";
    include "../Settings/ConfigDB/index.php";

    session_name("_lgn");
    session_start();

if(cekSession() === false){

    session_destroy();
    header("location:index.php");
    return false;

}else{

    if(!preg_match('/^[a-zA-Z0-9\.\*\_\-\?]{135}$/', $_SESSION['TokenSementara'])){

        session_destroy();
        header("location:index.php");
        return false;

    }else{

        $queryCekDataSession = mysqli_query($koneksi, "SELECT * FROM temptokenmasuk WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and token = BINARY('".md5(explode('?', $_SESSION['TokenSementara'])[0])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

        if(!$queryCekDataSession){

            session_destroy();
            header("location:index.php");
            return false;

        }else{

            if(mysqli_num_rows($queryCekDataSession) !== 1){

                session_destroy();
                header("location:index.php");
                return false;

            }else{

                $queryCekDataAdmin = mysqli_query($koneksi, "SELECT * FROM admindata WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

                if(!$queryCekDataAdmin){
        
                    session_destroy();
                    header("location:index.php");
                    return false;
        
                }else{
        
                    if(mysqli_num_rows($queryCekDataAdmin) !== 1){
        
                        session_destroy();
                        header("location:index.php");
                        return false;
        
                    }else{
        
                       $dataAdmin       = mysqli_fetch_array($queryCekDataAdmin);
                       $namaPengguna    = base64_decode($dataAdmin['namapengguna']);
                       $namaPanggilan   = $dataAdmin['namapanggilan'];
        
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
    <title>Hai <?php echo $namaPanggilan; ?> Selamat datang di menu Admin</title>
</head>
<body id="Bg">

</body>
</html>