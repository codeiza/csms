<?php 
session_start();
 require_once 'php/connection.php';
try{
	   $pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		
	$stmt = $pdo->prepare(
	   "SELECT * FROM requested_document
	   WHERE
	   request_status = 'For Received'
	   "
	   );
	 $stmt->execute();
	 $totaldoc = $stmt->rowCount();
	 } catch (PDOExeption $e) {
	   echo $e->getMessage();
   }
   //echo $sample2;
   $pdo = null; 
if($_SESSION["user"]["accountType"] == 'Admin'){
	
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styless.css">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
  <link rel="stylesheet" href="./css/my_style.css">
  <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
	<link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery.datetimepicker.css">    
	<script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    
</head>
<style>
        body {
    font-family: Arial, sans-serif;
}
        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: powderblue !important;
            border-style: solid;
            border-width: 1px !important;
        }
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            overflow: hidden; /* Hide scrollbars */
        }
        .dashboard-container {
            display: flex;
            flex-direction: row; 
        }

        .sidebar {
            width: 290px; 
        }
		.flashited{
         color:#f2f;
       	-webkit-animation: flash linear 1s infinite;
       	animation: flash linear 1s infinite;
       }
       @-webkit-keyframes flash {
       	0% { opacity: 1; } 
       	50% { opacity: .1; } 
       	100% { opacity: 1; }
       }
       @keyframes flash {
       	0% { opacity: 1; } 
       	50% { opacity: .1; } 
       	100% { opacity: 1; }
       }
       
.input-group-text {
    background-color: #007bff;
    color: #fff;
}

.btn-success {
    background-color: #28a745;
    color: #fff;
    border: none;
}

.btn-success:hover {
    background-color: #218838;
}
	
    </style>
<body>
    <div class="dashboard-container">
       <?php require_once 'sidebar/navigation.php'; ?>
        <div class="main-content">
            <?php require_once 'design/header.php'; ?>
            <div class="container py-5" id="page-container">
				<div class="row">
					<div class="col-sm-3 mb-3">
						<div class="input-group">
							<span class="input-group-text">
								<i class="fas fa-search"></i>
							</span>
							<input type="text" placeholder="Search Keyword" id="keyword" class="form-control" />
						</div>
					</div>
					<div class="col-sm-3 mb-3">
						<div class="input-group">
							<label class="input-group-text">Add User</label>
							<button id="add_user" class="btn btn-success">
								<i class="fas fa-plus"></i> <!-- Change the icon class as needed -->
							</button>
						</div>
					</div>
					
					<div class="col-sm-2 mb-3">
						<input type="hidden" value="500" id="perpage" />
					</div>
				</div>
				<div id="user"></div>
		</div>
		</div>
 </div>     
<!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header  bg-success">
			<h4 class="modal-title">Modal title</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			<div class="modal-body-1"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
</body>
<?php

}else{
 header ('Location: index.php');
}


?>
<script>
$(document).ready(function(){
    		$("#date_filter").datepicker({
    		format: 'yyyy-mm-dd',
    		startDate: '-3m',
    		autoclose: true
    		})
			
	
			jQuery('#dateAndTime').datetimepicker({
			format: 'Y-m-d g:i A', // Set the format to 'yyyy-mm-dd HH:ii' for date and time
			step: 30, // Set the time step to 30 minutes (optional)
			timepicker: true, // Enable the time picker
			minDate: new Date()
			});
			
		
    	});
		
</script>
<script src="./js/notification.js"></script>
<script src="./js/user.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="js/jquery.datetimepicker.full.js"></script> 
</html>  