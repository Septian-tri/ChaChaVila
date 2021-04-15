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

    <link rel="stylesheet" href="settings/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="Settings/css/bootstrap.min.css">
    <script src="Settings/js/jquery-3.2.1.slim.min.js"></script>
    <script src="Settings/js/main.js"></script>
    <script src="Settings/js/bootstrap.min.js"></script>

    <style>
        #bg {
            background: url("Settings/img/bg.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

</head>

<body id="bg">
    <!-- untuk login -->

    <!-- <div class="col-md-4 mx-auto" style="top:120px;">
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
    </div> -->

    <!-- untuk register -->
    <div class="col-md-6 mx-auto" style="top:20px;">
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
</body>

</html>