<?php
if(!preg_match('/^[\s]*$/', $_SERVER['QUERY_STRING'])){

    die("JANGAN DI MASUKAN YANG ENGGAK2");
    return false;

}else{

    include "Settings/ProsesSystem/MainSystem.php";
    session_name('_lgnUs');
    session_start();
    session_regenerate_id(true);

    if(cekSession() === false){
        
        session_destroy();
        
    }else{
        
        if(!preg_match('/^[a-zA-Z0-9\.\*\_\-\?]{135}$/', $_SESSION['TokenSementara'])){

            session_destroy();

        }else{

            header("location:/");
            return false;
        
        }

    }

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <style>

    </style>

</head>

<body id="bg">

    <?php include('Navbar.php'); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="mb-4">
                            <h3>Log In to
                                <strong>
                                    Chacha
                                    <text class="text-success">Villa</text>
                                </strong>
                            </h3>
                            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
                        </div>
                        <div class="form-group first flg">
                            <div class="form-group last mb-4">
                                <label for="Email">Email</label>
                                <input type="text" class="form-control" placeholder="Email" id="email"></br>
                            </div>
                            <div class="form-group last mb-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Password" id="password"></br>
                            </div>
                            <div class="d-flex mb-5 align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                </div>
                                <span class="ml-auto"><a href="Forget_password.php" class="forgot-pass">Forgot Password</a></span>
                            </div>
                            <button type="button" id="lgnBtnUs" class="btn btn-pill text-white btn-block btn-primary">LOGIN</button>
                            <!-- <span class="d-block text-center my-4 text-muted"> or log in with</span>
                            <div class="text-center">
                                <a href="" class="btn btn-block text-white" style="background-color:#1DA1F2;"> <i class="fa fa-twitter"></i>   Login via Twitter</a>
                                <a href="" class="btn btn-block text-white" style="background-color:#4267B2;"> <i class="fa fa-facebook-f"></i>   Login via facebook</a>
                                <a href="" class="btn btn-block btn-danger "> <i class="fa fa-google"></i>   Login via Google</a>
                                <br>    
                                <a href="Register.php">Register</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="Settings/js/main.js"></script>
    <script src="Settings/js/loginSystemUs.js"></script>
</body>

</html>