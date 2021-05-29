<link rel="stylesheet" href="/settings/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="/Settings/css/bootstrap.min.css">
<script src="/Settings/js/jquery-3.2.1.slim.min.js"></script>
<script src="/Settings/js/main.js"></script>
<script src="/Settings/js/bootstrap.min.js"></script>

<style>
    .navbar{
        background: rgba(255, 255, 255, 2);
    }
    .navbar-nav {
        font-size: 1.5rem;
    }

    .navbar-brand {
        font-size: 1.8rem;
    }

    #bg {
        background: url("/Settings/img/bg.jpg") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .card-body {
        background-color: rgba(255, 255, 255, 0.7);
    }

    .sections {
        margin-top: 100px;
        margin-bottom: 80px;
    }

    .carousel-item.active,
    .carousel-item-next,
    .carousel-item-prev {
        display: block;
    }

    .notifikasi {
        width: auto;
        height: auto;
        position: fixed;
        /* top: 30px; */
        /* left: 0;
                right: 0; */
        /* background-color: #007bff;
                border: 2px solid #2687b5; */
        z-index: 2000;
        width: 100%;
        height: 10%;
        /* max-width: 70%;
                min-width: 30%; */
        text-align: center;
        /* color: white; */
        /* border-radius: 3px;
                box-shadow: #2b2b2b 0px 0px 9px 2px; */
        font-size: auto;
        display: block;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light mb-5 sticky-top">
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
            <!-- <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li> -->
        </ul>

        <ul class="nav navbar-nav mt-2 ml-auto">
            <li class="nav-item dropdown">
                <?php
                if (isset($data)) {

                    echo '
                        <a href="#" class="nav-link h5 dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            ' . $data['namaPanggilan'] . '
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item">Reports</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a href="Settings/ProsesSystem/logoutSystemUs.php"class="dropdown-item">Logout</a>
                        </div>';
                } else {

                    echo '
                        <div class"row">
                            <a href="Register.php" class="nav-link h5">
                                Daftar
                            </a>
                            <a href="Login.php" class="nav-link h5">
                                Login
                            </a>
                        </div>
                            
                            ';
                }
                ?>


            </li>
        </ul>
    </div>
</nav>