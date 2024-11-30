<?php
date_default_timezone_set('Asia/Kolkata');
$date=date("Y-m-d");
$servername = "localhost";
$username = "root";
$password = ""; // Enter your actual database password here
$database = "gateway"; // Enter your actual database name here

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $conne = true;
}
?>
