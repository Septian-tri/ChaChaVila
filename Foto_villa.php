<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<style>
    .btn-group img {
        width: 100%;
    }

    /* Styles the thumbnail */

    a.lightbox img {
        height: 100%;
        border: 3px solid white;
        box-shadow: 0px 0px 8px rgba(0, 0, 0, .3);

    }

    /* Styles the lightbox, removes it from sight and adds the fade-in transition */

    .lightbox-target {
        position: fixed;
        top: -100%;
        width: 100%;
        background: rgba(0, 0, 0, .7);
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
        left: 0;
        right: 0;
        bottom: 0;
        max-height: 0%;
        max-width: 0%;
        border: 3px solid white;
        box-shadow: 0px 0px 8px rgba(0, 0, 0, .3);
        box-sizing: border-box;
        -webkit-transition: .5s ease-in-out;
        -moz-transition: .5s ease-in-out;
        -o-transition: .5s ease-in-out;
        transition: .5s ease-in-out;
    }

    /* Styles the close link, adds the slide down transition */

    a.lightbox-close {
        display: block;
        width: 50px;
        height: 50px;
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
        top: 10px;
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
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
        top: 10px;
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
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

<body id="bg">
    <?php include('Navbar.php'); ?>

    <div class="container p-0">
        <a href="">
            <i class="fa fa-arrow-left fa-3x text-white mb-3" aria-hidden="true"></i>
        </a>
    </div>

    <div class="container p-5 bg-white rounded">
        <div class="border-bottom pb-3 mb-4">
            <h3 class="mb-4">Bangunan Luar / Luar Villa</h3>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
        </div>
        <div class="border-bottom pb-3 mb-4">
            <h3 class="mb-4">Foto Ruangan Villa, E.g Kamar Mandi, kamar tidur Dll</h3>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
        </div>
        <div class="border-bottom pb-3 mb-4">
            <h3 class="mb-4">Fasilitas Tambahan</h3>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
        </div>
        <div class="border-bottom pb-3 mb-4">
            <h3 class="mb-4">Area Rekreasi, E.g Taman Bermain, Taman Bungan, kolam renang dll</h3>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
            <a class="lightbox" href="#1">
                <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image" style="width: 300;height:200;" />
            </a>
        </div>
    </div>
    
    <div class="lightbox-target" id="1">
        <img src="http://placehold.it/700x400" />
        <a class="lightbox-close" href="#"></a>
    </div>

    <!-- NOTE UNTUK SEMENTARA BAGIAN DI BAWAH INI JANGNA DI HAPUS DULU -->

    <!-- <a href="#" class="pop">
        <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image"/>
    </a>

    <a href="#" class="pop">
        <img src="http://placehold.it/700x400" class="img-fluid" alt="Responsive image"/>
    </a>

    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <img src="" class="imagepreview" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(function() {
            $('.pop').on('click', function() {
                $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                $('#imagemodal').modal('show');
            });
        });
    </script> -->
</body>

</html>