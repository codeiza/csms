<?php 
session_start();
//print_r($_SESSION);
 require_once 'php/connection.php';
try{
	   $pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
	   "SELECT * FROM schedule_list
	   WHERE
	   Status = 'For Schedule' and cancel_delete is null
	   "
	   );
	 $stmt->execute();
	 $total = $stmt->rowCount();
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
//if($_SESSION["user"]["accountType"] == 'Admin'){
	
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
    <title>Feedback</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
	<link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery.datetimepicker.css">    
	<script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    
    
</head>
<style>
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
       body {
    font-family: Arial, sans-serif;
}

.form-container {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.rating-container {
    margin-bottom: 15px;
}

textarea {
    resize: vertical;
}

.btn-success {
    background-color: #28a745;
    color: #fff;
    border: none;
}

.btn-success:hover {
    background-color: #218838;
}
.main-content {
        overflow-y: auto; 
        height: 100vh; 
    }
    
    </style>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="company-logo">
                 <img src="image/logo.png" alt="Company Logo">
            </div>
            <div style="text-align: center;">
    <?php
    if (isset($_SESSION["user"]["firstName"])) {
      echo '<h2 style="font-family: Helvetica, sans-serif;">Welcome ' . $_SESSION["user"]["firstName"] . '!</h2>';
      echo '<p style="color: yellow; font-size: 12px; font-family: Helvetica, sans-serif;">You are logged in as a ' . $_SESSION["user"]["accountType"] . '</p>';
    } else {
        echo '<h2>Welcome Guest!</h2>'; // or any other default message you want
    }
    ?>
</div> <br>
            <ul>
                <hr>
                <?php if (@$_SESSION["user"]["accountType"] == 'Admin') { ?>
                <li>
                    <a href="summary.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Dashboard</a>
                </li>
				<?php }elseif(@$_SESSION["user"]["accountType"] == 'Priest' || @$_SESSION["user"]["accountType"] == 'Parishioner'){ ?>
				 <li>
                    <a href="Schedule.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Dashboard</a>
                </li>
				<?php } else { ?>
				<li>
                    <a href="client_dash_board.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Dashboard</a>
                </li>
				<?php } ?>
				<?php if (@$_SESSION["user"]["accountType"] == 'Admin') { ?>
				<li>
                <a href="user.php" class="dashboard-link"><img src="image/user.png" alt="user Forms Logo" class="dashboard-img">Manage Users</a>
				</li>
				<li>
                <a href="schedule.php" class="dashboard-link"> <img src="image/reservation.png" alt="Notify Logo" class="dashboard-img">Event Schedule</a>
                </li>
				<li>
                      <a href="document.php" class="dashboard-link"> <img src="image/request.png" alt="request Logo" class="dashboard-img">Request Document<sup style="color:red; font-weight:bold" class="flashited"> New <?php echo $totaldoc; ?></sup></a>
                </li>
				<li>
                     <a href="certificate.php" class="dashboard-link"> <img src="image/certificate.png" alt="Notify Logo" class="dashboard-img">Certificate</a>
                </li>
				<?php }elseif(@$_SESSION["user"]["accountType"] == 'Priest'){ ?>
				<li>
                     <a href="Schedule.php" class="dashboard-link"> <img src="image/reservation.png" alt="Notify Logo" class="dashboard-img">Event Schedule</a>
                </li>
				<?php } else { ?>
				<?php } 
				if (@$_SESSION["user"]["accountType"] == 'Admin') {
				}else{
				?>
                <li class="dropdown">
                <a href="#" class="dropdown-btn">
                    <img src="image/services.png" alt="Services Logo" class="dropdown-img">Services</a>
                    <div class="dropdown-content">
                        <a href="baptism.php"><img src="image/baptism.png" alt="Services Logo" class="dropdown-img">Baptismal</a>
                        <a href="wedding.php"><img src="image/wedding.png" alt="Services Logo" class="dropdown-img">Wedding</a>
                        <a href="funeral.php"><img src="image/funeral.png" alt="Services Logo" class="dropdown-img">Funeral</a>
                        <a href="mass.php"><img src="image/mass.png" alt="Services Logo" class="dropdown-img">Mass</a>
                        <a href="blessing.php"><img src="image/blessing.png" alt="Services Logo" class="dropdown-img">Blessing</a>
                    </div>
                    <li>
                    <a href="reqest_document.php" class="dashboard-link"> <img src="image/payments.png" alt="Docs Logo" class="dashboard-img">Documents</a>
                </li>
                </li>
				<?php } ?>
                <li class="dropdown">
                <a href="#" class="dropdown-btn">
                    <img src="image/transactions.png" alt="Transactions Logo" class="dropdown-img">Transactions</a>
                    <div class="dropdown-content">
						<a href="donation.php"> <img src="image/donations.png" class="dropdown-img">Donation</a>
                        <a href="mass_ofering.php"><img src="image/offering.png" alt="Transactions Logo" class="dropdown-img">Mass Offerings</a>
                        <a href="history.php"><img src="image/payments.png" alt="Transactions Logo" class="dropdown-img">History Transaction</a>
                    </div>
                </li>
                
            </ul>
            <?php 
			if(isset($_SESSION['user'])){ ?>
            <button class="logout-button" onclick="window.location.href='logout.php'">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
			<?php }else{ ?>
			 <button class="logout-button" style="background-color:green" onclick="window.location.href='login.php'">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
			<?php } ?>
   <br>
        </div>
        <div class="main-content">
            <div class="top-bar">
                <div class="profile">
                    <span>Client Feedback</span>
					<div>
					<?php if (@$_SESSION["user"]["accountType"] == 'Admin' and $total > '0') { ?>
					<span class="fa fa-bell noti" style="color:red"><sup style="color:red;" class="flashited"><?php echo $total; ?></sup></span>
					<?php }else{
					}    if(!isset($_SESSION['user'])){ ?>
		
				<?php	}else{
					?>
                    <img src="picture_data/<?php echo $_SESSION["user"]["picture_data"]; ?>" alt="Profile Image" id="profile" >
					<?php } ?>
					</div>
                </div>
            </div>
            <div class="feedback-form-container">
    <div class="form-container">
        <div class="row">
            <div class="col-md-4">
                <input type="hidden" placeholder="Search Keyword" id="keyword" class="form-control" />
            </div>
            <div class="col-md-4">
                <div class="rating-container">
                    <h3>Rate your experience:</h3>
                    <select class="form-control" id="ratings">
                        <option value="☆☆☆☆☆">☆☆☆☆☆ - Excellent</option>
                        <option value="☆☆☆☆">☆☆☆☆ - Very Good</option>
                        <option value="☆☆☆">☆☆☆ - Good</option>
                        <option value="☆☆">☆☆ - Fair</option>
                        <option value="☆">☆ - Poor</option>
                    </select>
                </div>
                <textarea class="form-control mt-3" placeholder="Share your feedback..." id="feedback"></textarea>
               &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
               &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
               &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
               &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;
                <button type="button" class="btn btn-success mt-3" id="save_feedback">Submit Feedback</button>
            </div>
            <div class="col-md-4">
                <input type="hidden" value="500" id="perpage" />
            </div>
        </div>

        <div class="container py-5" id="page-container">
            <div id="feedback_id"></div>
        </div>
    </div>
</div>


</body>
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

<script src="./js/feedback.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="js/jquery.datetimepicker.full.js"></script> 
</html>  