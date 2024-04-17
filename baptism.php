    <?php
    session_start();
    //print_r($_REQUEST);

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
        <title>Baptismal</title>
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
            width: 20px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .form-container {
            max-height: 80vh;
            /* Adjust the height as needed */
            overflow: auto;
        }

        .main-content {
            overflow-y: auto;
            height: 100vh;
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
                            <span>BAPTISMAL</span>
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
                                        <div class="form-title">BAPTISMAL REQUEST FORM <img src="images/logo.png" alt="Company Logo" width="50" height="50" style="float: right;"> </div>
                                        <a href="client_dashboard.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back</a>

                                        <form method="post" action="php/insert_baptism.php" enctype="multipart/form-data">
                                            <div>
                                                <div class="row">
                                                    <h4><b>Child Information:</b></h4>
                                                    <div class="col-sm-4">
                                                        <label for="fullname">First Name:<span style="color:red"> *</span></label>
                                                        <input type="text" id="fullname" name="fullname" class="form-control" required placeholder="First Name of Child" />
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="fullname">Middle Name:<span style="color:red"> </span></label>
                                                        <input type="text" id="fullname" name="midlename" class="form-control" placeholder="Middle Name of Child" />
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="fullname">Last Name:<span style="color:red"> *</span></label>
                                                        <input type="text" id="fullname" name="lastname" class="form-control" required placeholder="Last Name of Child" />
                                                    </div>
                                                </div> <br>


                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label for="province">Date of Birth:<span style="color:red"> *</span></label>
                                                        <input type="text" name="date_of_birth" id="date_filter" class="form-control" placeholder="Date of Birth">
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label for="dateTime">Place of Birth:<span style="color:red"> *</span></label>
                                                        <input type="text" name="placeOB" placeholder="Place of Birth" class="form-control" />
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label for="province">Nationality:<span style="color:red"> *</span></label>
                                                        <input type="text" name="nationality" required placeholder="Nationality" class="form-control" />
                                                    </div>
                                                </div> <br>
                                                <hr style="border-top: 2px solid black;">


                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><b>Parents & Grandparents Information:</b></h4>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for="fatherFirstName">First Name:<span style="color:red"> *</span></label>
                                                    <input type="text" id="fatherFirstName" name="fatherFirstName" placeholder="Father's First Name" class="form-control" />
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="fatherMiddleName">Middle Name:<span style="color:red"> </span></label>
                                                    <input type="text" id="fatherMiddleName" name="fatherMiddleName" placeholder="Father's Middle Name" class="form-control" />
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="fatherLastName">Last Name:<span style="color:red"> *</span></label>
                                                    <input type="text" id="fatherLastName" name="fatherLastName" placeholder="Father's Last Name" class="form-control" />
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="fatherPlaceOfBirth">Place of Birth:<span style="color:red"> </span></label>
                                                    <input type="text" id="fatherPlaceOfBirth" name="fatherPlaceOfBirth" placeholder="Father's Place of Birth" class="form-control" />
                                                </div>
                                            </div> <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="residence">Residence:<span style='color:red'> *</span></label>
                                                    <input type="text" id="residence" name="residence_father" placeholder="Parent's Recidence" class="form-control" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="motherStatus">Civil Status:<span style="color:red"> *</span></label>
                                                    <select name="civil_status_father" class="form-control">
                                                        <option value="" disabled selected>Select Status</option>
                                                        <option value="single">Single</option>
                                                        <option value="married">Married</option>
                                                        <option value="divorced">Divorced</option>
                                                        <option value="widowed">Widowed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label for="motherFirstName">First Name:<span style="color:red"> *</span></label>
                                                    <input type="text" id="motherFirstName" name="motherFirstName" placeholder="Mother's First Name" class="form-control" />
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="motherMiddleName">Middle Name:<span style="color:red"> </span></label>
                                                    <input type="text" id="motherMiddleName" name="motherMiddleName" placeholder="Mother's Middle Name" class="form-control" />
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="motherLastName">Last Name:<span style="color:red"> *</span></label>
                                                    <input type="text" id="motherLastName" name="motherLastName" placeholder="Mother's Last Name" class="form-control" />
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="motherPlaceOfBirth">Place of Birth:<span style="color:red"> </span></label>
                                                    <input type="text" id="motherPlaceOfBirth" name="motherPlaceOfBirth" required placeholder="Mother's Place of Birth" class="form-control" />
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="residence">Residence:<span style='color:red'> *</span></label>
                                                    <input type="text" id="residence" name="residence" required placeholder="Parent's Recidence" class="form-control" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="motherStatus">Civil Status:<span style="color:red"> *</span></label>
                                                    <select name="civil_status" required class="form-control">
                                                        <option value="" disabled selected>Select Status</option>
                                                        <option value="single">Single</option>
                                                        <option value="married">Married</option>
                                                        <option value="divorced">Divorced</option>
                                                        <option value="widowed">Widowed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="paternal_gp">Paternal Grandparents:<span style="color:red"> *</span></label>
                                                    <input type="text" name="paternal_gp" id="paternal_gp" required placeholder="Father's Parents" class="form-control" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="maternal_gp">Maternal Grandparents:<span style="color:red"> *</span></label>
                                                    <input type="text" name="maternal_gp" id="maternal_gp" required placeholder="Mother's Parents" class="form-control" />
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="residence">Residence:<span style='color:red'> *</span></label>
                                                    <input type="text" name="recidence2" required placeholder="Grandparent's Residence" class="form-control" />
                                                </div>
                                            </div> <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="sponsors">Sponsors:<span style='color:red'> *</span></label>
                                                    <input class="form-control" name="sponsors" id="sponsors" placeholder="Sponsors (e.g., Godfather: Juan Dela Cruz)" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="sponsors">Sponsors:<span style='color:red'> *</span></label>
                                                    <input class="form-control" name="sponsors2" id="sponsors" placeholder="Sponsors (e.g., Godfather: Juan Dela Cruz)" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="sponsors">Sponsors:<span style='color:red'> </span></label>
                                                    <input class="form-control" name="sponsors3" id="sponsors" placeholder="Optional" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="sponsors">Sponsors:<span style='color:red'> </span></label>
                                                    <input class="form-control" name="sponsors4" id="sponsors" placeholder="Optional" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="sponsors">Sponsors:<span style='color:red'> </span></label>
                                                    <input class="form-control" name="sponsors5" id="sponsors" placeholder="Optional" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="sponsors">Sponsors:<span style='color:red'> </span></label>
                                                    <input class="form-control" name="sponsors6" id="sponsors" placeholder="Optional" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="sponsors">Sponsors:<span style='color:red'> </span></label>
                                                    <input class="form-control" name="sponsors7" id="sponsors" placeholder="Optional" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="sponsors">Sponsors:<span style='color:red'> </span></label>
                                                    <input class="form-control" name="sponsors8" id="sponsors" placeholder="Optional" />
                                                </div>
                                            </div>
                                            <br>
                                            <hr style="border-top: 2px solid black;">

                                            <div class="row">
                                                <h4><b>Schedule Information:</b></h4>
                                                <div class="col-sm-3">
                                                    <label for="municipality">Municipality:<span style="color:red"> *</span></label>
                                                    <input type="text" id="municipality" name="municipality" class="form-control" placeholder="Municipality of" value="Guagua" readonly />
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="province">Province:<span style="color:red"> *</span></label>
                                                    <input type="text" id="province" name="province" required placeholder="Province of" class="form-control" value="Pampanga" readonly />
                                                </div>

                                                <div class="col-sm-3">
                                                    <label for="dateTime">Date & Time:<span style="color:red"> *</span></label>
                                                    <input type="text" name="baptismDateTime" id="dateAndTime" required placeholder="Date & Time" value="<?php echo @$_REQUEST["formattedDate"] . ' ' . @$_REQUEST["dateTime"]; ?>" class="form-control" disabled>
                                                    <input type="hidden" name="baptismDateTime" id="dateAndTime" required placeholder="Date & Time" value="<?php echo @$_REQUEST["formattedDate"] . ' ' . @$_REQUEST["dateTime"]; ?>" class="form-control">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="location_baptism">Place of Baptism:<span style="color:red"> * </span></label><br>
                                                    <input type="text" id="location_baptism" name="location_baptism" required placeholder="Place of Baptism" class="form-control" value="238 Natividad Brgy. Guagua, I.F.I.P. " readonly />
                                                </div>

                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-sm-6 mb-3">
                                                    <label for="email" class="form-label">Email Address:<span style="color:red"> *</span></label>
                                                    <input type="email" id="email" name="email" required placeholder="Enter your email address" class="form-control">
                                                </div>

                                                <div class="col-sm-6 mb-3">
                                                    <label for="contact_no" class="form-label">Contact Number:<span style="color:red"> *</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">+63</span>
                                                        <input type="tel" id="contact_no" name="contact_no" required maxlength="10" placeholder="XXXXXXXXXX" pattern="^\d{10}$" class="form-control" required>
                                                    </div>
                                                </div>

                                            </div>
                                            <br>


                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="schedtype">Select Schedule Type:<span style="color:red"> *</span></label>
                                                    <select name="sched_type" id="event_type" class="form-control">
                                                        <option selected disabled hidden>Select Schedule Type</option>
                                                        <option>Regular</option>
                                                        <option>Fixed (Binyagang Bayan)</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="reserveby">Reserve by:<span style="color:red"> *</span></label>
                                                    <input type="text" name="reserve_by" required placeholder="Name of the person who reserved" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <select name="Status" id="" class="form-control" style="display:none">
                                                        <option>For Document Verification</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <hr style="border-top: 2px solid black;">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><b>Requirement For Baptismal:</b></h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="requirements"> Attached Birth Certificate:<span style="color:black"> <span style="color:red"> *</span></label>
                                                    <input type="file" class="form-control" placeholder="Upload Certificate" name="requirements" required />
                                                </div>
                                            </div>

                                            <hr style="border-top: 1px solid black;">

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
                        startDate: '-18y',
                        endDate: '1d',
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


            <script>
                document.getElementById('number').addEventListener('input', function() {
                    if (this.value.length > 11) {
                        this.value = this.value.slice(0, 10); // Limit input to 11 characters
                    }
                });
            </script>

    </html>
    </div>
    </div>

    </html>