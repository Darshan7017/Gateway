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
$trec = $data['TRec'];
$twit = $data['TWit'];
$bal = $data['Balance'];
$status = $data['Status'];
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gonezap</title>
  <link rel="shortcut icon" type="image/png" href="./assets/logo.png" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    	<?php include 'assets/nav.php'; ?>
    
      <div class="container-fluid">
      	<div class="container">
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
       <div class="col">
		 <div class="card radius-10 border-start border-0 border-3 border-info">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0 text-secondary">Balance</p>
						<h4 class="my-1 text-info">₹<?= $bal; ?></h4>
					</div>
					<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fa fa-shopping-cart"></i>
					</div>
				</div>
			</div>
		 </div>
	   </div>
	  <div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-success">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Total Recharge</p>
					   <h4 class="my-1 text-success">₹<?= $trec; ?></h4>
					   		   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fa fa-bar-chart"></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div>
	<div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-danger">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Total Withdraw</p>
					   <h4 class="my-1 text-danger">₹<?= $twit; ?></h4>
					   		   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="fa fa-dollar"></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div>
	  <div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-warning">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Status</p>
					   <h4 class="my-1 text-warning"><?= $status; ?></h4>
					   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div> 
	</div>
</div>
              </div>
             
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Copyright &copy; <script>document.write("- "+(new Date).getFullYear());</script> <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary">Gonezap</a></p>
        </div>
      </div>
    </div>
  </div>
  
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="./assets/js/dashboard.js"></script>
</body>

</html>