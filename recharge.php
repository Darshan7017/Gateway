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
  	$oid = $_POST['oid'];
  $records1 = mysqli_query($conn,"select * from user where Number='$num'"); 
$data1   = $records1->fetch_assoc();
$bal = $data1['Balance'];
$fund = $data1['TRec'];
$name = $data1['Name'];
$sel="select * from Transaction where oid='$oid'";
$run=mysqli_query($conn,$sel);
if(mysqli_num_rows($run) >= 1 ){
	echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/rnot.js"></script>';
                  }else{
         $verify = call("https://paytm-txn-api.vercel.app/api/?key=AazEO81MOr5Qyt1brC&txn=$oid");
    $paymentdecode = json_decode($verify,true);
    $status = $paymentdecode['STATUS'];
    $rep = $paymentdecode['RESPMSG'];
    $amooo = $paymentdecode['TXNAMOUNT'];
    $ref = $paymentdecode['BANKTXNID'];
    date_default_timezone_set("Asia/Calcutta");
          $date = date("h:i:s A");
          $time = date("d-M-Y");
    $amo = floatval($amooo);
    $get=$amo*5/100;
$realamo=$amo-$get;
$vpa = "depost@gonezap";
$tnote = "Deposit";
    if($status == "TXN_SUCCESS" && $rep == "Txn Success"){
    	$sql = "INSERT INTO Transaction (user,oid,vpa,uname,amount,tnote,reference,time,date,Type)
values ('$num','$oid','$vpa','$name','$amo','$tnote','$ref','$date','$time','Deposit')";
 $result = mysqli_query($conn, $sql);
    if($result){
    	$add=$bal+$amo;
$tfund=$fund+$amo;
$uup="UPDATE user SET Balance='$add' ,Trec='$tfund' WHERE Number='$num'";
$update = mysqli_query($conn, $uup);
  $tex1='<b>🥳 Add Fund Activity In User Account 

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
    } else {
    	$error = "Error: " . $sql . "" . mysqli_error($conn);
    	}} else {
    echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/rnot.js"></script>';
    }
    }
 }
 ?>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php include 'assets/nav.php'; ?>
      <div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Recharge</h5>
            <div style="text-align: center;">
            <img src="./assets/qrpay.jpg" width="50%" height="50%" style="display: block; margin: 0 auto; border: 1px solid black;">
        </div><form method="post">
                    <input type="text" class="form-control mb-3 mt-3" placeholder="Enter Order ID / Transcation ID" name="oid" required>
                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit">Submit</button></form><p class="mb-3">Please ensure payments are made within the range of ₹10 to ₹5000 to avoid any discrepancies or issues with the transaction amount.</p></div>
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
</body>

</html>