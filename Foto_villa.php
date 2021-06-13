<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Foto Fotot</title>
    <link rel="stylesheet" href="/Settings/css/bootstrap.min.css">
    <link rel="stylesheet" href="/settings/font-awesome/css/font-awesome.min.css">        
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <script src="/Settings/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

            .test {
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

        div.gallery {
            margin: 5px;
            border: 1px solid #ccc;
            float: left;
            width: 180px;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

        div.desc {
            padding: 15px;
            text-align: center;
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
        <div class="test">
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
    <script src="Settings/js/main.js"></script>
</body>

</html>