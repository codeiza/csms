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
if ($_SESSION["user"]["accountType"] == 'Admin') {
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
        <title>Dashboard</title>
        <!--   <link rel="stylesheet" href="./css/main.css"> --->
        <link rel="stylesheet" href="./css/my_style.css">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/jquery.datetimepicker.css">
        <script src="./js/jquery-3.6.0.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="chart/code/highcharts.js"></script>
        <script src="chart/code/modules/data.js"></script>
        <script src="chart/code/modules/drilldown.js"></script>


    </head>
    <style>
        body {
            font-family: Arial, sans-serif;
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
                        echo '<p style="color: yellow; font-size: 12px; font-family: Helvetica, sans-serif;">You are logged in as a ' . $_SESSION["user"]["accountType"] . '</p>';
                    } else {
                        echo '<h2>Welcome Guest!</h2>'; // or any other default message you want
                    }
                    ?>
                </div>
                <?php require_once 'sidebar/admin_navigation.php'; ?>

                <div class="main-content">
                    <div class="top-bar">
                        <div class="profile">
                            <span>Dashboard</span>
                            <div>
                                <span class="fa fa-bell noti" style="color:red">
                                    <?php if (@$_SESSION["user"]["accountType"] == 'Admin' and $total > '0') { ?>
                                        <sup style="color:red;" class="flashited"><?php
                                                                                    echo $total; ?></sup></span>
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
                    <div class="row">
                        <div class="col-sm-3">
                            <label><i class="fas fa-calendar-alt"></i> Start Date:</label>
                            <input type="text" value="<?php echo date('Y-m-d') ?>" id="datefrom" class="form-control" />
                        </div>
                        <div class="col-sm-3">
                            <label><i class="fas fa-calendar-alt"></i> End Date:</label>
                            <input type="text" value="<?php echo date('Y-m-d') ?>" id="dateto" class="form-control" />
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" value="500" id="perpage" />
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
                        <div id="summary"></div>

                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $("#datefrom,#dateto").datepicker({
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

                <script src="./js/notification.js"></script>
                <script src="./js/summary.js"></script>
                <script src="js/jquery.min.js"></script>
                <script src="js/bootstrap-datepicker.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
                <script src="js/jquery.datetimepicker.full.js"></script>





    </html>

<?php
} else {
    header('Location: index.php');
}

?>