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
	   (Status = 'For Schedule' or Status = 'For Verification') and cancel_delete is null
	   "
	   );
	 $stmt->execute();
	 $total = $stmt->rowCount();
	 $stmt = $pdo->prepare(
	   "SELECT * FROM schedule_list
	   WHERE
	   Status = 'Confirm' and cancel_delete is null
	   and
	   start_datetime > '".date('Y-m-d')."%'
	   "
	   );
	 $stmt->execute();
	 $total_p = $stmt->rowCount();
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
   if($_SESSION["user"]["accountType"] == 'Admin' || $_SESSION["user"]["accountType"] == 'Priest' || $_SESSION["user"]["accountType"] == 'Parishioner'){
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
    <title>I.F.I</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
	<link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
	<script src="./fullcalendar/lib/main.min.js"></script>
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
    </style>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="company-logo">
                 <img src="image/logo.png" alt="Company Logo">
            </div>
             <center>
		<h5>Welcome: 
		<?php 
		if (isset($_SESSION["user"]["firstName"])) {
			echo $_SESSION["user"]["firstName"];
		} else {
			echo "Guest"; // or any other default message you want
		}
		?>
		</h5>
	 </center>
            <ul>
                <hr>
                <?php if (@$_SESSION["user"]["accountType"] == 'Admin') { ?>
                <li>
                    <a href="summary.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Dashboard</a>
                </li>
				<?php }elseif(@$_SESSION["user"]["accountType"] == 'Priest' || $_SESSION["user"]["accountType"] == 'Parishioner'){ ?>
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
					<a href="user.php" class="dashboard-link"><img src="image/user.png" alt="user Forms Logo" class="dashboard-img">User Monitoring</a>
				</li>
				<li>
                     <a href="Schedule.php" class="dashboard-link"> <img src="image/reservation.png" alt="Notify Logo" class="dashboard-img">Event Schedule</a>
                </li>
				<li>
                     <a href="message.php" class="dashboard-link"> <img src="image/massage.png" alt="Notify Logo" class="dashboard-img">Message</a>
                </li>
				<li>
                     <a href="document.php" class="dashboard-link"> <img src="image/request.png" alt="request Logo" class="dashboard-img">Request Document<sup style="color:red; font-weight:bold" class="flashited"> New <?php echo $totaldoc; ?></sup></a>
                </li>
				<li>
                     <a href="certificate.php" class="dashboard-link"> <img src="image/certificate.png" alt="Notify Logo" class="dashboard-img">Certificate</a>
                </li>
				<?php }elseif(@$_SESSION["user"]["accountType"] == 'Priest' || @$_SESSION["user"]["accountType"] == 'Admin'){ ?>
				<li>
                     <a href="message.php" class="dashboard-link"> <img src="image/massage.png" alt="Notify Logo" class="dashboard-img">Message</a>
                </li>
				<li>
                     <a href="Schedule.php" class="dashboard-link"> <img src="image/reservation.png" alt="Notify Logo" class="dashboard-img">Event Schedule</a>
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
                <li class="dropdown">
                <a href="#" class="dropdown-btn">
                    <img src="image/transactions.png" alt="Transactions Logo" class="dropdown-img">Transactions</a>
                    <div class="dropdown-content">
                        <a href="donation.php"> <img src="image/donations.png" class="dropdown-img">Add Your Donation</a>
                         <a href="mass_ofering.php"><img src="image/offering.png" alt="Transactions Logo" class="dropdown-img">Mass Offerings</a>
                        <a href="reqest_document.php"><img src="image/payments.png" alt="Transactions Logo" class="dropdown-img">Documents Request</a>
						<a href="history.php"><img src="image/payments.png" alt="Transactions Logo" class="dropdown-img">History Transaction</a>
                    </div>
                </li>
            </ul>
            <button class="logout-button" onclick="window.location.href='logout.php'">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
    </a>
        </div>
        <div class="main-content">
            <div class="top-bar">
                <div class="profile">
                    <span>Welcome, Admin!</span>
					<div >
					
					 <?php if (@$_SESSION["user"]["accountType"] == 'Admin' and $total > '0') { ?>
					<span class="fa fa-bell noti" style="color:red"><sup style="color:red;" class="flashited"><?php echo $total; ?></sup></span>
					<?php }else if ((@$_SESSION["user"]["accountType"] == 'Priest' or @$_SESSION["user"]["accountType"] == 'Parishioner') and $total_p > '0') { ?>
					<span class="fa fa-bell priest_noti" style="color:red"><sup style="color:red;" class="flashited"><?php echo $total_p; ?></sup></span>
					<?php }else{
					} 
					if(!isset($_SESSION['user'])){ ?>
					<img src="image/profile.png" alt="Profile Image">
				<?php	}else{
					?>
                    <img src="image/<?php echo $_SESSION["user"]["picture_data"]; ?>" alt="Profile Image" id="profile">
					<?php } ?>
					</div>
                </div>
            </div>
            <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-12">
                <div id="calendar"></div>
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

<?php
}else{
header ('Location: index.php');
}
try {
   
    $pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM `schedule_list` WHERE Status = 'Confirm'");
    
    // Fetch the results into an associative array
    $sched_res = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
        $sched_res[$row['id']] = $row;
    }
} catch (PDOException $e) {
    // Handle any exceptions or errors here
    echo "Error: " . $e->getMessage();
} finally {
    // Close the PDO connection
    $pdo = null;
}
?>

</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
	
</script>
<script src="./js/script.js"></script>
<script src="./js/notification.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>

    

</html>
        </div>
    </div>
</body>
</html>
