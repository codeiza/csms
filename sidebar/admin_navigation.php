<?php
$current_page = basename($_SERVER['PHP_SELF']); ?>

<ul>
    <hr style="border-top: 2px solid black;">
    <li>
        <a href="summary.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Dashboard</a>
    </li>
    <li>
        <a href="user.php" class="dashboard-link"><img src="image/user.png" alt="user Forms Logo" class="dashboard-img">Manage Users</a>
    </li>
    <li>
        <a href="admin_schedule.php" class="dashboard-link"> <img src="image/reservation.png" alt="Notify Logo" class="dashboard-img">Event Schedule</a>
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
            <a href="admin_donation.php"> <img src="image/heart.png" class="dropdown-img">Donation</a>
            <a href="admin_massofferring.php"><img src="image/massoffer.png" alt="Transactions Logo" class="dropdown-img">Mass Offerings</a>
            <a href="admin_history.php"><img src="image/htransaction.png" alt="Transactions Logo" class="dropdown-img">History Transaction</a>
        </div>
    </li>
    <li>
        <a href="admin_message.php" class="dashboard-link"> <img src="image/chatbot.png" alt="Notify Logo" class="dashboard-img">Message</a>
    </li>



</ul>
<?php
if (isset($_SESSION['user'])) { ?>
    <button class="logout-button" onclick="window.location.href='logout.php'">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
<?php } else { ?>
    <button class="logout-button" style="background-color:green" onclick="window.location.href='login.php'">
        <i class="fas fa-sign-in-alt"></i> Login
    </button>
<?php } ?>

</div>