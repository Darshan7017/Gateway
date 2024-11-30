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
function call($url, $data){
  $curl = curl_init($url);
  $headers = array(
    'Content-Type: application/json',
    'x-client-id: YOUR_CLIENT_ID_HERE',
    'x-client-secret: YOUR_CLIENT_SECRET_HERE'
);
$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $curl_response = curl_exec($ch);
  curl_close($curl);
  return $curl_response;
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gonezap</title>
  <link rel="shortcut icon" type="image/png" href="./assets/logo.png" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <?php
  if(isset($_POST['submit'])){
  	$amoo = $_POST['amo'];
      $vpa = $_POST['vpa']; 
      $mess = $_POST['mess'];
      $name = $_POST['name'];
      $records1 = mysqli_query($conn,"select * from user where Number='$num'"); 
$data1   = $records1->fetch_assoc();
$bal = $data1['Balance'];
$fund = $data1['TWit'];
if ($amoo <= 200) {
    $tax = 8;
} else if ($amoo > 200) {
    $tax = $amoo*5/100;
}
$amo = $amoo+$tax;
if($amo>$bal){
$endpoint = "https://kepler.haodapayments.com/api/v1/upi/payout/initiate";
$oid = "GZ".mt_rand(11111111111111, 99999999999999999);
$data = array(
    "vpa" => "$vpa",
    "beneficiary_name" => "$name",
    "amount" => $amo,
    "narration" => "$mess",
    "reference" => "$oid"
);
$response = call($endpoint, $data);
if ($response === false) {
    echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/server.js"></script>';
} else {
    $json = json_decode($response, true);
    $scode = $json['status_code'];
    $code = $json['code'];
    $mess = $json['message'];
    $status = $json['status'];
    $ref = $json['reference'];
    if($scode == 401 && $mess == "Invalid VPA Address"){
    	echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/ivpa.js"></script>';
    }else if($scode == 200 && $status == "Processing"){
    	$sql = "INSERT INTO Transaction (user,oid,vpa,uname,amount,tnote,reference,time,date,Type)
values ('$num','$oid','$vpa','$name','$amo','$mess','$ref','$date','$time','Withdraw')";
$sql = "INSERT INTO profit (profit,date,time)
values ('$tax','$time','$date')";
    	$add=$bal-$amo;
$tfund=$fund+$amo;
$uup="UPDATE user SET Balance='$add' ,Trec='$tfund' WHERE Number='$num'";
$update = mysqli_query($conn, $uup);
  $tex1='<b>🥳 Withdraw Activity In User Account 

♂️ Status :- '. $rep.'
🤑 Amount :- ₹'. $amo.' 
🧾 User :- '.$num.'

🔶 Order Id :- '.$oid.'
📅 Date :- '.$time.' '.$date.'
🤑 Updated Balance : '.$add.'

⚡ Powered By Fast Back
</b>';
  $text1=urlencode("$tex1");
  file_get_contents('https://api.telegram.org/bot6172365321:AAFJ2E4T_EJDEcdUNyD7FuAfS2QTu6jUhww/sendMessage?chat_id=1516610662&text='.$text1.'&parse_mode=html');
echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/recharge.js"></script>';
    }else{
    	echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/server.js"></script>';
    }
}
	}else{
		echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/ibal.js"></script>';
	}
  }
  ?>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php include 'assets/nav.php'; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Withdraw</h5>
           <form method="post">
           	<input type="text" class="form-control mb-3 mt-3" placeholder=" Enter Beneficiary Name" name="name" required>
           	<input type="number" class="form-control mb-3 mt-3" placeholder="Enter Amount" name="amo" required min="10" max="1000">
                 	<input type="text" class="form-control mb-3 mt-3" placeholder="Enter UPI ID" name="vpa" id="vpa" required >
                 	<input type="text" class="form-control mb-3 mt-3" placeholder="Enter Withdraw Message" name="mess">
               <div id="button"> <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit" id="validate">Withdraw</button></div></form><h5 class="card-title fw-semibold mb-4">Taxes</h5>   <p class="mb-3 mt-3">1-200₹ Tax Will Be 8₹ <br>Above 200₹ Tax Will Be 5%</p></div>
    </div>
</div>
</div>
<div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Copyright &copy; <script>document.write("- "+(new Date).getFullYear());</script> <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary">Gonezap</a></p>
        </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>