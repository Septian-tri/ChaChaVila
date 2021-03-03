<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <style>
            .btn-group img{
                width : 100%;
            }

            /* Styles the thumbnail */

            a.lightbox img {
            height: 100%;
            border: 3px solid white;
            box-shadow: 0px 0px 8px rgba(0,0,0,.3);
            
            }

            /* Styles the lightbox, removes it from sight and adds the fade-in transition */

            .lightbox-target {
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
            }

            /* Styles the lightbox image, centers it vertically and horizontally, adds the zoom-in transition and makes it responsive using a combination of margin and absolute positioning */

            .lightbox-target img {
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
            }

            /* Styles the close link, adds the slide down transition */

            a.lightbox-close {
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
            }

            /* Provides part of the "X" to eliminate an image from the close link */

            a.lightbox-close:before {
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
            }

            /* Provides part of the "X" to eliminate an image from the close link */

            a.lightbox-close:after {
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
            }

            /* Uses the :target pseudo-class to perform the animations upon clicking the .lightbox-target anchor */

            .lightbox-target:target {
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
            }
        </style>

    </head>
    <body id="bg">

        <?php include('Navbar.php'); ?>

        <div class="container">
            <a class="lightbox" href="s">
                <i class="fa fa-arrow-left fa-3x text-white mb-3" aria-hidden="true"></i>
            </a>
            <div class="btn-group">
                <a class="lightbox" href="#1">
                    <img src="http://placehold.it/700x400"/>
                </a> 
                <a class="lightbox" href="#2">
                    <img src="http://placehold.it/400x400"/>
                </a> 
            </div>
            <div class="btn-group">
                <a class="lightbox" href="#3">
                    <img src="http://placehold.it/700x400"/>
                </a> 
                <a class="lightbox" href="#4">
                    <img src="http://placehold.it/400x400"/>
                </a>
                <a class="lightbox" href="#5">
                    <img src="http://placehold.it/400x400"/>
                </a>
            </div>

            <div class="rounded-bottom bg-white p-3">
                <a href="Foto_villa.php" class="float-right btn btn-light text-primary py-0"> <small> Lihat Semua Foto </small></a>

                <h2 class="mt-4">Villa Name</h2>
                <hr/>
                <p>
                    Location Location Location Location Location Location Location
                    Location Location Location Location Location Location Location
                    Location Location Location Location Location Location Location 
                </p>
                <i class="fa fa-users mr-1 mb-3"></i> 6 Tamu
                <p class="mb-2 text-muted">
                    <s>Rp 2.000.000</s>
                </p>
                <h4 class="">Rp 1.000.000<small class="e mb-2 text-muted"> / Night</small></h4>
                <a href="#Features" class="btn btn-primary mt-3">Check In</a>
            </div>
        </div>

        
        <!-- modal -->
        <div class="lightbox-target" id="1">
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
        </div>
        <!-- modal -->

        <div class="container">
            <div class="rounded bg-white mt-3 p-3">
                <h4>REVIEW</h4>
                <hr/>
                <div class="border rounded" >
                    <div class="card-header bg-white">
                        User Name
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star-half text-warning"></i>
                        </p>
                        <p>
                            some text some text some text some text some text some text
                            some text some text some text some text some text some text
                            some text some text some text some text some text some text 
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded bg-white mt-3 p-3">
                <h4>FASILTAS</h4>
                <hr/>
                <p>
                    some text some text some text some text some text some text
                    some text some text some text some text some text some text
                    some text some text some text some text some text some text 
                </p>

                
            </div>

            <div class="rounded bg-white mt-3 mb-3 p-3">
                <h4>LOCATION</h4>
                <hr/>

                <!--embed maps but i don't know how to ake it responsives -->

                <!--<div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=bogor&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                        </iframe>
                        <a href="https://yt2.org/youtube-to-mp3-ALeKk00qEW0sxByTDSpzaRvl8WxdMAeMytQ1611842368056QMMlSYKLwAsWUsAfLipqwCA2ahUKEwiikKDe5L7uAhVFCuwKHUuFBoYQ8tMDegUAQCSAQCYAQCqAQdnd3Mtd2l6">
                        </a>
                        <br>
                        <style>
                            .mapouter{
                                position:relative;
                                text-align:right;
                                height:500px;
                                width:6000px;
                            }
                        </style>
                        <style>
                            .gmap_canvas {
                                overflow:hidden;
                                background:none!important;
                                height:500px;
                                width:600px;
                            }
                        </style>
                    </div>
                </div>-->

            </div>
        </div>
    </body>
</html>
