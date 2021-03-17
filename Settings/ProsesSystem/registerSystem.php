<?php

//include main sistem untuk mengambil function
include("mainSystem.php");

//set nama session dan mulai session
session_name("registerSession"); 
session_start();

sendErrorMessage("sadas", "fieldError", "notificationErrorField");

?>