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
if(isset($_POST['submit'])){
    $num = $_POST['num'];
    $pass = $_POST['pass'];

    $login_query = "SELECT * FROM `user` WHERE Number = '$num'";
    $login_result = mysqli_query($conn, $login_query);

    if(mysqli_num_rows($login_result) == 1){
        $row = mysqli_fetch_assoc($login_result);
        if(password_verify($pass, $row['Password'])){
        	if($row['Status'] == "Active"){
            $_SESSION['num'] = $row['Number']; 
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/login.js"></script>
     <meta http-equiv="refresh" content="2; URL=index.php">';
     }else{
     echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/alreadybanned.js"></script>
     <meta http-equiv="refresh" content="2;">';
     }
        } else {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/wrongpass.js"></script>
     <meta http-equiv="refresh" content="2;">';
   }
    } else {
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/wrongpass.js"></script>
     <meta http-equiv="refresh" content="2;">';
    }
}

$conn->close();
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
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="./fpass.php">Forgot Password ?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit">Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to Gonezap?</p>
                    <a class="text-primary fw-bold ms-2" href="./register.php">Create an account</a>
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