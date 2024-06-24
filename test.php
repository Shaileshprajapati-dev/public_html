<?php
$pass = "mygwork";
$pass = password_hash($pass,PASSWORD_DEFAULT);
echo $pass;
?>