<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Chacha Villa's</title>
    <link rel="stylesheet" href="Settings/font-awesome/css/font-awesome.min.css">

</head>

<body id="bg">

    <?php include('Navbar.php'); ?>

    <div>
        <div class="container">
            <!-- sebelum login -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <p class="text-center h4">Anda belum login</p>
                                <hr />
                                <div class="mb-4">
                                    <h4>Log In to
                                        <strong>
                                            Chacha
                                            <text class="text-success">Villa</text>
                                        </strong>
                                    </h4>
                                    <p class="m-0">
                                        Anda akan mendapat kemudahan dalam memilih dan memesan vila dengan nyaman.
                                    </p>
                                    <p class="mb-4">
                                        Serta mempermudah dalam melakukan transaki dan pemberitahuan mengenai detail pemesanan.
                                    </p>
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
                                    <span class="d-block text-center my-4 text-muted"> or </span>
                                    <div class="text-center mb-3">
                                        <a href="Register.php">Register new Account</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- saat sudah login -->
            <!-- <div class="sections">
                <div class="col-12">
                    <div class="text-white">
                        <p class="text-uppercase h4">Introducing </p>
                        <hr />
                        <h1>CHACHA VILA PUNCAK</h1>
                        <p>
                            A website for renting villas in the area around Cisarua, where you can enjoy comfort while traveling or on vacation with cool air and beautiful hilly views
                        </p>
                    </div>
                </div>
            </div> -->

            <div class="row mx-auto sections" id="Features">
                <div class="col-lg-4 mb-3">
                    <div class="card bg-transparent mx-auto" style="width: 18rem;">
                        <div class="card-body rounded">
                            <div class=" text-center mt-5 mb-5">
                                <i class="fa fa-3x fa-bed"></i>
                                <h5 class="card-title">Fasilitas</h5>
                            </div>
                            <p class="card-text mb-5">
                                Contains a comfortable room, living room, kitchen and much more
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="card bg-transparent mx-auto" style="width: 18rem;">
                        <div class="card-body rounded">
                            <div class=" text-center mt-5 mb-5">
                                <i class="fa fa-3x fa-tree"></i>
                                <h5 class="card-title">Great View</h5>
                            </div>
                            <p class="card-text mb-5">With a variety of views that make you more relaxed while enjoying the atmosphere.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="card bg-transparent mx-auto" style="width: 18rem;">
                        <div class="card-body rounded">
                            <div class=" text-center mt-5 mb-5">
                                <i class="fa fa-3x fa-map"></i>
                                <h5 class="card-title">Location</h5>
                            </div>
                            <p class="card-text mb-5">The location of the area near Cisarua, with cool air adds to the fresh atmosphere.</p>
                        </div>
                    </div>
                </div>
                <a href="List_villa.php" class="btn btn-primary mx-auto mt-3" style="width: 200px;">Go to Villas</a>
            </div>
            <div class="container col-lg-8">
                <div id="carouselExampleControls" class="carousel slide mx-auto mb-5" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://placehold.it/500x200" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://placehold.it/700x200" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://placehold.it/400x200" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>


        </div>
    </div>



</body>

</html>