<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Creating Array for JSON response
$response = array();
 
include "connection.php";
// Check if we got the field from the user
if (isset($_GET['temp']) && isset($_GET['hum'])) {
 
    $temp = $_GET['temp'];
    $hum = $_GET['hum'];
    $addq = mysqli_query($con,"INSERT INTO `new_100`(temp,hum) VALUES ('$temp','$hum')");
    if($addq){
        $response["success"] = 1;
    }
    else{
        $response["success"] = 0;
    }
    // Show JSON response
    echo json_encode($response);
} else {
    // If required parameter is missing
    $response["success"] = 0;
    $response["message"] = "Parameter(s) are missing. Please check the request";
 
    // Show JSON response
    echo json_encode($response);
}
?>