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
//if($_SESSION["user"]["accountType"] == 'Admin' || $_SESSION["user"]["accountType"] == 'Priest' || $_SESSION["user"]["accountType"] == 'Parishioner'){
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
    <title>Worship</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
	<link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery.datetimepicker.css">    
	<script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    
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
body {
    font-family: Arial, sans-serif;
}
body {
    font-family: Arial, sans-serif;
}
    </style>
<body>
<div class="main-container">
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="company-logo">
                 <img src="images/logo.png" alt="Company Logo">
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
</div>
            <ul>
                <hr>
                <?php if (isset($_SESSION["user"]["accountType"]) && $_SESSION["user"]["accountType"] == 'Admin') { ?>
        <li>
            <a href="summary.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Dashboard</a>
        </li>
    <?php } elseif (isset($_SESSION["user"]["accountType"]) && ($_SESSION["user"]["accountType"] == 'Priest' || $_SESSION["user"]["accountType"] == 'Parishioner')) { ?>
        <li>
            <a href="schedule.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Dashboard</a>
        </li>
    <?php } else { ?>
        <li>
            <a href="client_dash_board.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img"><?php echo isset($_SESSION["user"]["firstName"]) ? 'Dashboard' : 'Home'; ?></a>
        </li>
    <?php } ?>
                <?php if (@$_SESSION["user"]["accountType"] == 'Admin') { ?>
				<li>
					<a href="user.php" class="dashboard-link"><img src="image/request.png" alt="Request Forms Logo" class="dashboard-img">User Monitoring</a>
				</li>
				<li>
                     <a href="schedule.php" class="dashboard-link"> <img src="image/notify.png" alt="Notify Logo" class="dashboard-img">Event Schedule</a>
                </li>
				<li>
                      <a href="document.php" class="dashboard-link"> <img src="image/request.png" alt="request Logo" class="dashboard-img">Request Document<sup style="color:red; font-weight:bold" class="flashited"> New <?php echo $totaldoc; ?></sup></a>
                </li>
				<li>
                     <a href="certificate.php" class="dashboard-link"> <img src="image/certificate.png" alt="Notify Logo" class="dashboard-img">Certificate</a>
                </li>
				<li>
                     <a href="message.php" class="dashboard-link"> <img src="image/massage.png" alt="Notify Logo" class="dashboard-img">Message</a>
                </li>
				<?php }elseif(@$_SESSION["user"]["accountType"] == 'Priest'){ ?>
				<li>
                     <a href="schedule.php" class="dashboard-link"> <img src="image/reservation.png" alt="Notify Logo" class="dashboard-img">Event Schedule</a>
                </li>
				<?php } else { ?>
				<?php } ?>
                <li class="dropdown">
                <a href="#" class="dropdown-btn">
                    <img src="image/services.png" alt="Services Logo" class="dropdown-img">Services</a>
                    <div class="dropdown-content">
                        <a href="baptism.php"><img src="image/baptism.png" alt="Services Logo" class="dropdown-img">Baptismal</a>
                        <a href="wedding.php"><img src="image/wedding.png" alt="Services Logo" class="dropdown-img">Wedding</a>
                        <a href="funeral.php"><img src="image/funeral.png" alt="Services Logo" class="dropdown-img">Funeral</a>
                        <a href="mass.php"><img src="image/mass.png" alt="Services Logo" class="dropdown-img">Mass</a>
                        <a href="blessing.php"><img src="image/blessing.png" alt="Services Logo" class="dropdown-img">Blessing</a>
                        <a href="worship.php"><img src="image/worship.png" alt="Services Logo" class="dropdown-img">Worship Ministry</a>

                    </div>
                </li>
                <li>
                    <a href="reqest_document.php" class="dashboard-link"> <img src="image/payments.png" alt="Docs Logo" class="dashboard-img">Documents</a>
                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-btn">
                    <img src="image/transactions.png" alt="Transactions Logo" class="dropdown-img">Transactions</a>
                    <div class="dropdown-content">
                    <a href="notification.php"><img src="image/forpay.png" alt="Transactions Logo" class="dropdown-img">For Pay</a>
                    <a href="progress.php"><img src="image/status.png" alt="Status Logo" class="dropdown-img">Scheduled Status</a>
                        <a href="donation.php"> <img src="image/donations.png" class="dropdown-img">Add Your Donation</a>
                         <a href="mass_ofering.php"><img src="image/offering.png" alt="Transactions Logo" class="dropdown-img">Mass Offerings</a>
                        <a href="history.php"><img src="image/payments.png" alt="Transactions Logo" class="dropdown-img">History Transaction</a>					
                    </div>
                </li>

                
                <li>
                    <a href="chatbot.php" class="dashboard-link"><img src="image/chatbot.png" alt="chatbot Logo" class="dashboard-img">Chatbot</a>
                </li>
                
            </ul>
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
    </a>
            </div>
        <div class="main-content">
            <div class="top-bar">
                <div class="profile">
                    <span>Worship Ministry</span>
					<div>
					<?php if (@$_SESSION["user"]["accountType"] == 'Admin' and $total > '0') { ?>
					<span class="fa fa-bell noti" style="color:red"><sup style="color:red;" class="flashited"><?php echo $total; ?></sup></span>
					<?php }else{
					}   if(!isset($_SESSION['user'])){ ?>
					<img src="picture_data/profile.png" alt="Profile Image">
				<?php	}else{
					?>
                    <img src="picture_data/<?php echo $_SESSION["user"]["picture_data"]; ?>" alt="Profile Image">
					<?php } ?>
					</div>
                </div>
            </div>
			<div class="row">
				<div class="col-sm-1">
				
				<?php if($_SESSION["user"]["accountType"] == 'Admin' ){ ?>
				<label>Add Ministry :</label><br>
				<input type="button" class="btn btn-success" value="Add" id="Add_minis" />
				<?php }else{
					
				} ?>
				</div>
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

    <div class="col-sm-2 mb-3">
    <div class="input-group">
        <label class="input-group-text" for="perpage">Filter :</label>
        <select class="form-control" id="perpage">
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="500">500</option>
        </select>
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
      <div class="container py-5" id="page-container">
	  <div id="workship"></div>

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
    	})
		
</script>

<script src="./js/worship.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="js/jquery.datetimepicker.full.js"></script> 


 
   

</html>
        
<?php
//}else{
 //header ('Location: index.php');
//}

?>
