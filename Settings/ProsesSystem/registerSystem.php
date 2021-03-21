<?php

//include main sistem untuk mengambil function
include("mainSystem.php");

if(!isset($_POST['username'], $_POST['email'], $_POST['phonenumber'], $_POST['password'], $_POST['repassword'])){

    sendErrorMessage("Proses tidak dapat di lanjutkan !", "notificationErrorField", "form-control");
    exit;
    return false;

}else{

    sendErrorMessage("Proses tidak dapat di lanjutkan !", "notificationErrorField", "email");

}
?>