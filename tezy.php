<?php

// API endpoint and request body
$endpoint = 'https://kepler.haodapayments.com/api/v1/upi/payout/initiate';
$requestBody = array(
    "vpa" => "darshan7017@axp",
    "beneficiary_name" => "Darshan",
    "amount" => 1,
    "narration" => "Testing",
    "reference" => "Haoda01"
);

$requestHeaders = array(
    'Content-Type: application/json',
    'x-client-id: scuqDeBwHk3185', // Replace with your client ID
    'x-client-secret: Ctr2kE5pA0231117060549' // Replace with your client secret
);

$ch = curl_init($endpoint);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody));
curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);

// Execute cURL request and get response
$response = curl_exec($ch);

if ($response === false) {
    echo 'Error: ' . curl_error($ch);
} else {
    echo 'Response: ' . $response;
}

// Close cURL session
curl_close($ch);

?>
