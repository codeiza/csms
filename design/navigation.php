<?php
$current_page = basename($_SERVER['PHP_SELF']); ?>
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
</div>
            <ul>
            <hr style="border-top: 2px solid black;">
                <?php if (@$_SESSION["user"]["accountType"] == 'Admin') { ?>
                <li>
                    <a href="summary.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Dashboard</a>
                </li>
				<?php }elseif(@$_SESSION["user"]["accountType"] == 'Priest'){ ?>
				 <li>
                    <a href="Schedule.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Home</a>
                </li>
				<?php } else { ?>
				<li>
                    <a href="client_dash_board.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Home</a>
                </li>
				<?php } 
               if (@$_SESSION["user"]["accountType"] == 'Admin') { ?>
                <li>
                    <a href="user.php" class="dashboard-link"><img src="image/user.png" alt="user Forms Logo" class="dashboard-img">Manage Users</a>
                </li>
                <li>
                     <a href="schedule.php" class="dashboard-link"> <img src="image/reservation.png" alt="Notify Logo" class="dashboard-img">Event Schedule</a>
                </li>
				<li>
                      <a href="document.php" class="dashboard-link"> <img src="image/request.png" alt="request Logo" class="dashboard-img">Request Documents<sup style="color:red; font-weight:bold" class="flashited"> New <?php echo $totaldoc; ?></sup></a>
                </li>
				<li>
                     <a href="certificate.php" class="dashboard-link"> <img src="image/certificate.png" alt="Notify Logo" class="dashboard-img">Certificate</a>
                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-btn">
                    <img src="image/transactions.png" alt="Transactions Logo" class="dropdown-img">Transactions</a>
                    <div class="dropdown-content">
                        <a href="donation.php"> <img src="image/heart.png" class="dropdown-img">Donation</a>
                         <a href="mass_ofering.php"><img src="image/massoffer.png" alt="Transactions Logo" class="dropdown-img">Mass Offerings</a>
						<a href="history.php"><img src="image/htransaction.png" alt="Transactions Logo" class="dropdown-img">History Transaction</a>
                    </div>
                </li>
                <li>
                     <a href="message.php" class="dashboard-link"> <img src="image/chatbot.png" alt="Notify Logo" class="dashboard-img">Chatbot</a>
                </li>
          <?php }  ?>
       
           
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
   
        </div>