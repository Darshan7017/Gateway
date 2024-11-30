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
?><!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gonezap</title>
  <link rel="shortcut icon" type="image/png" href="./assets/logo.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <style>
body {
  font-family: Arial, sans-serif;
}

table {
  width: 100%;
  border-spacing: 0;
}

td {
  border-bottom: 1px solid #dddddd;
  padding: 8px;
  text-align: left;
}

tr:first-child td {
  font-weight: bold;
}

tr:nth-child(even) td {
  background-color: #f9f9f9;
}

tr:hover td {
  background-color: #e9e9e9;
}
</style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <?php include 'assets/nav.php'; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Transcation</h5>
              <table>
    <thead>
      <tr>
      	<th>Date</th>
        <th>Type</th>
        <th>Amo</th>
        <th>TNote</th>
        
      </tr>
    </thead>
    <tbody>
    	<?php
    $sqli = "SELECT * FROM Transaction WHERE user = $num ORDER BY date DESC";
    $resultseti = mysqli_query($conn, $sqli); 
    while ($record = mysqli_fetch_assoc($resultseti)) {
        $amo = $record['amount'];            
        $date = $record['date'];    
        $type = $record['Type'];      
        $tnote = $record['tnote'];
?>
        <tr>
            <td><?= $date; ?></td>
            <td><?= $type; ?></td>
            <td><?= $amo; ?></td>
            <td><?= $tnote; ?></td>
            
        </tr>
<?php
        $id++;
    } // Added closing curly brace for the while loop
?>
    </tbody>
  </table>
            
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