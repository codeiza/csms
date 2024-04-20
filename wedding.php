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
    <title>Wedding</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.datetimepicker.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">



</head>
<style>
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

body {
    font-family: Arial, sans-serif;
}


.requirement {
    margin-bottom: 15px;
}

.requirement label {
    display: block;
    margin-bottom: 5px;
}

.requirement input[type="file"] {
    width: calc(30% - 20px);
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Style for the required asterisk */
.requirement span {
    color: red;
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
                        <a href="client_dashboard.php" class="dashboard-link"> <img src="image/dashboard.png"
                                alt="Dashboard Logo" class="dashboard-img">Home</a>
                    </li>
                    <li>
                        <a href="services.php" class="dashboard-link"> <img src="image/services.png" alt="Services Logo"
                                class="dashboard-img">Services</a>
                    </li>
                    <li>
                        <a href="request_docs.php" class="dashboard-link"> <img src="image/payments.png" alt="Docs Logo"
                                class="dashboard-img">Documents</a>
                    </li>
                    </li>
                    <li>
                        <a href="transactions.php" class="dashboard-link"> <img src="image/transactions.png"
                                alt="Docs Logo" class="dashboard-img">Transactions</a>
                    </li>

                    <li>
                        <a href="client_chatbot.php" class="dashboard-link"><img src="image/chatbot.png"
                                alt="chatbot Logo" class="dashboard-img">Chatbot</a>
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
                        <span>WEDDING</span>
                        <div>
                            <?php if (@$_SESSION["user"]["accountType"] == 'Admin' and $total > '0') { ?>
                            <span class="fa fa-bell noti" style="color:red"><sup style="color:red;"
                                    class="flashited"><?php echo $total; ?></sup></span>
                            <?php } else {
                            }
                            if (!isset($_SESSION['user'])) { ?>
                            <img src="picture_data/profile.png" alt="Profile Image">
                            <?php    } else {
                            ?>
                            <img src="picture_data/<?php echo $_SESSION["user"]["picture_data"]; ?>" alt="Profile Image"
                                id="profile">
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
                                <div class="form-title">WEDDING REQUEST FORM <img src="images/logo.png"
                                        alt="Company Logo" width="50" height="50" style="float: right;"></div>
                                <a href="client_dashboard.php" class="btn btn-secondary mb-3"><i
                                        class="fas fa-arrow-left"></i> Back</a>
                                <form method="post" action="php/insert_wedding.php" enctype="multipart/form-data">
                                    <!-- Section 1: Update Section 1 content as needed -->
                                    <div class="form-section active" id="section-1">
                                        <h4>Section 1: Personal Details</h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h6>Municipality:</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6>Province:</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="wedding_province" required
                                                    placeholder="Province" value="Guagua" readonly />
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="wedding_municipality" required
                                                    placeholder="Municipality" class="form-control" value="Pampanga"
                                                    readonly />
                                            </div>

                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h6><b>Husband Information:</b></h6>
                                                <hr style="height: 1px; border: none; background-color: #333;">
                                            </div>
                                            <div class="col-sm-6">
                                                <h6><b>Wife Information:</b></h6>
                                                <hr style="height: 1px; border: none; background-color: #333;">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Full Name:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_husband_name" required
                                                    placeholder="(ex. Juan D. Cruz)" class="form-control" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Full Name:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_wife_name" required
                                                    placeholder="(ex. Anne C. Torres)" class="form-control" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Date of Birth:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_husband_dob" required
                                                    placeholder="Date of Birth" id="pinaganako"
                                                    class="form-control pinaganak" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Date of Birth:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_wife_dob" required
                                                    placeholder="Date of Birth" id="pinaganakosay"
                                                    class="form-control pinaganak" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Place of Birth:<span style='color:red'> *</span></label>
                                                <input type="text" class="form-control" name="wedding_husband_pob"
                                                    required placeholder="Place of Birth" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Place of Birth:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_wife_pob" required
                                                    placeholder="Place of Birth" class="form-control" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Citizenship:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_husband_citizenship" required
                                                    placeholder="(ex. Filipino)" class="form-control" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Citizenship:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_wife_citizenship" required
                                                    placeholder="(ex. Filipino)" class="form-control" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Gender:<span style='color:red'> *</span></label>
                                                <select name="wedding_husband_sex" required class="form-control">
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Gender:<span style='color:red'> *</span></label>
                                                <select class="form-control" name="wedding_wife_sex" required>
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Residence:<span style='color:red'> *</span></label>
                                                <input type="text" class="form-control" name="wedding_husband_residence"
                                                    required placeholder="Residence" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Residence:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_wife_residence" required
                                                    placeholder="Residence" class="form-control" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Religion:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_husband_religion" required
                                                    placeholder="(ex. Catholic)" class="form-control" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Religion:<span style='color:red'> *</span></label>
                                                <input type="text" class="form-control" name="wedding_wife_religion"
                                                    required placeholder="(ex. Catholic)" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Civil Status:<span style='color:red'> *</span></label>
                                                <select name="wedding_husband_civistatus" required class="form-control">
                                                    <option value="">Select Civil Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Separated">Separated</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Civil Status:<span style='color:red'> *</span></label>
                                                <select name="wedding_wife_civistatus" required class="form-control">
                                                    <option value="">Select Civil Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Separated">Separated</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Section 2: Parents Details -->
                                    <div class="form-section" id="section-2">
                                        <h4>Section 2: Parents Details</h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h6>Husband Parent Information:</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6>Wife Parent Information:</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Full Name:<span style='color:red'> *</span></label>
                                                <input type="text" class="form-control"
                                                    name="wedding_husband_name_father" required
                                                    placeholder="(ex. Jose A. Cruz)" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Full Name:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_wife_name_mother" required
                                                    placeholder="(ex. Lita S. Cruz)" class="form-control" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Citizenship:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_husband_citizenship_parent" required
                                                    placeholder="(ex.Filipino)" class="form-control" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Citizenship:<span style='color:red'> *</span></label>
                                                <input type="text" class="form-control"
                                                    name="wedding_wife_citizenship_parent" required
                                                    placeholder="(ex. Filipino)" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Full Name:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_husband_name_father" required
                                                    placeholder="(ex. Lito A. Aguinaldo)" class="form-control" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Full Name:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_wife_name_mother" required
                                                    placeholder="(ex. Susan B. Aguinaldo)" class="form-control" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Citizenship:<span style='color:red'> *</span></label>
                                                <input type="text" class="form-control"
                                                    name="wedding_wife_citizenship_parents" required
                                                    placeholder="(ex. Filipino)" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Citizenship:<span style='color:red'> *</span></label>
                                                <input type="text" name="wedding_husband_citizenship_parents" required
                                                    placeholder="(ex. Filipino)" class="form-control" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Witness:<span style='color:red'> *</span></label>
                                                <input type="text" name="peroson_gave_consent" required
                                                    placeholder="Person who gave consent" class="form-control" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Witness:<span style='color:red'> *</span></label>
                                                <input type="text" class="form-control" name="peroson_gave_consent_wife"
                                                    required placeholder="Person who gave consent" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Relationship:<span style='color:red'> *</span></label>
                                                <input type="text" name="concent_relation_hus" required
                                                    placeholder="Relationship" class="form-control" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Relationship:<span style='color:red'> *</span></label>
                                                <input type="text" class="form-control" name="concent_relation_wife"
                                                    required placeholder="Relationship" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Recidence:<span style='color:red'> *</span></label>
                                                <input type="text" name="residence_wife_side" required
                                                    placeholder="Residence" class="form-control" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Recidence:<span style='color:red'> *</span></label>
                                                <input type="text" class="form-control" name="residence_husband_side"
                                                    required placeholder="Residence" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 3 -->
                                    <div class="form-section">
                                        <h4>Section 3: Requirements Needed</h4>
                                        <div class="requirement">
                                            <label for="baptismalCertificate">Baptismal Certificate<span
                                                    style='color:red'> *</span></label>
                                            <input type="file" id="baptismalCertificate" name="Baptismalcert"
                                                class="form-control-file" required />
                                        </div>
                                        <div class="requirement">
                                            <label for="confirmationCertificate">Confirmation Certificate<span
                                                    style='color:red'>*</span></label>
                                            <input type="file" id="confirmationCertificate" name="CCertificate"
                                                class="form-control-file" required />
                                        </div>
                                        <div class="requirement">
                                            <label for="birthCertificate">Birth Certificate<span style='color:red'>
                                                    *</span></label>
                                            <input type="file" id="birthCertificate" name="Bcertificate"
                                                class="form-control-file" required />
                                        </div>
                                        <div class="requirement">
                                            <label for="cenomar">Certificate of No Marriage (CENOMAR)<span
                                                    style='color:red'> *</span></label>
                                            <input type="file" id="cenomar" name="cenomar" class="form-control-file"
                                                required />
                                        </div>
                                    </div>

                                    <!-- Section 4 -->
                                    <div class="form-section">
                                        <h4>Section 4: Schedule Information</h4>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="birthCertificate">Reserver: <span style='color:red'>
                                                        *</span></label>
                                                <input type="text" name="reserve_by" required
                                                    placeholder="Reserve by (ex. Juan Cruz)" class="form-control" />
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="birthCertificate">Email Address <span
                                                        style='color:red'>*</span></label>
                                                <input type="text" name="email" required
                                                    placeholder="(ex. juan@gmail.com" class="form-control" />
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">

                                            <div class="col-sm-6">
                                                <label for="birthCertificate">Phone Number: <span style='color:red'>
                                                        *</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">+63</span>
                                                    <input type="tel" id="mobileNumber" name="contact_no" required
                                                        maxlength="10" placeholder="XXXXXXXXXX" pattern="^\d{10}$"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="birthCertificate">Number of Guests: <span style='color:red'>
                                                        *</span></label>
                                                <input type="number" name="number_of_guest" required
                                                    placeholder="Number of guests expected" class="form-control"
                                                    required />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Confession Schedule for Husband:<span style='color:red'>
                                                        *</span></label>
                                                <input type="text" name="confesion_sched" id="dateAndTime_hus" required
                                                    placeholder="Select Schedule" class="form-control" required />
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Confession Schedule for Wife:<span style='color:red'>
                                                        *</span></label>
                                                <input type="text" name="confesion_sched" id="dateAndTime_wife" required
                                                    placeholder="Select Schedule" class="form-control" required />
                                            </div>
                                            <div class="col-sm-6 offset-sm-0 text-center" style="color: red;">
                                                <span><i class="fas fa-exclamation-circle"></i> Note: Schedule these
                                                    confessions at least one week before the wedding.</span>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Venue:<span style='color:red'> *</span></label>
                                                <input type="text" name="place_of_merriage" required
                                                    placeholder="Place of the Marriage" class="form-control" required />
                                            </div>

                                            <div class="col-sm-3">
                                                <label>Date & Time:<span style='color:red'> *</span></label>
                                                <input type="text" name="date_of_event" required
                                                    placeholder="Date & Time of Ceremony"
                                                    value="<?php echo @$_REQUEST["formattedDate"] . ' ' . @$_REQUEST["dateTime"]; ?>"
                                                    class="form-control" disabled />
                                                <input type="hidden" name="date_of_event" required
                                                    placeholder="Date And Time of Ceremony"
                                                    value="<?php echo @$_REQUEST["formattedDate"] . ' ' . @$_REQUEST["dateTime"]; ?>"
                                                    class="form-control" />
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Select Event Type:<span style='color:red'> *</span></label>
                                                <select name="wedding_type" id="event_type" class="form-control">
                                                    <option>Regular</option>
                                                    <option>Special (Kasalang Bayan)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <button type="submit" id="submitButton"
                                                class="btn btn-sm btn-success">SUBMIT</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <a href="#" id="prevSection" class="previous">&laquo;
                                            Previous</a>&nbsp;&nbsp;&nbsp;
                                        <a href="#" id="nextSection" class="next">Next &raquo;</a>
                                    </div>

                                    <?php } else {
                                } ?>
                            </div>
                            </form>


                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header  bg-success">
                                    <h4 class="modal-title">Modal title</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
document.addEventListener('DOMContentLoaded', function() {
    // Your existing JavaScript code here

    var currentYear = new Date().getFullYear();
    var yearRange = currentYear - 1990;

    $("#pinaganako").datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-18y', // Adjust the start date to cover a wider range
        endDate: '-18y',
        autoclose: true
    });

    $("#pinaganakosay").datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-18y', // Adjust the start date to cover a wider range
        endDate: '-18y',
        autoclose: true
    });

    $("#pinaganako").datepicker('setStartDate', '-' + yearRange + 'y');
    $("#pinaganakosay").datepicker('setStartDate', '-' + yearRange + 'y');

    jQuery('#dateAndTime_hus, #dateAndTime_wife').datetimepicker({
        format: 'Y-m-d g:i A',
        step: 30,
        timepicker: true,
        minDate: new Date()
    });

    function toggleSubmitButton(enable) {
        if (enable) {
            $("#submitButton").prop("disabled", false);
        } else {
            $("#submitButton").prop("disabled", true);
        }
    }

    $("#dateAndTime, #event_type").on("change", function() {
        var selectedDateTime = $("#dateAndTime").val();
        var eventType = $("#event_type").val();

        $.ajax({
            url: "php/fetch_available_schedules_wedding.php",
            method: "POST",
            data: {
                selectedDateTime: selectedDateTime,
                eventType: eventType
            },
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

    const sections = document.querySelectorAll('.form-section');
    let currentSection = 0;
    const nextButton = document.getElementById('nextSection');

    function showSection(sectionIndex) {
        sections.forEach((section, index) => {
            if (index === sectionIndex) {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        });

        if (sectionIndex === sections.length - 1) {
            nextButton.disabled = true;
        } else {
            nextButton.disabled = false;
        }
    }

    document.getElementById('nextSection').addEventListener('click', () => {
        if (currentSection < sections.length - 1) {
            currentSection++;
            showSection(currentSection);
        }
    });

    document.getElementById('prevSection').addEventListener('click', () => {
        if (currentSection > 0) {
            currentSection--;
            showSection(currentSection);
        }
    });

    showSection(currentSection);

    document.getElementById('number').addEventListener('input', function() {
        if (this.value.length > 11) {
            this.value = this.value.slice(0, 10); // Limit input to 11 characters
        }
    });
});
</script>
<script>
document.getElementById('number').addEventListener('input', function() {
    if (this.value.length > 11) {
        this.value = this.value.slice(0, 10); // Limit input to 11 characters
    }
});
</script>

<script src="./js/notification.js"></script>
<script src="./js/my_script.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="js/jquery.datetimepicker.full.js"></script>