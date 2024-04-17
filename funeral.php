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
        <title>Funeral</title>
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

        .short-btn {
            width: 15px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .custom-button {
            background-color: #8BECEC;
            color: black;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-weight: 800;
        }

        .main-content {
            overflow-y: auto;
            height: 100vh;
        }

        .custom-button:hover {
            background-color: #45a049;
            /* Darker green background color on hover */
        }
    </style>

    <body>
        <div class="main-container">
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
                            <span>FUNERAL</span>
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
                                        <div class="form-title">FUNERAL REQUEST FORM <img src="image/logo.png" alt="Company Logo" width="50" height="50" style="float: right;"> </div>
                                        <a href="client_dashboard.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back</a>
                                        <form method="post" action="php/insert_funeral.php" enctype="multipart/form-data">
                                            <div>
                                                <div class="row">
                                                    <h4><b>Deceased Information:</b></h4>
                                                    <div class="col-sm-6">
                                                        <label for="fullname">Full Name:<span style="color:red"> *</span></label>
                                                        <input type="text" name="fullname" class="form-control" required placeholder="Full Name" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="fullname">Age:<span style="color:red"> *</span></label>
                                                        <input type="text" name="age" class="form-control" required placeholder="Age" maxlength="2" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2);" />
                                                    </div>


                                                </div> <br>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="fullname">Date of Death:<span style="color:red"> *</span></label>
                                                        <input type="text" id="date_filter" name="date_of_death" class="form-control" required placeholder="Date of Death" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="fullname">Funeral Date:<span style="color:red"> *</span></label>
                                                        <input type="text" id="dateAndTime" name="start_datetime_event" required placeholder="Funeral Date & Time" value="<?php echo @$_REQUEST["formattedDate"] . ' ' . @$_REQUEST["dateTime"]; ?>" class="form-control" disabled />
                                                        <input type="hidden" id="dateAndTime" name="start_datetime_event" required placeholder="Funeral Date & Time" value="<?php echo @$_REQUEST["formattedDate"] . ' ' . @$_REQUEST["dateTime"]; ?>" class="form-control" />
                                                    </div>

                                                </div> <br>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label for="location">Location of Funeral:<span style='color:red'> *</span></label>
                                                        <input type="text" name="event_location" required placeholder="Location (Complete Address)" class="form-control" />
                                                    </div>
                                                </div> <br>
                                                <hr style="border-top: 2px solid black;">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <h4><b>Reserver Requirements:</b></h4>
                                                        <div class="col-sm-6">
                                                            <label for="fullname">Full Name:<span style="color:red"> *</span></label>
                                                            <input type="text" name="reserve_by" required placeholder="Full name of the Reserver" class="form-control" />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="email">Email Address:<span style="color:red"> *</span></label>
                                                            <input type="text" name="email" required placeholder="Email address of the Reserver" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>


                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label for="contact_no" class="form-label">Contact Number:<span style="color:red"> *</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">+63</span>
                                                                <input type="tel" id="mobileNumber" name="contact_no" required maxlength="10" placeholder="XXXXXXXXX" pattern="^\d{10}$" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="death_certificate" class="form-label" style="color: red;">Attached Death Certificate:<span style="color:black"> (Required)<span style="color:red"> *</span></label><br>
                                                            <input type="file" accept=".pdf,.png, .jpg,.jpeg" class="form-control" name="death_certificate" required />
                                                        </div>


                                                    </div>
                                                </div>



                                                <br>
                                                <div class="d-flex justify-content-end mt-4">
                                                    <button type="submit" class="btn btn-lg custom-button">Submit</button>
                                                </div>


                                        </form>
                                    </div>
                                </div>
                            </div>

                    </div>
                <?php } else {
                        } ?>
                </div>
                </form>


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
    <script>
        $(document).ready(function() {
            $("#date_filter").datepicker({
                format: 'yyyy-mm-dd',
                startDate: '-3m',
                endDate: '-0d',
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
    <script>
        document.getElementById('number').addEventListener('input', function() {
            if (this.value.length > 11) {
                this.value = this.value.slice(0, 10); // Limit input to 11 characters
            }
        });
    </script>

    <script src="./js/my_script.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="js/jquery.datetimepicker.full.js"></script>





    </html>