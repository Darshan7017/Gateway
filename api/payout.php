<?php
include '../assets/con.php';
$mid = $_GET['mid'];
$mkey = $_GET['mkey'];
$vpa = $_GET['upi'];
$uname = $_GET['beneficiary_name'];
$amoo = $_GET['amount'];
$tnote = $_GET['message'];
$ref = $_GET['reference'];
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
if(!$mid || !$mkey || !$vpa || !$uname || !$amoo || !$tnote || !$ref) {
    $data = [
        'status_code' => 401,
        'status' => 'Failed',
        'message' => 'One or more parameters are empty'
    ];
    $echo = json_encode($data);
    echo $echo;
} else {
    // Assuming $conn is a valid database connection established earlier
    $mid = mysqli_real_escape_string($conn, $mid);
    $mkey = mysqli_real_escape_string($conn, $mkey);

    $records = mysqli_query($conn, "SELECT * FROM user WHERE Mid='$mid' AND Mkey='$mkey'");

    if ($records && mysqli_num_rows($records) > 0) {
        $data1 = $records->fetch_assoc();
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
    $data = [
            'status_code' => 503,
            'status' => 'Failed',
            'message' => 'Server Busy Try Again',
            'code' => 'request_failed',
            'type' => 'authentication_error'
        ];
        $echo = json_encode($data);
        echo $echo;
    }
}
	}else{
		$data = [
            'status_code' => 401,
            'status' => 'Failed',
            'message' => 'Insufficient Fund ( Include Gonezap Tax )',
            'code' => 'request_failed',
            'type' => 'authentication_error'
        ];
        $echo = json_encode($data);
        echo $echo;
	}
    } else {
        $data = [
            'status_code' => 401,
            'status' => 'Failed',
            'message' => 'Mid Or Mkey Is Invalid',
            'code' => 'request_failed',
            'type' => 'authentication_error'
        ];
        $echo = json_encode($data);
        echo $echo;
    }
}
?>