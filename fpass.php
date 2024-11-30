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
                <form method="post" action="fpassotp.php">
                  <div class="mb-3">
                    <input type="number" class="form-control" placeholder="Enter Your Mobile Number" name="num" required>
                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control" placeholder="Enter Your New Password" name="pass" required>
                  </div>
                 
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit">Send OTP</button>
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