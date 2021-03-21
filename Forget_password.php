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
                        <form action="#" method="post">
                            <div class="form-group first">
                                <label for="username">Email</label>
                                <input type="text" class="form-control" id="username">
                            </div>

                            <!-- tampilkan input code saat send email terjadi dan 
                            sembunyikan input email -->

                            <!-- <div class="form-group first">
                                <label for="username">Input Code</label>
                                <input type="text" class="form-control" id="username">
                            </div> -->
                            
                            <small class="text-secondary">
                            Resend email in 15 seconds
                            </small>
                            <div class="my-2">
                                <a href="" type="submit" class="btn btn-primary btn-block">Send Email</a>
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
</body>

</html>