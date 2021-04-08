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
<body id="bg">

    <?php include '../Navbar.php' ; ?>

    <?php
    if(cekDataMasterAdmin($koneksi) === true){

        //from login admin di gunakan ketika di database sudag =h terdapat  nama admin dan email admin yang memeilki type akun master admin
        //silhakan percantik..
        echo '
            <div class="col-md-4 mx-auto" style="top:120px;">
                <div class="card">
                    <div class="text-center p-4 ">
                        <text class="text-secondary h1 font-weight-bold mb-0">
                            Login
                        </text>
                        <text class="text-success h1 mb-0">
                            Admin
                        </text>
                    </div>

                    <div class="card-body">
                        <input type="text" class="form-control" placeholder="Username" id="email"></br>
                        <input type="password" class="form-control" placeholder="Password" id="password"></br>
                        <button type="button" class="btn btn-primary col-md-12" id="lgnBtn">Login</button>
                    </div>
                </div>
            </div>
        ';

    }else if(cekDataMasterAdmin($koneksi) === false){

        echo "<script>
                
                var notificationMode = \"Tampilkan\";
                messageNotification('Pesan ini di tampilkan karna sistem kamu belum memiliki akun Master admin. Silahkan Daftar Dibawah !', 'Tampilkan');
            
            </script>";

        //from dafatar admin di gunakan ketika di database tidak di temukan nama admin dan email admin yang memeilki type akun master admin
        //silhakan percantik..   
        echo '
            <div class="col-md-6 mx-auto" style="top:-30px;">
                <div class="card">
                    <div class="text-center p-4 ">
                        <text class="text-secondary h1 font-weight-bold mb-0">
                            Register
                        </text>
                        <text class="text-success h1 mb-0">
                            Admin
                        </text>
                    </div>

                    <div class="card-body">
                        <input type="text" class="form-control" placeholder="Nomor Nik KTP" id="nikktp"></br>
                        <input type="text" class="form-control" placeholder="Nama" id="username"></br>
                        <input type="text" class="form-control" placeholder="email" id="email"></br>
                        <input type="text" class="form-control" placeholder="nomor handphone" id="phonenumber"></br>
                        <input type="password" class="form-control" placeholder="password" id="password"></br>
                        <input type="password" class="form-control" placeholder="repassword" id="repassword">
                        <hr class="my-4">
                        <button type="button" class="btn btn-primary col-md-12" id="regAbtn">DAFTAR ADMIN</button>
                    </div>
                </div>
            </div>
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