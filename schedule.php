<?php
session_start();
//print_r($_SESSION);
require_once 'php/connection.php';
try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare(
        "SELECT * FROM schedule_list
		   WHERE
		   (Status = 'For Schedule' or Status = 'For Verification' or Status = 'For Reserve' or Status = 'For Document Verification')and confirm_priest is not null and cancel_delete is null
		   "
    );
    $stmt->execute();
    $total = $stmt->rowCount();
    $stmt = $pdo->prepare(
        "SELECT * FROM schedule_list
	   WHERE
	   (Status = 'Confirm_docs' or Status = 'Confirm' or Status = 'For Document Verification')and confirm_priest is null and cancel_delete is null
	   and
	   start_datetime > '" . date('Y-m-d') . "%'
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
//  echo $total_p;
$pdo = null;
if ($_SESSION["user"]["accountType"] == 'Admin' || $_SESSION["user"]["accountType"] == 'Priest' || $_SESSION["user"]["accountType"] == 'Parishioner') {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" type="text/css" href="css/styless.css">
        <link rel="stylesheet" type="text/css" href="css/my_style.css">
        <link rel="icon" href="images/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Event Schedule</title>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
        <script src="./fullcalendar/lib/main.min.js"></script>
        <script src="./js/jquery-3.6.0.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>


    </head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .profile-icons {
            display: flex;
            align-items: center;
        }

        .fa-bell,
        #profile {
            margin-right: 10px;
            /* Adjust the margin as needed */
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
            /* Hide scrollbars */
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
    </style>

    <body>
        <div class="dashboard-container">
            <div class="sidebar">
                <div class="company-logo">
                    <img src="images/logo.png" alt="Company Logo">
                </div>
                <div style="text-align: center;">
                    <?php
                    if (isset($_SESSION["user"]["firstName"])) {
                        echo '<h2 style="font-family: Helvetica, sans-serif;">Welcome ' . $_SESSION["user"]["firstName"] . '!</h2>';
                        if ($_SESSION["user"]["accountType"] == 'Priest') {
                            echo '<p style="color: yellow; font-size: 12px; font-family: Helvetica, sans-serif;">You are logged in as a Secretary  </p>';
                        } else {
                            echo '<p style="color: yellow; font-size: 12px; font-family: Helvetica, sans-serif;">You are logged in as a ' . $_SESSION["user"]["accountType"] . '  </p>';
                        }
                    } else {
                        echo '<h2>Welcome Guest!</h2>'; // or any other default message you want
                    }
                    ?>
                </div>
                <?php require_once 'sec_sidebar/sec_navigation.php'; ?>

                <div class="main-content">
                    <div class="top-bar">
                        <div class="profile">
                            <span>Calendar</span>
                            <div>

                                <span class="fa fa-bell priest_noti" style="color:red">
                                    <?php if (@$_SESSION["user"]["accountType"] == 'Admin' and $total > '0') { ?>
                                        <sup style="color:red;" class="flashited"><?php
                                                                                    echo $total; ?></sup></span>
                            <?php } else if ((@$_SESSION["user"]["accountType"] == 'Priest' or @$_SESSION["user"]["accountType"] == 'Parishioner') and $total_p > '0') { ?>
                                <span style="color:red"><sup style="color:red;" class="flashited"><?php echo $total_p; ?></sup></span>
                            <?php } else {
                                    }
                                    if (!isset($_SESSION['user'])) { ?>
                                <img src="picture_data/profile.png" alt="Profile" id="profile">
                            <?php    } else {
                            ?>
                                <img src="picture_data/<?php echo $_SESSION["user"]["picture_data"]; ?>" alt="Profile" id="profile">
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="container py-5" id="page-container">
                        <?php if (@$_SESSION["user"]["accountType"] == 'Admin') { ?>
                            <div class="col-sm-2 mb-3">
                                <button type="button" class="btn btn-md btn-danger" id="sched">
                                    <i class="fas fa-calendar-alt mr-1"></i> Manage Schedule
                                </button>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal -->
                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl text-center">
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
        } else {
            header('Location: index.php');
        }
        try {

            $pdo = new PDO(DSN, DB_USR, DB_PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    <script>
        $(document).ready(function() {
            $(document).on('click', '#sched', function() {
                $(".modal-title").html('Setting of schedule')
                $(".modal-body-1").load('php/setting_sched.php')
                $("#confirmModal").modal('show')
            })
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var bellIcon = document.querySelector('.fa-bell');
            var profileImage = document.querySelector('#profile');

            bellIcon.addEventListener('click', function() {
                // Show notifications or perform related action
                console.log('Bell icon clicked. Show notifications or perform related action.');
            });

            profileImage.addEventListener('click', function() {
                // Show user profile or perform related action
                console.log('Profile image clicked. Show user profile or perform related action.');
            });
        });
    </script>

    </html>
    </div>
    </div>
    </body>

    </html>