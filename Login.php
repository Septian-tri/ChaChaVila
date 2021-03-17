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
                        <form action="#" method="post">
                            <div class="form-group first">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username">
                                <div id="ErrorMessage"></div>
                            </div>
                            <div class="form-group last mb-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password">
                                <div id="ErrorMessage"></div>
                            </div>
                            <div class="d-flex mb-5 align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                </div>

                                    <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto"><a href="Forget_password.php" class="forgot-pass">Forgot Password</a></span>
                            </div>
                            <input type="submit" value="Log In" class="btn btn-pill text-white btn-block btn-primary">
                            <span class="d-block text-center my-4 text-muted"> or log in with</span>
                            <div class="text-center">
                                <a href="" class="btn btn-block text-white" style="background-color:#1DA1F2;"> <i class="fa fa-twitter"></i>   Login via Twitter</a>
                                <a href="" class="btn btn-block text-white" style="background-color:#4267B2;"> <i class="fa fa-facebook-f"></i>   Login via facebook</a>
                                <a href="" class="btn btn-block btn-danger "> <i class="fa fa-google"></i>   Login via Google</a>
                                <br>    
                                <a href="Register.php">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


</body>

</html>