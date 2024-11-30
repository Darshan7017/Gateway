<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gonezap</title>
  <link rel="shortcut icon" type="image/png" href="./assets/logo.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>
<body>
	<?php
include './assets/con.php';
session_start(); // Start the session
if(isset($_SESSION['num'])){
		header("Location: index.php");
		}
		function call($url){
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  $curl_response = curl_exec($curl);
  curl_close($curl);
  return $curl_response;
}
	$num = $_POST['num'];
	$pass = $_POST['pass'];
	$login_query = "SELECT * FROM `user` WHERE Number = '$num'";
    $login_result = mysqli_query($conn, $login_query);
    $otp = mt_rand(100000, 999999);
    if(mysqli_num_rows($login_result) == 1){
    	$message = call('https://www.fast2sms.com/dev/bulkV2?authorization=rX2wO5iLxjZevyqTkGbfz936t4QNI7cCMluhWRmsnUDaodAVYK9RU7HdVEkCcTNg04OS6x5jADzyQrM2&route=otp&variables_values='.$otp.'&flash=0&numbers='.$num.'');
    $_SESSION['otp'] = $otp;
    $_SESSION['vnum'] = $num;
    $_SESSION['pass'] = $pass;
    }
    if(isset($_POST['reset'])){
    	$iotp = $_POST['otp'];
        $votp = $_SESSION['otp'];
       $pass = $_SESSION['pass'];
       $num = $_SESSION['vnum'];
        $pas = password_hash($pass, PASSWORD_DEFAULT);
        if($iotp == $votp){
        	$uup="UPDATE user SET Password='$pas' WHERE Number='$num'";
        $update = mysqli_query($conn, $uup);
        if($update){
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/reset.js"></script>
     <meta http-equiv="refresh" content="2; URL=login.php">';
     }
        }else{
        	echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/iotp.js"></script>';
     }
    }
?>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                 <h2 style="text-align: center;"> Gonezap </h2>
               
                <p class="text-center">Forgot Password</p>
                <div class="alert alert-success" role="alert">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#198754" d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4l8-8l-1.41-1.42Z"/></svg>  OTP Successfully Sent To <?= $num; ?>!
</div>
                <form method="post" action="fpassotp.php">
                  <div class="mb-3">
                    <input type="number" class="form-control" placeholder="Enter OTP" name="otp" required>
                  </div>
           <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="reset">Reset</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Know Password?</p>
                    <a class="text-primary fw-bold ms-2" href="./login.php">Login Here </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>