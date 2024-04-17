<?php
$current_page = basename($_SERVER['PHP_SELF']); ?>

    <ul>
        <hr style="border-top: 2px solid black;">
        <li>
            <a href="schedule.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Home</a>
        </li>
        <li>
            <a href="message.php" class="dashboard-link"> <img src="image/chatbot.png" alt="Notify Logo" class="dashboard-img">Message</a>
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
