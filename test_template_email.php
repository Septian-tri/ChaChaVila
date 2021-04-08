<!-- email verif -->

<!-- <body style="
    background-color: #D3D3D3;
    text-align: center;
    font-family: verdana;
    border-radius:10px;
    
    ">
    <div style="padding-right:20%;
            padding-left:20%;">
        <div style="
            background-color: #ffffff;
            ">

            <div class="nav" style="
                background-color: #7ABD7E;
                width:auto;
                height:auto;
                padding:10px;
                ">
                <img src="https://placehold.it/70x70">
                <img src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/Pengaturan/Gambar/LogoUtama/Logo.png" />
            </div>

            <h1 style="
                width: auto;
                text-align: center;
                color: #0B8142;
                line-height: 31px;
                margin: auto;
                padding-top: 30px;
                padding-bottom: 30px;
                /* border-bottom: solid 2px #042035;     */
                /* text-shadow: #fbdf03 1px 1px 0px; */
                font-weight: none;">

                Terima Kasih '.$namaPengguna.' Pendaftaran Kamu Berhasil
            </h1>

            <hr style="
                /* color: #FFFFFF; */
                height: 12px;
                border: 0;
                box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);
                ">

            <p style="
                text-indent:50px;
                text-align:left;
                padding:30px;
                /* color: white; */
                ">

                Terimakasih Kamu Sudah mendaftar di <strong style="color:#ffdf7a;">'.strtoupper($_SERVER['HTTP_HOST']).'</strong>, Sebelum kamu menggunkan layanan dari kami,
                kami meminta maaf atas ketidak nyamanan nanti yang kamu temukan, karna website kami masih berstatus beta. kamu juga dapat memeberi masukan memelalui menu saran ya, terimakasih. <strong>HAVE A NICE DAY</strong>

                <br>
                
                <div class="verfikasi" style="
                    color:#ffffff;
                    text-align:center;
                    background-color: #a0e892;
                    padding: 10px">

                    Kode Verfikasi : <strong style="color:#FF6961;">'.$finalIdRandom.'</strong>
                </div>
                
                <br>

                <div class="salam" style="
                    width:auto; 
                    /* font-weight: bold;  */
                    padding:7px; 
                    margin:7px;
                    text-align:left;
                    /* color: white; */
                    ">

                    Salam Hangat CEO & OWNER,
                    <br/>
                    <br>
                    Septian & Ahmad 
                    <hr style="width: 140px;margin-left:0px;">
                </div>
                <br>
                <div class="bawah" style="
                    text-align:center;
                    font-size:10px;
                    width:auto;
                    padding:10px;
                    color:white;
                    background-color: #2c5f2d;
                    border-bottom-left-radius: 5px;
                    border-bottom-right-radius: 5px;
                    border-top: solid 2px #3a4957;">

                    jika kamu tidak merasa melakukan pendaftaran / melakukan aktivitas pada '.$_SERVER['HTTP_HOST'].', Silahkan abaikan atau Hapus Pesan ini, atas pengertian nya
                    <br />
                    team '.$_SERVER['HTTP_HOST'].' mengucapkan terimakasih.
                </div>
            </p>
        </div>
    </div>
    
    
</body> -->

<!-- email reset -->
<!-- <body style="
    background-color: #D3D3D3;
    text-align: center;
    font-family: verdana;
    border-radius:10px;
    
    ">
    <div style="padding-right:20%;
            padding-left:20%;">
        <div style="
            background-color: #ffffff;
            ">

            <div class="nav" style="
                background-color: #7ABD7E;
                width:auto;
                height:auto;
                padding:10px;
                ">
                <img src="https://placehold.it/70x70">
                <img src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/Pengaturan/Gambar/LogoUtama/Logo.png" />
            </div>

            <h1 style="
                width: auto;
                text-align: center;
                color: #0B8142;
                line-height: 31px;
                margin: auto;
                padding-top: 30px;
                padding-bottom: 30px;
                /* border-bottom: solid 2px #042035;     */
                /* text-shadow: #fbdf03 1px 1px 0px; */
                font-weight: none;">

                Kode verfikasi reset sandi '.base64_decode($namaPengguna).
            </h1>

            <hr style="
                /* color: #FFFFFF; */
                height: 12px;
                border: 0;
                box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);
                ">

            <p style="
                text-indent:50px;
                text-align:left;
                padding:30px;
                /* color: white; */
                ">

                <strong  style="color:#ffdf7a;">'.base64_decode($namaPengguna).'</strong>, kami Mendapat kabar bahwa kamu lupa kata sandi, kami sudah berikan kode verifikasi ya dibawah, berlaku selama lima menit dan 
                kami meminta maaf atas ketidak nyamanan nanti yang kamu temukan, karna website kami masih berstatus beta. kamu juga dapat memeberi masukan memelalui menu saran ya, terimakasih. <strong>HAVE A NICE DAY</strong>

                <br>
                
                <div class="verfikasi" style="
                    color:#ffffff;
                    text-align:center;
                    background-color: #a0e892;
                    padding: 10px">

                    Kode Verfikasi : <strong style="color:#FF6961;">'.$finalIdRandom.'</strong>
                    Ini Kode Verfikasi Kamu ya : <strong style="color:#FF6961">'.$finalKodeVer.'</strong>
                </div>
                
                <br>

                <div class="salam" style="
                    width:auto; 
                    /* font-weight: bold;  */
                    padding:7px; 
                    margin:7px;
                    text-align:left;
                    /* color: white; */
                    ">

                    Salam Hangat CEO & OWNER,
                    <br/>
                    <br>
                    Septian & Ahmad 
                    <hr style="width: 140px;margin-left:0px;">
                </div>
                <br>
                <div class="bawah" style="
                    text-align:center;
                    font-size:10px;
                    width:auto;
                    padding:10px;
                    color:white;
                    background-color: #2c5f2d;
                    border-bottom-left-radius: 5px;
                    border-bottom-right-radius: 5px;
                    border-top: solid 2px #3a4957;">

                    jika kamu tidak merasa melakukan pendaftaran / melakukan aktivitas pada '.$_SERVER['HTTP_HOST'].', Silahkan abaikan atau Hapus Pesan ini, atas pengertian nya   
                    <br>
                    team '.$_SERVER['HTTP_HOST'].' mengucapkan terimakasih.
                </div>
            </p>
        </div>
    </div>
</body> -->

<body style="
    background-color: #D3D3D3;
    text-align: center;
    font-family: verdana;
    border-radius:10px;
    
    ">
    <div style="padding-right:20%;
            padding-left:20%;">
        <div style="
            background-color: #ffffff;
            ">

            <div class="nav" style="
                background-color: #7ABD7E;
                width:auto;
                height:auto;
                padding:10px;
                ">
                <!-- <img src="https://placehold.it/70x70"> -->
                <img src="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/Pengaturan/Gambar/LogoUtama/Logo.png" />
            </div>

            <h1 style="
                width: auto;
                text-align: center;
                color: #0B8142;
                line-height: 31px;
                margin: auto;
                padding-top: 30px;
                padding-bottom: 30px;
                /* border-bottom: solid 2px #042035;     */
                /* text-shadow: #fbdf03 1px 1px 0px; */
                font-weight: none;">

                Terima Kasih '.$namaPengguna.' Pendaftaran Kamu Berhasil
            </h1>

            <hr style="
                /* color: #FFFFFF; */
                height: 12px;
                border: 0;
                box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);
                ">

            <p style="
                text-indent:50px;
                text-align:left;
                padding:30px;
                /* color: white; */
                ">

                Terimakasih Kamu Sudah mendaftar di <strong style="color:#ffdf7a;">'.strtoupper($_SERVER['HTTP_HOST']).'</strong>, Sebelum kamu menggunkan layanan dari kami,
                kami meminta maaf atas ketidak nyamanan nanti yang kamu temukan, karna website kami masih berstatus beta. kamu juga dapat memeberi masukan memelalui menu saran ya, terimakasih. <strong>HAVE A NICE DAY</strong>

                <br>
                
                <div class="verfikasi" style="
                    color:#ffffff;
                    text-align:center;
                    background-color: #a0e892;
                    padding: 10px">

                    Kode Verfikasi : <strong style="color:#FF6961;">'.$finalIdRandom.'</strong>
                </div>
                
                <br>

                <div class="salam" style="
                    width:auto; 
                    /* font-weight: bold;  */
                    padding:7px; 
                    margin:7px;
                    text-align:left;
                    /* color: white; */
                    ">

                    Salam Hangat CEO & OWNER,
                    <br/>
                    <br>
                    Septian & Ahmad 
                    <hr style="width: 140px;margin-left:0px;">
                </div>
                <br>
                <div class="bawah" style="
                    text-align:center;
                    font-size:10px;
                    width:auto;
                    padding:10px;
                    color:white;
                    background-color: #2c5f2d;
                    border-bottom-left-radius: 5px;
                    border-bottom-right-radius: 5px;
                    border-top: solid 2px #3a4957;">

                    jika kamu tidak merasa melakukan pendaftaran / melakukan aktivitas pada '.$_SERVER['HTTP_HOST'].', Silahkan abaikan atau Hapus Pesan ini, atas pengertian nya
                    <br />
                    team '.$_SERVER['HTTP_HOST'].' mengucapkan terimakasih.
                </div>
            </p>
        </div>
    </div>
</body>