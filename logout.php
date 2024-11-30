<?php
session_start();

// Unset the 'num' session variable
unset($_SESSION['num']);

// Destroy the session
session_destroy();

// Redirect to a login or home page
header("Location: login.php"); // Replace 'login.php' with the appropriate page
exit;
?>