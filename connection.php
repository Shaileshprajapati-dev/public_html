<?php 
$servername = "localhost";
$username  = "root"; // Add your database username
$password = ""; // Add your database password
$dbname = "id19918082_new";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

$config = array();
$setq = mysqli_query($con, "SELECT * FROM settings");
while ($setrow = mysqli_fetch_array($setq)) {
    $name_key = $setrow['key_name'];
    $value = $setrow['key_value'];
    $config[$name_key] = $value;
}

$mails = array();
$ccs = array();
$mailq = mysqli_query($con, "SELECT * FROM emails");
while ($mailrow = mysqli_fetch_array($mailq)) {
    $table = $mailrow['number'];
    $email = $mailrow['email'];
    $cc = $mailrow['cc'];
    $mails[$table] = $email;
    $ccs[$table] = $cc;
}
?>
