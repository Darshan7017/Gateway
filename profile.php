<?php
session_start(); 
include './assets/con.php';
$num = $_SESSION['num'];
if (!isset($num)) {
    header("Location: login.php");
    exit; 
}
$sql1 = "SELECT * FROM `user` WHERE Number = '$num'";
$result1 = mysqli_query($conn,$sql1);
$data = mysqli_fetch_assoc($result1);
$name = $data['Name'];
$num = $data['Number'];
$email = $data['Email'];
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
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php include 'assets/nav.php'; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Profile</h5>
              <input type="text" class="form-control mb-3 mt-3" value="<?= $name; ?>" readonly>
              	<input type="text" class="form-control mb-3 mt-3" value="<?= $num; ?>" readonly>
              	<input type="text" class="form-control mb-3 mt-3" value="<?= $email; ?>" readonly>
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