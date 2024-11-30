<?php
session_start(); 
include '../assets/con.php';
$admin = $_SESSION['admin'];
if (!isset($admin)) {
    header("Location: login.php");
    exit; 
}
date_default_timezone_set("Asia/Calcutta");
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
  <?PHP
  if(isset($_POST['submit'])){
    $amo = $_POST['amo'];
    $tnote = $_POST['tnote'];
    $num = $_POST['num']; // Changed from $nun to $num
    $date = date("h:i:s A");
    $time = date("d-M-Y");

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE Number=?");
    $stmt->bind_param("s", $num);
    $stmt->execute();
    $result = $stmt->get_result();
    $data1 = $result->fetch_assoc();

    $bal = $data1['Balance'];
    $fund = $data1['TRec'];
    $name = $data1['Name'];
    $oid = str_pad(random_int(1, 99999999), 15, '0', STR_PAD_LEFT);
    $ref = str_pad(random_int(1, 99999999), 15, '0', STR_PAD_LEFT);
    $vpa = "admin@gonezao";

    $sql = "INSERT INTO Transaction (user,oid,vpa,uname,amount,tnote,reference,time,date,Type)
values ('$num','$oid','$vpa','$name','$amo','$tnote','$ref','$date','$time','Deposit')";
 $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $add = $bal + $amo;
        $tfund = $fund + $amo;
        $uup = "UPDATE user SET Balance='$add', Trec='$tfund' WHERE Number='$num'";
        $update = mysqli_query($conn, $uup);

        // Adjust the concatenated string as needed; $rep seems undefined
        $tex1 = '<b>🥳 Add Fund Activity In User Account 
        ♂️ Status :- '. $rep.'
        🤑 Amount :- ₹'. $amo.' 
        🧾 User :- '.$num.'
        🔶 Order Id :- '.$oid.'
        📅 Date :- '.$time.' '.$date.'
        🤑 Updated Balance : '.$add.'
        ⚡ Powered By Fast Back
        </b>';

        // Sending message via Telegram
        $text1 = urlencode("$tex1");
        file_get_contents('https://api.telegram.org/botYOUR_BOT_TOKEN/sendMessage?chat_id=YOUR_CHAT_ID&text='.$text1.'&parse_mode=html');
        
        // Display success message or handle as needed
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../assets/js/recharge.js"></script>';
    } else {
        $error = "Error: " . $sql . "" . mysqli_error($conn);
        // Handle error properly, like redirecting or displaying an error message
    }
} 
?>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php include 'assets/nav.php'; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Add & Remove Balance</h5>
            <form method="post">
            <input type="text" class="form-control mb-3 mt-3" placeholder="Enter Amount ( Use - For Remove )" name="amo" required>
            	<input type="text" class="form-control mb-3 mt-3" placeholder="Enter User Number" name="num" required>
            <input type="text" class="form-control mb-3 mt-3" placeholder="Enter Transcation Note" name="tnote" required>
            	<button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit">Add Balance</button>
            </form>
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