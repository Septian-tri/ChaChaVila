<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="settings/font-awesome/css/font-awesome.min.css">        
        <link rel="stylesheet" href="Settings/css/bootstrap.min.css">
        <script src="Settings/js/jquery-3.2.1.slim.min.js"></script>
        <script src="Settings/js/popper.min.1.12.9.js"></script>
        <script src="Settings/js/bootstrap.min.js"></script>

        <style>
            .navbar-nav {
                font-size: 1.5rem;
            }
            .navbar-brand {
                font-size: 1.8rem;
            }
            
            #bg { 
                background: url("Settings/img/bg.jpg") no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            .card-body{
                background-color: rgba(255,255,255,0.7);
            }

            .sections{
                margin-top:100px;
                margin-bottom:80px;
            }
            .carousel-item.active,
            .carousel-item-next,
            .carousel-item-prev {
                display: block;
            }
        </style>
        
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent mb-5">
            <a class="navbar-brand" href="/">
                <i class="fa fa-tree text-success"></i>
                Chacha<text class="text-success">Villa</text>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="List_villa.php">List Villa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
                
                <ul class="nav navbar-nav mt-2 ml-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link h5 dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            username
                        </a>
                        <!-- NOTE use this when user already login -->
                        <!-- isi nya bisa di ganti sesuai nani -->
                        <!-- <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item">Reports</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a href="#"class="dropdown-item">Logout</a>
                        </div> -->

                        <!-- NOTE use this when not login -->
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="Login.php" class="dropdown-item">login</a>
                            <a href="Register.php" class="dropdown-item">register</a>
                        </div>
                    </li>
                </ul>

            </div>
        </nav>
    </body>
</html>
