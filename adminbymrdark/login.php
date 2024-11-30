<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gonezap</title>
  <link rel="shortcut icon" type="image/png" href="../assets/logo.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>
<body>
	<?php
session_start(); // Start the session
if(isset($_SESSION['admin'])){
		header("Location: index.php");
		}
if(isset($_POST['submit'])){
    $num = $_POST['num'];
    $pass = $_POST['pass'];
        if($num == "8431576956" && $pass == "Darshan143@"){
            $_SESSION['admin'] = $num;
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/login.js"></script>
     <meta http-equiv="refresh" content="2; URL=index.php">';
        } else {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/wrongpass.js"></script>
     <meta http-equiv="refresh" content="2;">';
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
               
                <p class="text-center">UPI Payout Gateway </p>
                <form method="post">
                  <div class="mb-3">
                    <input type="number" class="form-control" placeholder="Enter Your Mobile Number" name="num" required>
                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control" placeholder="Enter Your Password" name="pass" required>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit">Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                 
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>