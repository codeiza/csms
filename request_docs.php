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
    <title>Document Request</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.datetimepicker.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">



</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .form-section {
        display: none;
    }

    .form-section.active {
        display: block;
    }

    .row button {
        width: 100px;
        /* Set the width to the desired value */
        padding: 10px 15px;
        font-size: 14px;
        margin-right: 10px;
        font-family: 'Montserrat', sans-serif;

    }

    .row {
        display: flex;
        justify-content: center;
    }

    .row button {
        width: 100px;
        padding: 10px 15px;
        font-size: 14px;
        margin-right: 10px;
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

    .short-btn {
        width: 30px;
        /* Adjust the width as needed */
        white-space: nowrap;
        /* Prevent text wrapping */
        overflow: hidden;
        /* Hide overflowed content */
        text-overflow: ellipsis;
        /* Display an ellipsis (...) when text overflows */
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

    #availableSchedules {
        color: red;
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

    .main-content {
        overflow-y: auto;
        height: 100vh;
    }

    a {
        text-decoration: none;
        display: inline-block;
        padding: 8px 16px;
    }

    a:hover {
        background-color: #ddd;
        color: black;
    }

    .previous {
        background-color: #f1f1f1;
        color: black;
    }

    .next {
        background-color: #04AA6D;
        color: white;
    }

    .round {
        border-radius: 50%;
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
                        <span>DOCUMENT REQUEST</span>
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
                                    <div class="form-title">REQUEST FORM FOR ANY DOCUMENTS <img src="image/logo.png" alt="Company Logo" width="50" height="50" style="float: right;"></div> <br>
                                    <form method="post" action="php/insert_request.php" enctype="multipart/form-data">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="docType">Document Type:<span style='color:red'> *</span></label>
                                                <select class="form-control" name="document_type" id="docType" required>
                                                    <option value="" disabled selected>Select Document Type</option>
                                                    <option>Confirmation</option>
                                                    <option>Baptismal</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="searchkey">Document Owner:<span style='color:red'> *</span></label>
                                                <input type="text" name="document_owner" class="form-control" placeholder="(ex. Juan Cruz)" id="searchkey" required />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="requested_by">Full Name:<span style='color:red'> *</span></label>
                                                <input type="text" name="requested_by" class="form-control" placeholder="Name of Requestor (ex. Max A. Collins)" required />
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="relation_to_owner">Relationship: <span style='color:red'></span></label>
                                                <input type="text" name="relation_to_owner" class="form-control" placeholder="Relation to the Owner" required />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="mobileNumber">Phone Number:<span style='color:red'> *</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">+63</span>
                                                    <input type="tel" id="mobileNumber" name="contact_no" placeholder="XXXXXXXXXX" pattern="^\d{10}$" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="email_add">Email Address:<span style='color:red'> *</span></label>
                                                <input type="email" name="email_add" class="form-control" placeholder="Email Address" required />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="supporting_docs">Verification:<span style='color:red'> *</span></label>
                                                <input type="file" name="supporting_docs" required class="form-control" />
                                                <div style="color: red; margin-top: 5px;">
                                                    <span><i class="fas fa-exclamation-circle"></i> Supporting Documentation Required (ID or Authorization Letter)</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="purpose">Purpose:</label>
                                                <textarea class="form-control" name="purpose"></textarea>
                                            </div>
                                        </div>

                                        <BR>
                                        <div class="row">
                                            <button type="submit" class="btn btn-sm btn-success">SUBMIT</button>
                                        </div>
                                </div>
                                <br>


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


<script src="./js/notification.js"></script>
<script src="./js/my_script.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="js/jquery.datetimepicker.full.js"></script>





</html>