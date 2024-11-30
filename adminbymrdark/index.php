<?php
session_start(); 
include '../assets/con.php';
$num = $_SESSION['admin'];
if (!isset($num)) {
    header("Location: login.php");
    exit; 
}
date_default_timezone_set("Asia/Calcutta");
          $date = date("h:i:s A");
          $time = date("d-M-Y");
$records1 = mysqli_query($conn, "SELECT * FROM profit WHERE date='$time'");

if ($records1) {
    // Check if there is at least one row returned
    if ($records1->num_rows > 0) {
        while( $data = mysqli_fetch_assoc($records1) ){
        $amo = $data['profit'];
        $profit = $profit+$amo;
        }
    }else{
    	$profit = 0;
    }
    }
$records = mysqli_query($conn, "SELECT * FROM profit");
if ($records) {
    if ($records->num_rows > 0) {
        while( $data2 = mysqli_fetch_assoc($records) ){
        $tamo = $data2['profit'];
        $tprofit = $tprofit+$tamo;
        }
    } 
    }
  
$startDate = date('d-M-Y', strtotime('this week'));
$endDate = date('d-M-Y', strtotime('this week +6 days'));

// Query to retrieve data for the current week
$records2 = mysqli_query($conn, "SELECT * FROM profit WHERE date BETWEEN '$startDate' AND '$endDate'");
if ($records2) {
    if ($records2->num_rows > 0) {
        while( $data3 = mysqli_fetch_assoc($records2) ){
        $wamo = $data3['profit'];
        $wprofit = $wprofit+$wamo;
        }
    } else{
    	$wprofit = 0;
    }
    }
    $currentMonth = date('M');
$currentYear = date('Y');

$records3 = mysqli_query($conn, "SELECT * FROM profit WHERE MONTH(STR_TO_DATE(date, '%d-%b-%Y')) = MONTH(NOW()) AND YEAR(STR_TO_DATE(date, '%d-%b-%Y')) = YEAR(NOW())");
if ($records3) {
    if ($records3->num_rows > 0) {
        while( $data4 = mysqli_fetch_assoc($records3) ){
        $mamo = $data4['profit'];
        $mprofit = $mprofit+$mamo;
        }
    } else{
    	$mprofit = 0;
    }
    }
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gonezap</title>
  <link rel="shortcut icon" type="image/png" href="../assets/logo.png" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
						<p class="mb-0 text-secondary">Today Profit</p>
						<h4 class="my-1 text-info">₹<?= $profit; ?></h4>
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
					   <p class="mb-0 text-secondary">This Week Profit</p>
					   <h4 class="my-1 text-success">₹<?= $wprofit; ?></h4>
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
		   <p class="mb-0 text-secondary">This Month Profit</p>
					   <h4 class="my-1 text-danger">₹<?= $mprofit; ?></h4>
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
					   <p class="mb-0 text-secondary">Total Profit</p>
					   <h4 class="my-1 text-warning">₹<?= $tprofit; ?></h4>
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
  
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>

</html>