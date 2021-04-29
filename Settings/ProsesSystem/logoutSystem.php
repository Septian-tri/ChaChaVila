<?php
if(!preg_match('/^[\s]*$/', $_SERVER['QUERY_STRING'])){

    die("JANGAN DI MASUKAN YANG ENGGAK2");
    return false;

}else{

    include "mainSystem.php";
    
    session_name("_lgn");
    session_start();

    if(base64_decode($_SESSION['TPG']) === "Non_Customer"){

        $alihkan = "../../Admin/";

    }else{

        $alihkan = "../../";

    }

    if(cekSession() === true){

        session_destroy();
        header("location:".$alihkan);
        return false;
    
    }else{

        session_destroy();
        header("location:../../index.php");
        return false;

    }
}
?>