<?php
if(!preg_match('/^[\s]*$/', $_SERVER['QUERY_STRING'])){

    die("JANGAN DI MASUKAN YANG ENGGAK2");
    return false;

}else{

        $urlHalaman     = $_SERVER['REQUEST_URI'];
        $hostHalaman    = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/";
        $explodeUrl     = explode("/", $urlHalaman);
        $hitungHalaman  = count($explodeUrl)-1;
        $urlKosong      = ""; 

        for($i = 1; $i < $hitungHalaman; $i++){

            $urlKosong.="../";

        }

        if(!(include $urlKosong."Settings/ProsesSystem/mainsystem.php")){

            return false;

        }else{

            if(!(include $urlKosong."Settings/ConfigDB/index.php")){

                return false;

            }else{
            
                session_name("_lgn");
                session_start();

                if(cekSession() === false){

                    session_destroy();
                    header("location:index.php");
                    return false;

                }else{

                    if(!preg_match('/^[a-zA-Z0-9\.\*\_\-\?]{135}$/', $_SESSION['TokenSementara'])){

                        session_destroy();
                        header("location:index.php");
                        return false;

                    }else{

                        $queryCekDataSession = mysqli_query($koneksi, "SELECT * FROM temptokenmasuk WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and token = BINARY('".md5(explode('?', $_SESSION['TokenSementara'])[0])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

                        if(!$queryCekDataSession){

                            session_destroy();
                            header("location:index.php");
                            return false;

                        }else{

                            if(mysqli_num_rows($queryCekDataSession) !== 1){

                                session_destroy();
                                header("location:index.php");
                                return false;

                            }else{

                                $queryCekDataAdmin = mysqli_query($koneksi, "SELECT * FROM admindata WHERE idrandom = BINARY('".base64_decode($_SESSION['IR'])."') and email = BINARY('".base64_decode($_SESSION['EM'])."')");

                                if(!$queryCekDataAdmin){
                        
                                    session_destroy();
                                    header("location:index.php");
                                    return false;
                        
                                }else{

                                    if(cekValidasiEmail($koneksi, 'admindata') === false){

                                        header("location:".$urlKosong."admin/verifikasiEmailAdmin.php");
                                
                                    }else{

                                        if(mysqli_num_rows($queryCekDataAdmin) !== 1){
                        
                                            session_destroy();
                                            header("location:index.php");
                                            return false;
                            
                                        }else{
                            
                                        $dataAdmin       = mysqli_fetch_array($queryCekDataAdmin);
                                        $namaPengguna    = base64_decode($dataAdmin['namapengguna']);
                                        $namaPanggilan   = $dataAdmin['namapanggilan'];
                                        $typeAkun        = $dataAdmin['typeakun'];
                            
                                        }
                                    }        
                                }
                            }
                        }
                    }
                }
            }
        }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="lorem ipsum">
    <meta name="keywords" content="lorem ipsum">
    <meta name="author" content="Uup">
    
    <title>Hai <?php echo $namaPanggilan; ?> Selamat datang di menu dashboard <?php echo str_replace("_", " ", $typeAkun); ?></title>

    <link rel="stylesheet" href="/settings/font-awesome/css/font-awesome.min.css">        
    <link rel="stylesheet" href="/Settings/css/bootstrap.min.css">
    <script src="/Settings/js/jquery-3.2.1.slim.min.js"></script>
    <script src="/Settings/js/main.js"></script>
    <script src="/Settings/js/bootstrap.min.js"></script>
    <script src="../Settings/tinymce/tinymce.min.js"></script>

    <style>
        

        body {
            font-size: 0.9rem;
        }

        .page-wrapper .sidebar-wrapper,
        .sidebar-wrapper .sidebar-brand>a,
        .sidebar-wrapper .sidebar-dropdown>a:after,
        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before,
        .sidebar-wrapper ul li a i,
        .page-wrapper .page-content,
        .sidebar-wrapper .sidebar-search input.search-menu,
        .sidebar-wrapper .sidebar-search .input-group-text,
        .sidebar-wrapper .sidebar-menu ul li a,
        #show-sidebar,
        #close-sidebar {
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        /*----------------page-wrapper----------------*/

        
        /*----------------toggeled sidebar----------------*/

        .page-wrapper.toggled .sidebar-wrapper {
            left: 0px;
        }

        @media screen and (min-width: 768px) {
            .page-wrapper.toggled .page-content {
                padding-left: 300px;
            }
        }

        /*----------------show sidebar button----------------*/
        #show-sidebar {
            position: fixed;
            left: 0;
            top: 10px;
            border-radius: 0 4px 4px 0px;
            width: 35px;
            transition-delay: 0.3s;
        }

        .page-wrapper.toggled #show-sidebar {
            left: -40px;
        }

        /*----------------sidebar-wrapper----------------*/

        .sidebar-wrapper {
            width: 260px;
            height: 100%;
            max-height: 100%;
            position: fixed;
            top: 0;
            left: -300px;
            z-index: 999;
        }

        .sidebar-wrapper ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-wrapper a {
            text-decoration: none;
        }

        /*----------------sidebar-content----------------*/

        /* .sidebar-content {
            max-height: calc(100% - 30px);
            height: calc(100% - 30px);
            overflow-y: auto;
            position: relative;
        }

        .sidebar-content.desktop {
            overflow-y: hidden;
        } */

        /*--------------------sidebar-brand----------------------*/

        .sidebar-wrapper .sidebar-brand {
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }

        .sidebar-wrapper .sidebar-brand>a {
            text-transform: uppercase;
            font-weight: bold;
            flex-grow: 1;
        }

        .sidebar-wrapper .sidebar-brand #close-sidebar {
            cursor: pointer;
            font-size: 20px;
        }

        /*----------------------sidebar-menu-------------------------*/

        .sidebar-wrapper .sidebar-menu {
            padding-bottom: 10px;
        }

        .sidebar-wrapper .sidebar-menu .header-menu span {
            font-weight: bold;
            font-size: 14px;
            padding: 15px 20px 5px 20px;
            display: inline-block;
        }

        .sidebar-wrapper .sidebar-menu ul li a {
            display: inline-block;
            width: 100%;
            text-decoration: none;
            position: relative;
            padding: 8px 30px 8px 20px;
        }

        .sidebar-wrapper .sidebar-menu ul li a i {
            margin-right: 10px;
            font-size: 12px;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 4px;
        }


        .sidebar-wrapper .sidebar-menu ul li a span.label,
        .sidebar-wrapper .sidebar-menu ul li a span.badge {
            float: right;
            margin-top: 8px;
            margin-left: 5px;
        }

        .sidebar-wrapper .sidebar-menu .sidebar-submenu {
            display: none;
        }

        /*--------------------------side-footer------------------------------*/

        .sidebar-footer {
            position: absolute;
            width: 100%;
            height: 6%;
            bottom: 0;
            padding-top: 10px;
            /* display: flex; */
        }
        .footer{
            color: #ffffff;
        }

        /*--------------------------page-content-----------------------------*/

        .page-wrapper .page-content {
            display: inline-block;
            width: 100%;
            padding-left: 0px;
            padding-top: 20px;
        }

        .page-wrapper .page-content>div {
            padding: 20px 40px;
        }

        .page-wrapper .page-content {
            overflow-x: hidden;
        }

        /*-----------------------------theme-------------------------------------------------*/

        .new-theme .sidebar-wrapper {
            background: #5cb85c;
        }

        .new-theme .sidebar-wrapper .sidebar-header,
        .new-theme .sidebar-wrapper .sidebar-search,
        .new-theme .sidebar-wrapper .sidebar-menu {
            border-top: 3px solid #4f9e4f;
        }

        .new-theme .sidebar-wrapper .sidebar-header .user-info .user-role,
        .new-theme .sidebar-wrapper .sidebar-header .user-info .user-status,
        .new-theme .sidebar-wrapper .sidebar-search input.search-menu,
        .new-theme .sidebar-wrapper .sidebar-search .input-group-text,
        .new-theme .sidebar-wrapper .sidebar-brand>a,
        .new-theme .sidebar-wrapper .sidebar-menu ul li a,
        .new-theme .sidebar-footer>a {
            color: #FFFFFF;
        }

        .new-theme .sidebar-wrapper .sidebar-menu ul li:hover>a,
        .new-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active>a,
        .new-theme .sidebar-wrapper .sidebar-header .user-info,
        .new-theme .sidebar-wrapper .sidebar-brand>a:hover,
        .new-theme .sidebar-footer .container>a:hover span {
            color: #1f6632;
        }

        .page-wrapper.new-theme.toggled #close-sidebar {
            color: #ffffff;
        }

        .page-wrapper.new-theme.toggled #close-sidebar:hover {
            color: #169016;
        }

        .new-theme .sidebar-wrapper ul li:hover a i,
        .new-theme .sidebar-wrapper .sidebar-dropdown .sidebar-submenu li a:hover:before,
        .new-theme .sidebar-wrapper .sidebar-search input.search-menu:focus+span,
        .new-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active a i {
            color: #169016;   
        }

        .new-theme .sidebar-wrapper .sidebar-menu ul li a i,
        .new-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown div,
        .new-theme .sidebar-wrapper .sidebar-search input.search-menu,
        .new-theme .sidebar-wrapper .sidebar-search .input-group-text {
            background: #7aeb7a;
        }

        .new-theme .sidebar-wrapper .sidebar-menu .header-menu span {
            color: #ffffff;
        }

        .new-theme .sidebar-footer {
            background: #4f9e4f;
        }

        .new-theme .sidebar-footer>a:first-child {
            border-left: none;
        }

        .new-theme .sidebar-footer>a:last-child {
            border-right: none;
        }

    </style>

    <script>
        jQuery(function ($) {

            $(".sidebar-dropdown > a").click(function () {
                $(".sidebar-submenu").slideUp(200);
                if (
                    $(this)
                        .parent()
                        .hasClass("active")
                ) {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .parent()
                        .removeClass("active");
                } else {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .next(".sidebar-submenu")
                        .slideDown(200);
                    $(this)
                        .parent()
                        .addClass("active");
                }
            });

            $("#close-sidebar").click(function () {
                $(".page-wrapper").removeClass("toggled");
            });
            $("#show-sidebar").click(function () {
                $(".page-wrapper").addClass("toggled");
            });
        });
    </script>

</head>

<body>
    <div class="page-wrapper new-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-success" href="#">
            <i class="fa fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href=""><?php echo $namaPanggilan; ?></a>
                    <div id="close-sidebar">
                        <i class="fa fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-home"></i>
                                <span>Dashboard</span>
                                <span class="badge badge-pill badge-warning">New</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Dashboard 1
                                            <span class="badge badge-pill badge-success">Pro</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Dashboard 2</a>
                                    </li>
                                    <li>
                                        <a href="#">Dashboard 3</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>E-commerce Villa</span>
                                <span class="badge badge-pill badge-danger">3</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="<?php echo $hostHalaman; ?>Admin/VillaCustomize/list_villa_admin.php">Lists villa</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $hostHalaman; ?>Admin/OrdersCustomize/order_list.php">Orders</a>
                                    </li>
                                    <li>
                                        <a href="#">Credit cart</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-th-large"></i>
                                <span>Components</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">General</a>
                                    </li>
                                    <li>
                                        <a href="#">Panels</a>
                                    </li>
                                    <li>
                                        <a href="#">Tables</a>
                                    </li>
                                    <li>
                                        <a href="#">Icons</a>
                                    </li>
                                    <li>
                                        <a href="#">Forms</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-line-chart"></i>
                                <span>Charts</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Pie chart</a>
                                    </li>
                                    <li>
                                        <a href="#">Line chart</a>
                                    </li>
                                    <li>
                                        <a href="#">Bar chart</a>
                                    </li>
                                    <li>
                                        <a href="#">Histogram</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-globe"></i>
                                <span>Maps</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Google maps</a>
                                    </li>
                                    <li>
                                        <a href="#">Open street map</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-menu">
                            <span>Extra</span>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Documentation</span>
                                <span class="badge badge-pill badge-primary">Beta</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-calendar"></i>
                                <span>Calendar</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-folder"></i>
                                <span>Examples</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
            <div class="sidebar-footer">
                <div class="container">
                    <a href="../Settings/ProsesSystem/logoutSystem.php">
                        <span class="footer h6">
                            Logout &nbsp;
                            <i class="fa fa-sign-out"></i>
                        </span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <?php

            $homePage = explode("/", $_SERVER['REQUEST_URI'])[count(explode("/", $_SERVER['REQUEST_URI']))-1];
            if($homePage === "home.php"){
                
                echo'
                <main class="page-content">
                    <div class="container-fluid">
                        <h2>Home</h2>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod optio adipisci officiis, debitis sit corrupti commodi dolor corporis molestiae! Deleniti, molestias esse! Dolor, repellendus ea architecto officia numquam voluptate voluptatibus.</p>
                            </div>
                        </div>
                    </div>
                </main>
                ';
            }
        ?>
        <!-- page-content" -->
    </div>
    <?php 
        echo '<script src="'.$urlKosong.'Settings/js/main.js"></script>';
    ?>
</body>
</html>