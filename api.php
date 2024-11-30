<?php
session_start(); 
include './assets/con.php';
$num = $_SESSION['num'];
if (!isset($num)) {
    header("Location: login.php");
    exit; 
}
date_default_timezone_set("Asia/Calcutta");
          $date = date("h:i:s A");
          $time = date("d-M-Y");
function call($url){
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  $curl_response = curl_exec($curl);
  curl_close($curl);
  return $curl_response;
}
$sql1 = "SELECT * FROM `user` WHERE Number = '$num'";
$result1 = mysqli_query($conn,$sql1);
$data = mysqli_fetch_assoc($result1);
$mid = $data['Mid'];
$mkey = $data['Mkey'];
$ip = $data['ip'];
if($ip == null || $ip == ''){
	$ip = "None";
	}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gonezap</title>
  <link rel="shortcut icon" type="image/png" href="./assets/logo.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <?php
  if(isset($_POST['submit'])){
 	$ipa = $_POST['ip'];
 	$uup="UPDATE user SET ip='$ipa' WHERE Number='$num'";
$update = mysqli_query($conn, $uup);
echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/update.js"></script>
     <meta http-equiv="refresh" content="2;">';
 }
 ?>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php include 'assets/nav.php'; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">API Docs</h5>
            <input type="text" class="form-control mb-3" value="Your MID : <?= $mid; ?>" id="mid" readonly>
            	 <input type="text" class="form-control mb-3" value="Your Mkey : <?= $mkey; ?>" id="mid" readonly>
            <input type="text" class="form-control mb-3" value="Whitelist IP : <?= $ip; ?>" readonly>
            	<button type="button" class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Update Whitelist IP Address
</button>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Whitelist IP Address</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<form method="post">
        <input type="text" class="form-control mb-3" placeholder="Enter Your Whitelist IP Address" name="ip">
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit" class="btn btn-primary">Update</button></form>
      </div>
    </div>
  </div>
</div>
            	<h5 class="card-title fw-semibold mb-4">Taxes</h5>   <p class="mb-3 mt-3">1-200₹ Tax Will Be 8₹ <br>Above 200₹ Tax Will Be 5%</p>
            <h5 class="card-title fw-semibold mb-4">UPI Payout</h5>
            	<ul>
        <li><strong>Method:</strong> GET</li>
        <li><strong>URL:</strong> https://gonezap.in/api/payout.php</li>
    </ul>

    <h6>Request Payload Data:</h6>
    <pre>
        <code>
    "upi": "UPI ID",
    "beneficiary_name": "UPI User Name",
    "amount": Payout Amount,
    "message": "Transcation Note",
    "reference": "Payout Reference ( Must Be Unique )",
    "mid": "Your MID",
    "mkey": "Your Mkey"
        </code></pre>
        <h6>Success Response (Json):</h6>
    <pre>
        <code>
   "status_code" : "200",
   "status" : "Processing",
   "message" : "Kindly allow some time for the payout to process",
   "payout_id" : "GZ12345",
   "reference" : "GZ54321",
   "customerName" : "Gonezap"
        </code></pre>
        <h6>Failed Response (Json) Case 1:</h6>
    <pre>
        <code>
   "status_code" : "401",
   "status" : "Failed",
   "message" : "Mid Or Mkey Is Invalid",
   "code" : "request_failed",
   "type" : "authentication_error"
        </code></pre>
        <h6>Failed Response (Json) Case 2:</h6>
    <pre>
        <code>
   "status_code" : "401",
   "status" : "Failed",
   "message" : "Insufficient Fund ( Include Gonezap Tax )",
   "code" : "request_failed",
   "type" : "authentication_error"
        </code></pre>
        <h6>Failed Response (Json) Case 3:</h6>
    <pre>
        <code>
   "status_code" : "401",
   "status" : "Failed",
   "message" : "Invalid UPI Adress",
   "code" : "request_failed",
   "type" : "authentication_error"
        </code></pre>
        <h6>Failed Response (Json) Case 4:</h6>
    <pre>
        <code>
   "status_code" : "503",
   "status" : "Failed",
   "message" : "Server Busy Try Again",
   "code" : "request_failed",
   "type" : "authentication_error"
        </code></pre>
        <h6>Failed Response (Json) Case 5:</h6>
    <pre>
        <code>
   "status_code" : "419",
   "status" : "Failed",
   "message" : "Too Many Request",
   "code" : "request_failed",
   "type" : "authentication_error",
    "mid" : "Your MID",
    "mkey" : "Your Mkey"
        </code></pre>
 <h5 class="card-title fw-semibold mb-4">Transaction Status</h5>
 <ul>
        <li><strong>Method:</strong> GET</li>
        <li><strong>URL:</strong> https://gonezap.in/api/transcation.php</li>
    </ul>

        <h6>Success Response (Json) :</h6>
    <pre>
        <code>
   "status_code":"200",
   "status":"Credited",
   "UTR":"1234567"           

        </code><code>
   "status_code":"200",
   "status":"Processing"
   </code><code>
   "status_code":"200",
   "status":"Pending"
  </code></pre>
    <h6>Failed Response (Json) Case 1:</h6>
    <pre>
        <code>
   "status_code" : "401",
   "status" : "Failed",
   "message" : "Mid Or Mkey Is Invalid",
   "code" : "request_failed",
   "type" : "authentication_error"
        </code></pre>
          <h6>Failed Response (Json) Case 2:</h6>
    <pre>
        <code>
   "status_code":"401",
    "status":"failed",
    "message":"Invalid payout id"
        </code></pre>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>