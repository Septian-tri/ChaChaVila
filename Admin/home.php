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

                    if(cekValidasiEmail($koneksi, 'admindata') === false){

                        header("location:verifikasiEmailAdmin.php");
                
                    }else{

                        if(mysqli_num_rows($queryCekDataAdmin) !== 1){
        
                            session_destroy();
                            header("location:index.php");
                            return false;
            
                        }else{
            
                           $dataAdmin       = mysqli_fetch_array($queryCekDataAdmin);
                           $namaPengguna    = base64_decode($dataAdmin['namapengguna']);
                           $namaPanggilan   = $dataAdmin['namapanggilan'];
                           $typeAkun        = $dataAdmin['typeakun'];
            
                        }
                    }        
                }
            }
        }
    }
}

?>
<!-- <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hai <?php echo $namaPanggilan; ?> Selamat datang di menu <?php echo str_replace("_", " ", $typeAkun); ?></title>
    <script src="Settings/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#deskripsi'
        });
    </script>
</head>

<body id="Bg">

Hai <b><?php echo $namaPanggilan; ?></b>, Semoga Hari mu Menyenangkan</br>
<textarea id="deskripsi"></textarea>
<script>

    console.log(tinymce.activeEditor.getContent({format : 'html'}));

</script>
<a href="../Settings/ProsesSystem/logoutSystem.php">KELUAR</a>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include('navbar_admin.php'); ?>
    <!-- format buat nambahin page / halaman baru -->
    <div class="page-wrapper new-theme toggled">
        <main class="page-content">
            <div class="container-fluid">
                <h2>home</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod optio adipisci officiis, debitis sit corrupti commodi dolor corporis molestiae! Deleniti, molestias esse! Dolor, repellendus ea architecto officia numquam voluptate voluptatibus.</p>
                    </div>
                    
                </div>
                
            </div>
        </main> 
    </div>
    
</body>
</html>