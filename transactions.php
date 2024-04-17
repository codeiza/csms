<?php
session_start();
//print_r($_SESSION);

// echo "<script>alert('Success Fully Registered ')</script>";
//echo "<script>window.location.href='../baptism.php';</script>";
//exit;
require_once 'php/connection.php';
try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare(
        "SELECT * FROM schedule_list
	   WHERE
	   (Status = 'For Schedule' or Status = 'For Verification') and cancel_delete is null
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
    <title>Transactions</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.datetimepicker.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .form-box {
        border: 2px solid #ccc;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-left: 20px;
        /* Adjust the margin as needed */
    }

    .form-title {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: left;
        color: #333;
        position: relative;
        padding-bottom: 10px;

    }

    .form-title::before {
        content: '';
        position: absolute;
        width: 1208px;
        height: 4px;
        background-color: #007bff;
        /* Choose your desired color */
        bottom: 0;
        left: 0;
    }

    .form-title {
        font-size: 32px;
        font-family: 'Arial', sans-serif;
        /* Change the font-family here */
        font-weight: bold;
        margin-bottom: 20px;
        text-align: left;
        color: #333;
        position: relative;
        padding-bottom: 10px;
    }

    .btn-info.text-light:hover,
    .btn-info.text-light:focus {
        background: #000;
    }

    table,
    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
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
        overflow: hidden;
    }

    .dashboard-container {
        display: flex;
        flex-direction: row;
    }

    .sidebar {
        width: 290px;
    }

    .flashited {
        color: #f2f;
        -webkit-animation: flash linear 1s infinite;
        animation: flash linear 1s infinite;
    }

    @-webkit-keyframes flash {
        0% {
            opacity: 1;
        }

        50% {
            opacity: .1;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes flash {
        0% {
            opacity: 1;
        }

        50% {
            opacity: .1;
        }

        100% {
            opacity: 1;
        }
    }

    .short-btn {
        width: 20px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .form-container {
        max-height: 80vh;
        overflow: auto;
    }


    .baptism-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        border: 2px solid #AAACAA;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        margin-top: 20px;
        max-width: 400px;
        height: auto;
    }

    .baptism-content {
        display: flex;
        align-items: center;
    }

    .baptism-icon img {
        width: 100px;
        height: 100px;
        margin-bottom: 5px;
    }

    .baptism-label {
        font-size: 20px;
        margin-bottom: 0px;

    }

    .baptism-button {
        width: 115px;
        padding: 8px;
        color: black;
        border: 2px solid #525252;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
        cursor: pointer;
        margin-top: 70px;
        border-radius: 22px;
        background: white;
    }

    .baptism-wrapper {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .baptism-container {
        flex: 0 0 48%;
        text-align: center;
        margin-bottom: 20px;
    }

    .baptism-container.full {
        flex: 0 0 100%;
    }

    .baptism-label b {
        font-family: Arial, sans-serif;
        font-weight: 800;
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
                    <hr style="border-top: 2px solid black;">
                    <li>
                        <a href="client_dashboard.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Home</a>
                    </li>
                    <li>
                    <a href="services.php" class="dashboard-link"> <img src="image/services.png" alt="Services Logo" class="dashboard-img">Services</a>
                    </li>
                    <li>
                    <a href="request_docs.php" class="dashboard-link"> <img src="image/payments.png" alt="Docs Logo" class="dashboard-img">Documents</a>
                    </li>
                    </li>
                    <li>
                        <a href="transactions.php" class="dashboard-link"> <img src="image/transactions.png" alt="Docs Logo" class="dashboard-img">Transactions</a>
                    </li>
                    <li>
                        <a href="client_chatbot.php" class="dashboard-link"><img src="image/chatbot.png" alt="chatbot Logo" class="dashboard-img">Chatbot</a>
                    </li>
                </ul>
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
                </a>
            </div>
            <div class="main-content">
                <div class="top-bar">
                    <div class="profile">
                        <span>TRANSACTIONS</span>
                        <div>
                            <?php if (@$_SESSION["user"]["accountType"] == 'Admin' and $total > '0') { ?>
                                <span class="fa fa-bell noti" style="color:red"><sup style="color:red;" class="flashited"><?php echo $total; ?></sup></span>
                            <?php } else {
                            }
                            if (!isset($_SESSION['user'])) { ?>
                                <img src="picture_data/profile.png" alt="Profile Image">
                            <?php    } else {
                            ?>
                                <img src="picture_data/<?php echo $_SESSION["user"]["picture_data"]; ?>" alt="Profile Image" id="profile">
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="container py-5" id="page-container">

                <?php
                    if (!isset($_SESSION['user'])) { ?>
                        <h6 style="color:red"><b>Note:</b> You must log in to view and fill out this form.</h6>
                    <?php } else {
                    } ?>
                    <?php
                    if (isset($_SESSION['user'])) { ?>

                        <div class="container py-5" id="page-container">
                            <div class="col-sm-12">
                                <div class="form-box">
                                    <div class="form-title">TRANSACTIONS <img src="images/logo.png" alt="Company Logo" width="50" height="50" style="float: right;"> </div>
                                    <form method="post" action="php/insert_baptism.php" enctype="multipart/form-data">
                                        <div>
                                            <div class="row">

                                                <div class="baptism-wrapper">
                                                    <div class="baptism-container">
                                                        <div class="baptism-content">
                                                            <div class="baptism-icon">&nbsp;<img src="image/forpay.png" alt="Baptism Icon" style="width: 60px; height: 60px;"></div>
                                                            <div class="baptism-label"><b>&nbsp;&nbsp;&nbsp;&nbsp; For Pay</b></div>
                                                        </div>
                                                        <a href="forpay.php" class="baptism-button">View</a>
                                                    </div>

                                                    <div class="baptism-container">
                                                        <div class="baptism-content">
                                                            <div class="baptism-icon">&nbsp;<img src="image/status.png" alt="Funeral Icon" style="width: 60px; height: 60px;"></div>
                                                            <div class="baptism-label"><b>&nbsp;&nbsp;&nbsp;&nbsp;Schedule Status</b></div>
                                                        </div>
                                                        <a href="sched_status.php" class="baptism-button"> View</a>
                                                    </div>
                                                </div>

                                                <div class="baptism-container full">
                                                    <div class="baptism-content">
                                                        <div class="baptism-icon">&nbsp;<img src="image/heart.png" alt="Wedding Icon" style="width: 60px; height: 60px;"></div>
                                                        <div class="baptism-label"><b>&nbsp;&nbsp;&nbsp;&nbsp;Donations</b></div>
                                                    </div>
                                                    <a href="donation.php" class="baptism-button"> View</a>
                                                </div>

                                                <div class="baptism-wrapper">
                                                    <div class="baptism-container">
                                                        <div class="baptism-content">
                                                            <div class="baptism-icon">&nbsp;<img src="image/massoffer.png" alt="Mass Icon" style="width: 60px; height: 60px;"></div>
                                                            <div class="baptism-label"><b>&nbsp;&nbsp;&nbsp;&nbsp; Mass Offering</b></div>
                                                        </div>
                                                        <a href="mass_offering.php" class="baptism-button"> View</a>
                                                    </div>

                                                    <div class="baptism-container">
                                                        <div class="baptism-content">
                                                            <div class="baptism-icon">&nbsp;<img src="image/htransaction.png" alt="Blessing Icon" style="width: 60px; height: 60px;"></div>
                                                            <div class="baptism-label"><b>&nbsp;&nbsp;&nbsp;&nbsp; History of Transactions</b></div>
                                                        </div>
                                                        <a href="history.php" class="baptism-button">View</a>
                                                    </div>
                                                </div>



                                            <?php } else {
                                        } ?>
                                            </div>
                                    </form>
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

                                <script>
                                    $(document).ready(function() {
                                        $("#date_filter").datepicker({
                                            format: 'yyyy-mm-dd',
                                            //startDate: '-3m',
                                            autoclose: true
                                        })


                                        jQuery('#dateAndTime').datetimepicker({
                                            format: 'Y-m-d g:i A',
                                            step: 30,
                                            timepicker: true,
                                            minDate: new Date()
                                        });

                                        $("#dateAndTime, #event_type").on("change", function() {
                                            var selectedDateTime = $("#dateAndTime").val();
                                            var eventType = $("#event_type").val(); // Get the selected event type

                                            $.ajax({
                                                url: "php/fetch_available_schedules.php",
                                                method: "POST",
                                                data: {
                                                    selectedDateTime: selectedDateTime,
                                                    eventType: eventType
                                                }, // Pass eventType as a parameter
                                                success: function(data) {
                                                    $("#availableSchedules").html("Available Schedules: " + data);
                                                    var availableCount = parseInt(data);
                                                    toggleSubmitButton(availableCount > 0);
                                                },
                                                error: function() {
                                                    $("#availableSchedules").html("Error fetching available schedules.");
                                                    toggleSubmitButton(false);
                                                }
                                            });
                                        });
                                    })
                                </script>

                                <script src="./js/notification.js"></script>
                                <script src="./js/my_script.js"></script>
                                <script src="js/jquery.min.js"></script>
                                <script src="js/bootstrap-datepicker.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
                                <script src="js/jquery.datetimepicker.full.js"></script>




</html>
</div>
</div>

</html>