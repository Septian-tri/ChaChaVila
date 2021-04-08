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
                            <h3>Reset Password</h3>
                            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
                        </div>
                        <form action="#" method="post" id="reset-password-box">
                            <div class ="reset-password-box">
                                <div class="form-group first">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email">
                                </div>
                                <div class="form-group first">
                                    <label for="phonenumber">Nomor Handphone</label>
                                    <input type="text" class="form-control" id="phonenumber">
                                </div>
                            </div>
                            <small class="text-secondary">
                                Token hanya berlaku 5 menit
                            </small>
                            <div class="my-2">
                                <button type="button" class="btn btn-primary btn-block" id="resetbtn">RESET PASSWORD</a>
                            </div>
                            <div>
                                <p class="text-center m-4">
                                    we will notif you via email to confirm reset password
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="Settings/js/main.js"></script>
    <script src="Settings/js/resetPasswordSystem.js"></script>
</body>

</html>