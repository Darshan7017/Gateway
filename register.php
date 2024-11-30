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

if(isset($_POST['submit'])){
	function mkey() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $characters_length = strlen($characters);
    $random_string = '';

    for ($i = 0; $i < 15; $i++) {
        $random_string .= $characters[rand(0, $characters_length - 1)];
    }
    return $random_string;
}
    $name = $_POST['name'];
    $num = $_POST['num'];
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
     $mid = str_pad(random_int(1, 99999999), 15, '0', STR_PAD_LEFT);
     $mkey = mkey();
    // Check if email or phone number already exists in the database
    $check_query = "SELECT * FROM `user` WHERE Email = '$mail' OR Number = '$num'";
    $check_result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($check_result) > 0){
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/enaexist.js"></script>
     <meta http-equiv="refresh" content="2;">';
    } else {
    	$check_keys = "SELECT * FROM `user` WHERE Email = '$mail' OR Number = '$num'";
    $check_key = mysqli_query($conn, $check_keys);
    if(mysqli_num_rows($check_key) > 0){
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/enaexist.js"></script>
     <meta http-equiv="refresh" content="2;">';
     }else{
        $balance = 0;
        $status = 'Active'; 

        $sql = "INSERT INTO `user` (Name, Number, Email, Balance, Password, Mid, Mkey, TRec, TWit, ip, Status)
            VALUES ('$name', '$num', '$mail', '$balance', '$hashed_password','$mid', '$mkey','$balance','$balance', '', '$status')";

        $res = mysqli_query($conn, $sql);

        if($res){
         echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./assets/js/register.js"></script>
     <meta http-equiv="refresh" content="2; URL=login.php">';
        } else {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/registerfail.js"></script>
     <meta http-equiv="refresh" content="2;">';
        }
    }
}
    $conn->close();
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
                    <input type="text" class="form-control" placeholder="Enter Your Name" name="name" required>
                  </div>
                  <div class="mb-3">
                    <input type="number" class="form-control" placeholder="Enter Your Mobile Number" name="num" required>
                  </div>
                        <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Enter Your Email Address" name="mail" required>
                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control" placeholder="Enter Your Password" name="pass" required>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="submit">Sign Up</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="./login.php">Sign In</a>
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