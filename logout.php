<?php  
error_reporting(0); 
session_start();
include '../config/database.php';
include '../config/config.php';
session_unset();
session_destroy();
header("location:index.php");
exit();
?>