<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
    </head>
    <body id="bg">
    
        <?php include('Navbar.php'); ?>

        <div class="container">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="mb-4">
                                <h3>Register to 
                                    <strong>
                                        Chacha
                                        <text class="text-success">Villa</text>
                                    </strong>
                                </h3>
                                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
                            </div>
                            <form action="#" method="post">
                                <div class="form-group first">
                                    <label for="nikktp">NIK KTP</label>
                                    <input type="text" id="nikktp" placeholder="Masukan NIK KTP" class="form-control">
                                </div>
                                <div class="form-group first">
                                    <label for="username">Nama Pengguna</label>
                                    <input type="text" class="form-control" placeholder="dadang" id="username">
                                </div>
                                <div class="form-group first">
                                    <label for="username">Email</label>
                                    <input type="text" id="email" class="form-control" id="email">
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Phone Number</label>
                                    <div class="input-group">
                                        <!-- <select class="custom-select" style="max-width: 120px;">
                                            <option selected="">+62</option>
                                            <option value="1">+69</option>
                                        </select> -->
                                        <input name="" class="form-control" placeholder="Phone number" type="text" id="phonenumber">
                                    </div>
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="repassword">
                                </div>
                                <br><hr>
                                <button type="button" value="Daftar" id="lgnBtn" class="btn btn-pill text-white btn-block btn-primary">DAFTAR SEKARANG</button>
                                <!-- <span class="d-block text-center my-4 text-muted"> or sign in with</span>
                                <div class="social-login text-center">
                                    <a href="" class="btn btn-block text-white" style="background-color:#1DA1F2;"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
                                    <a href="" class="btn btn-block text-white" style="background-color:#4267B2;"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
                                    <a href="" class="btn btn-block btn-danger "> <i class="fab fa-google"></i>   Login Google</a>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="Settings/js/main.js"></script>
        <script src="settings/js/registerSystem.js"></script>
    </body>
</html>
