<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$to = "darshangangadhar117@gmail.com";
$subject = "Testing PHP Mail";
$message = "This is a test message sent from PHP.";
$headers = "From: payment@gonezap.in\r\n";
$headers .= "Reply-To: sender@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$mailSent = mail($to, $subject, $message, $headers);

if ($mailSent) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email. Please check your configuration.";
}
?>