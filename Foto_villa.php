<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Foto Fotot</title>
    <link rel="stylesheet" href="/Settings/css/bootstrap.min.css">
    <link rel="stylesheet" href="/settings/font-awesome/css/font-awesome.min.css">

    <!-- untuk sementara masih cdn -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <script src="/Settings/js/bootstrap.min.js"></script>
    <script src="/Settings/js/jquery-3.2.1.slim.min.js"></script>

    <!-- untuk sementara masih cdn -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>


    <style>
        body {
            background-color: #1d1d1d !important;
            font-family: "Asap", sans-serif;
            color: #989898;
            margin: 10px;
            font-size: 16px;
        }

        #demo {
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .green {
            background-color: #6fb936;
        }

        .thumb {
            margin-bottom: 30px;
        }

        .page-top {
            margin-top: 10%;
        }

        @media (max-width: 600px) {
            img.zoom {
                width: 100%;
            }
        }

        @media (min-width: 601px) {
            img.zoom {
                width: 20%;
            }

            .cener {
                padding-left: 13%;
            }
        }

        img.zoom {
            height: 200px;
            border-radius: 5px;
            object-fit: cover;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
            margin-bottom: 5px;
        }

        .transition {
            -webkit-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -o-transform: scale(1.2);
            transform: scale(1.2);
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-title {
            color: #000;
        }

        .modal-footer {
            display: none;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function() {

                $(this).addClass('transition');
            }, function() {

                $(this).removeClass('transition');
            });
        });
    </script>

</head>

<body id="bg">
    <div class="container">
        <div class="kembali lightbox">
            <i class="fa fa-arrow-left fa-3x text-white mb-3" aria-hidden="true"></i>
        </div>
        <div class="cener">

            <!-- tinggal panggil looping nya disini -->
            <!-- cara pake nya gini href dan src harus sama, sesuai dengan cara manggil img nya -->

            <!-- <a href="linknya gan harus sama" class="fancybox" rel="ligthbox">
                <img src="linknya gan harus sama" class="zoom img-fluid " alt="">
            </a> -->

            <a href="https://images.pexels.com/photos/62307/air-bubbles-diving-underwater-blow-62307.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="fancybox" rel="ligthbox">
                <img src="https://images.pexels.com/photos/62307/air-bubbles-diving-underwater-blow-62307.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="zoom img-fluid " alt="">
            </a>
            <a href="https://images.pexels.com/photos/38238/maldives-ile-beach-sun-38238.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="fancybox" rel="ligthbox">
                <img src="https://images.pexels.com/photos/38238/maldives-ile-beach-sun-38238.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="zoom img-fluid" alt="">
            </a>
            <a href="https://images.pexels.com/photos/158827/field-corn-air-frisch-158827.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                <img src="https://images.pexels.com/photos/158827/field-corn-air-frisch-158827.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="zoom img-fluid " alt="">
            </a>
            <a href="https://images.pexels.com/photos/302804/pexels-photo-302804.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                <img src="https://images.pexels.com/photos/302804/pexels-photo-302804.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="zoom img-fluid " alt="">
            </a>
            <a href="https://images.pexels.com/photos/1038914/pexels-photo-1038914.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="fancybox" rel="ligthbox">
                <img src="https://images.pexels.com/photos/1038914/pexels-photo-1038914.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="zoom img-fluid " alt="">
            </a>
            <a href="https://images.pexels.com/photos/414645/pexels-photo-414645.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="fancybox" rel="ligthbox">
                <img src="https://images.pexels.com/photos/414645/pexels-photo-414645.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="zoom img-fluid " alt="">
            </a>
            <a href="https://images.pexels.com/photos/56005/fiji-beach-sand-palm-trees-56005.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                <img src="https://images.pexels.com/photos/56005/fiji-beach-sand-palm-trees-56005.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="zoom img-fluid " alt="">
            </a>
            <a href="https://images.pexels.com/photos/1038002/pexels-photo-1038002.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                <img src="https://images.pexels.com/photos/1038002/pexels-photo-1038002.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="zoom img-fluid " alt="">
            </a>
        </div>
    </div>
</body>

    <!-- MODAL ABAL ABAL NITIP DULU -->

    <!-- modal -->
    <!-- <div class="lightbox-target" id="1">
        <img src="http://placehold.it/700x400"/>
        <a class="lightbox-close" href="#"></a>
    </div>
    <div class="lightbox-target" id="2">
        <img src="http://placehold.it/400x400"/>
        <a class="lightbox-close" href="#"></a>
    </div>
    <div class="lightbox-target" id="3">
        <img src="http://placehold.it/700x400"/>
        <a class="lightbox-close" href="#"></a>
    </div>
    <div class="lightbox-target" id="4">
        <img src="http://placehold.it/400x400"/>
        <a class="lightbox-close" href="#"></a>
    </div>
    <div class="lightbox-target" id="5">
        <img src="http://placehold.it/400x400"/>
        <a class="lightbox-close" href="#"></a>
    </div> -->
    <!-- modal -->
<style>
    /* STYLE BODONG JANGAN DULU DI HAPUS */

    /* Styles the thumbnail */

    /* a.lightbox img {
            width   : 30%;
            height  : auto;
            border  : 3px solid white;
            box-shadow: 0px 0px 8px rgba(0,0,0,.3);
            display: block;
            } */

    /* Styles the lightbox, removes it from sight and adds the fade-in transition */

    /* .lightbox-target {
            position: fixed;
            top: -100%;
            width: 100%;
            background: rgba(0,0,0,.7);
            width: 100%;
            opacity: 0;
            -webkit-transition: opacity .5s ease-in-out;
            -moz-transition: opacity .5s ease-in-out;
            -o-transition: opacity .5s ease-in-out;
            transition: opacity .5s ease-in-out;
            overflow: hidden;
            } */

    /* Styles the lightbox image, centers it vertically and horizontally, adds the zoom-in transition and makes it responsive using a combination of margin and absolute positioning */

    /* .lightbox-target img {
            margin: auto;
            position: absolute;
            top: 0;
            left:0;
            right:0;
            bottom: 0;
            max-height: 0%;
            max-width: 0%;
            border: 3px solid white;
            box-shadow: 0px 0px 8px rgba(0,0,0,.3);
            box-sizing: border-box;
            -webkit-transition: .5s ease-in-out;
            -moz-transition: .5s ease-in-out;
            -o-transition: .5s ease-in-out;
            transition: .5s ease-in-out;
            } */

    /* Styles the close link, adds the slide down transition */

    /* a.lightbox-close {
            display: block;
            width:50px;
            height:50px;
            box-sizing: border-box;
            background: white;
            color: black;
            text-decoration: none;
            position: absolute;
            top: -80px;
            right: 0;
            -webkit-transition: .5s ease-in-out;
            -moz-transition: .5s ease-in-out;
            -o-transition: .5s ease-in-out;
            transition: .5s ease-in-out;
            } */

    /* Provides part of the "X" to eliminate an image from the close link */

    /* a.lightbox-close:before {
            content: "";
            display: block;
            height: 30px;
            width: 1px;
            background: black;
            position: absolute;
            left: 26px;
            top:10px;
            -webkit-transform:rotate(45deg);
            -moz-transform:rotate(45deg);
            -o-transform:rotate(45deg);
            transform:rotate(45deg);
            } */

    /* Provides part of the "X" to eliminate an image from the close link */

    /* a.lightbox-close:after {
            content: "";
            display: block;
            height: 30px;
            width: 1px;
            background: black;
            position: absolute;
            left: 26px;
            top:10px;
            -webkit-transform:rotate(-45deg);
            -moz-transform:rotate(-45deg);
            -o-transform:rotate(-45deg);
            transform:rotate(-45deg);
            } */

    /* Uses the :target pseudo-class to perform the animations upon clicking the .lightbox-target anchor */

    /* .lightbox-target:target {
            opacity: 1;
            top: 0;
            bottom: 0;
            }

            .lightbox-target:target img {
            max-height: 100%;
            max-width: 100%;
            }

            .lightbox-target:target a.lightbox-close {
            top: 0px;
            } */
</style>

</html>