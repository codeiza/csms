<?php
session_start();
require_once 'php/connection.php';
require_once 'php/option_user.php';

try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Count total messages
    $stmt = $pdo->prepare("SELECT COUNT(*) AS totalmsg FROM message");
    $stmt->execute();
    $totalmsg = $stmt->fetch(PDO::FETCH_ASSOC)['totalmsg'];

    // Count total scheduled items
    $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM schedule_list WHERE Status = 'For Schedule' AND cancel_delete IS NULL");
    $stmt->execute();
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Count total documents
    $stmt = $pdo->prepare("SELECT COUNT(*) AS totaldoc FROM requested_document WHERE request_status = 'For Received'");
    $stmt->execute();
    $totaldoc = $stmt->fetch(PDO::FETCH_ASSOC)['totaldoc'];
} catch (PDOException $e) {
    echo $e->getMessage();
}

$pdo = null;

if (isset($_SESSION["user"]["firstName"])) {
    // Your session logic here
} else {
    header('Location: index.php');
    exit(); // Ensure no further code execution after redirection
}
?>



<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/styless.css">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.datetimepicker.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>


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

.container {
    max-width: 1170px;
    margin: auto;
}

img {
    max-width: 100%;
}

.inbox_people {
    background: #f8f8f8 none repeat scroll 0 0;
    float: left;
    overflow: hidden;
    width: 40%;
    border-right: 1px solid #c4c4c4;
}

.inbox_msg {
    border: 1px solid #c4c4c4;
    clear: both;
    overflow: hidden;
}

.top_spac {
    margin: 20px 0 0;
}


.recent_heading {
    float: left;
    width: 40%;
}

.srch_bar {
    display: inline-block;
    text-align: right;
    width: 60%;
}

.headind_srch {
    padding: 10px 29px 10px 20px;
    overflow: hidden;
    border-bottom: 1px solid #c4c4c4;
}

.recent_heading h4 {
    color: #05728f;
    font-size: 21px;
    margin: auto;
}

.srch_bar input {
    border: 1px solid #cdcdcd;
    border-width: 0 0 1px 0;
    width: 80%;
    padding: 2px 0 4px 6px;
    background: none;
}

.srch_bar .input-group-addon button {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    padding: 0;
    color: #707070;
    font-size: 18px;
}

.srch_bar .input-group-addon {
    margin: 0 0 0 -27px;
}

.chat_ib h5 {
    font-size: 15px;
    color: #464646;
    margin: 0 0 8px 0;
}

.chat_ib h5 span {
    font-size: 13px;
    float: right;
}

.chat_ib p {
    font-size: 14px;
    color: #989898;
    margin: auto
}

.chat_img {
    float: left;
    width: 11%;
}

.chat_ib {
    float: left;
    padding: 0 0 0 15px;
    width: 88%;
}

.chat_people {
    overflow: hidden;
    clear: both;
}

.chat_list {
    border-bottom: 1px solid #c4c4c4;
    margin: 0;
    padding: 18px 16px 10px;
}

.inbox_chat {
    height: 550px;
    overflow-y: scroll;
}

.mesgs {
    height: 550px;
    overflow-y: scroll;
}

.active_chat {
    background: #ebebeb;
}

.incoming_msg_img {
    display: inline-block;
    width: 6%;
}

.received_msg {
    display: inline-block;
    padding: 0 0 0 10px;
    vertical-align: top;
    width: 92%;
}

.received_withd_msg p {
    background: #ebebeb none repeat scroll 0 0;
    border-radius: 3px;
    color: #646464;
    font-size: 14px;
    margin: 0;
    padding: 5px 10px 5px 12px;
    width: 100%;
}

.time_date {
    color: #747474;
    display: block;
    font-size: 12px;
    margin: 8px 0 0;
}

.received_withd_msg {
    width: 57%;
}

.mesgs {
    float: left;
    padding: 30px 15px 0 25px;
    width: 60%;
}

.sent_msg p {
    background: #05728f none repeat scroll 0 0;
    border-radius: 3px;
    font-size: 14px;
    margin: 0;
    color: #fff;
    padding: 5px 10px 5px 12px;
    width: 100%;
}

.outgoing_msg {
    overflow: hidden;
    margin: 26px 0 26px;
}

.sent_msg {
    float: right;
    width: 46%;
}

.input_msg_write input {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    color: #4c4c4c;
    font-size: 15px;
    min-height: 48px;
    width: 100%;
}

.type_msg {
    border-top: 1px solid #c4c4c4;
    position: relative;
}

.msg_send_btn,
.msg_send_btn_reply {
    background: #05728f none repeat scroll 0 0;
    border: medium none;
    border-radius: 50%;
    color: #fff;
    cursor: pointer;
    font-size: 17px;
    height: 33px;
    position: absolute;
    right: 0;
    top: 11px;
    width: 33px;
}

.sendauto {
    background: #05728f none repeat scroll 0 0;
    border: medium none;
    border-radius: 50%;
    color: #fff;
    cursor: pointer;
    font-size: 17px;
    height: 33px;
    position: absolute;
    right: 0;
    top: 11px;
    width: 33px;
}

.messaging {
    padding: 0 0 50px 0;
}

.msg_history {
    height: 516px;
    overflow-y: auto;
}

.custom-dropdown select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: linear-gradient(45deg, transparent 50%, black 50%), linear-gradient(135deg, black 50%, transparent 50%);
    background-position: calc(100% - 15px) center, calc(100% - 10px) center;
    background-size: 5px 5px, 5px 5px;
    background-repeat: no-repeat;
    padding-right: 20px;
}

.faq-button {
    margin-right: 10px;
    margin-bottom: 10px;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    cursor: pointer;
}

.bot-message {
    text-align: left;
    color: #4caf50;
}
</style>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="company-logo">
                <img src="image/logo.png" alt="Company Logo">
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
                    <a href="transactions.php" class="dashboard-link"> <img src="image/transactions.png" alt="Docs Logo"
                            class="dashboard-img">Transactions</a>
                </li>
                <li>
                    <a href="client_chatbot.php" class="dashboard-link"><img src="image/chatbot.png" alt="chatbot Logo"
                            class="dashboard-img">Chatbot</a>
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
        <div class="main-content">
            <div class="top-bar">

                <div class="profile">
                    <span>Message</span>




                    <div>
                        <?php if (@$_SESSION["user"]["accountType"] == 'Admin' and $total > '0') { ?>
                        <span class="fa fa-bell noti" style="color:red"><sup style="color:red;"
                                class="flashited"><?php echo $total; ?></sup></span>
                        <?php } else {
                        }
                        if (!isset($_SESSION['user'])) { ?>
                        <img src="image/profile.png" alt="Profile Image">
                        <?php  } else {
                        ?>
                        <img src="image/<?php echo $_SESSION["user"]["picture_data"]; ?>" alt="Profile Image"
                            id="profile">
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">

                    <input type="hidden" placeholder="Search Keyword" id="keyword" class="form-control" />
                </div>



                <div class="col-sm-6">
                    <input type="hidden" value="500" id="perpage" />
                </div>

            </div>
            <div style="display: flex; flex-direction: row; align-items: center; justify-content: center; ">
                <div class="col-sm-4" style="margin-left: 135px; margin-top: 20px;">
                    <div class="custom-dropdown">
                        <select class="form-control" id="message_filter">
                            <option>All</option>
                            <option>Inbox</option>
                            <option>Sent Items</option>
                            <!--<option>Archived</option>-->
                        </select>
                    </div>
                </div>
                <div style="width: 20%; margin-top: 20px; margin-left: 10px;">
                    <?php if (@$_SESSION["user"]["accountType"] == 'Client') { ?>
                    <input type="button" class="btn btn-outline-warning livechat" value="Live chat" />
                    <?php } else { ?>
                    <img class="write" src="images/new_msg.png" />
                    <?php } ?>
                </div>
            </div>

            <div class="container">
                <div class="messaging">
                    <div class="inbox_msg">
                        <div class="inbox_people">

                            <div class="headind_srch">

                                <div class="recent_heading">
                                    <h4>Recent</h4>
                                </div>
                                <!--
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>-->
                            </div>
                            <?php
                            try {
                                $pdo = new PDO(DSN, DB_USR, DB_PWD);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $pdo->prepare(
                                    "SELECT MAX(id) as latest_message_id, 
                                            CASE 
                                                WHEN from_message = :username THEN to_message 
                                                ELSE from_message 
                                            END AS other_party, 
                                            MAX(date_update) as latest_timestamp,
                                            COUNT(*) as total_messages, to_message, from_message
                                    FROM message
                                    WHERE to_message = :username OR from_message = :username
                                    GROUP BY 
                                            CASE 
                                                WHEN from_message = :username THEN to_message 
                                                ELSE from_message 
                                            END
                                    ORDER BY latest_timestamp DESC"
                                );

                                $stmt->execute([':username' => $_SESSION["user"]["userName"]]);
                                $currentUser = $_SESSION["user"]["userName"];
                                echo '<div class="inbox_chat">';
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $from = $row["from_message"];
                                    $date_update = $row["latest_timestamp"];
                                    $formatted_date = date("M d", strtotime($date_update));
                                    $other_party = $row["other_party"];

                                    // Fetch isOnline status for other_party
                                    $isOnlineStmt = $pdo->prepare("SELECT isOnline FROM users WHERE username = ?");
                                    $isOnlineStmt->execute([$other_party]);
                                    $isOnline = $isOnlineStmt->fetchColumn();

                                    // Determine online status indicator
                                    $onlineIndicator = ($isOnline == 1) ? '<span style="color: green;">(Online)</span>' : '';

                                    if ($from == $currentUser) {
                                        $from = $row["to_message"];
                                    } else {
                                        $from = $row["from_message"];
                                    }
                                    echo '<div class="chat_list active_chat">';
                                    echo '<div class="chat_people">';
                                    echo '<div class="chat_img">From: ' . $from . $onlineIndicator . '</div>';
                                    echo '<div class="chat_ib">';

                                    echo '<h5><span class="other">' . $other_party . '</span><span class="chat_date">' . $formatted_date . '</span></h5>';
                                    // Now you need to fetch the latest message for this conversation and display it
                                    $latest_message_id = $row["latest_message_id"];
                                    $latest_message_stmt = $pdo->prepare("SELECT * FROM message WHERE id = :id");
                                    $latest_message_stmt->execute([':id' => $latest_message_id]);
                                    $latest_message_row = $latest_message_stmt->fetch(PDO::FETCH_ASSOC);
                                    echo '<p>' . $latest_message_row["message"] . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                echo '</div>';



                            ?>
                        </div>

                        <div class="mesgs">
                            <?php if (@$_SESSION["user"]["accountType"] == 'Client') { ?>
                            <div id="auto">
                                <div id="chat-window">
                                    <div class="message bot-message">Hi there! How can I help you please select question
                                        bellow?</div>
                                </div>
                                <br>
                                <button class="faq-button"
                                    data-question="How can I make a donation to Iglesia Filipina Independiente Parish?">How
                                    can I make a donation?</button>
                                <button class="faq-button"
                                    data-question="What services can I request through the Church Service Management System?">What
                                    services can I request?</button>
                                <button class="faq-button"
                                    data-question="How can I request a certificate for events like weddings and baptisms?">How
                                    can I request a certificates?</button>
                                <button class="faq-button"
                                    data-question="What online payment methods do you accept, and how do I complete the payment process?">What
                                    online payment methods do you accept, and how do I complete the payment
                                    process?</button>
                                <button class="faq-button"
                                    data-question="What should I do if I encounter issues with the payment process?">What
                                    should I do if I encounter issues with the payment process?</button>
                                <button class="faq-button"
                                    data-question="How do I navigate the Church Service Management System?">How do I
                                    navigate the Church Service Management System?</button>
                                <button class="faq-button"
                                    data-question="How can I get in touch with the Iglesia Filipina Independiente Parish for additional support or inquiries?">How
                                    can I get in touch with the Iglesia Filipina Independiente Parish for additional
                                    support or inquiries?</button>
                                <div class="type_msg">
                                    <div class="input_msg_write">
                                        <textarea class="form-control" id="user-input"
                                            placeholder="Type a messages here"></textarea>
                                        <button class="sendauto" type="button"><i class="fa fa-paper-plane-o"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="msg_history">
                            </div>
                            <?php } else { ?>
                            <div class="msg_history">
                                <span style="display: flex; justify-content: center;"><img src="images/message.png"
                                        height="50%" width="50%" /></span>
                                <h1 style="display: flex; justify-content: center;">No Conversation Selected</h1>
                            </div>


                            <?php } ?>
                            <?php
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                            $pdo = null;
                        ?>
                            <div class="type_msg" style="display:none">
                                <div class="input_msg_write">
                                    <input type="text" class="write_msg" placeholder="Type a messages" />
                                    <button class="msg_send_btn_reply" type="button"><i class="fa fa-paper-plane-o"
                                            aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
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

        <?php



        ?>
        <script>
        $(document).ready(function() {
            $('#user-input').keypress(function(event) {
                if (event.keyCode === 13) { // Enter key
                    var userInput = $(this).val();
                    sendMessage(userInput, 'user');
                    respondToUser(userInput);
                    $(this).val('');
                }
            });

            $('.sendauto').click(function() {
                var userInput = $('#user-input').val();
                sendMessage(userInput, 'user');
                respondToUser(userInput);
                $('#user-input').val('');

            });
            $('.faq-button').click(function() {
                var selectedQuestion = $(this).data('question');
                sendMessage(selectedQuestion, 'user');
                respondToUser(selectedQuestion);
            });

            function sendMessage(message, sender) {
                var messageClass = (sender === 'user') ? 'user-message' : 'bot-message';
                var messageContent = (sender === 'user') ?
                    '<div class="outgoing_msg"><div class="sent_msg"><p>' + message +
                    '</p><span class="time_date">' + getCurrentTime() + '</span></div></div>' : message;
                $('#chat-window').append('<div class="message ' + messageClass + '">' + messageContent +
                    '</div>');
            }

            function getCurrentTime() {
                // Function to get current time formatted as desired
                var now = new Date();
                var hours = now.getHours();
                var minutes = now.getMinutes();
                var ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // Handle midnight
                minutes = minutes < 10 ? '0' + minutes : minutes; // Add leading zero for single digit minutes
                var timeString = hours + ':' + minutes + ' ' + ampm + ' | ' + now.toLocaleString('en-US', {
                    month: 'long',
                    day: 'numeric'
                });
                return timeString;
            }



            function respondToUser(userInput) {
                var response;
                var responseWrapper;
                switch (userInput) {
                    case 'How can I make a donation to Iglesia Filipina Independiente Parish?':
                        response =
                            "You can make a donation through our system by selecting the 'Donation' option and choosing the amount you wish to donate. We accept various payment methods for your convenience.";
                        break;
                    case 'What services can I request through the Church Service Management System?':
                        response =
                            "You can request the following services:<br>" +
                            "- Baptism<br>" +
                            "- Wedding<br>" +
                            "- Funeral<br>" +
                            "- Mass<br>" +
                            "- Blessing<br>" +
                            "Simply select the service you need, fill in the necessary details, and submit your request.";
                        break;
                    case 'How can I request a certificate for events like weddings and baptisms?':
                        response =
                            "You can request certificates for these events through our system. Simply navigate to the 'Request Documents' section, choose the type of certificate you need, provide the required information, and submit your request. We will process your request and make the certificate available to you.";
                        break;
                    case 'What online payment methods do you accept, and how do I complete the payment process?':
                        response =
                            "We accept various online payment methods, including GCash, Maya, and traditional bank transfers. To make a payment, the admin will provide you with the amount to pay and email you the details. Please ensure you upload your payment confirmation. After you upload your payment, wait for confirmation via email, and we will verify the payment.";
                        break;
                    case 'How long does it take to process payments made through the Church Service Management System?':
                        response =
                            "Payment processing times may vary depending on the payment method used. Typically, payments are verified within 1-2 business days. Once the payment is confirmed, your request will be processed accordingly.";
                        break;
                    case 'What should I do if I encounter issues with the payment process?':
                        response =
                            "If you encounter any issues while making a payment, please send us a message through our chatbot or email us at iglesiafilipinaparish@gmail.com. You can also find our contact information on the website, and we'll be happy to help you resolve any payment-related concerns.";
                        break;
                    case 'How do I navigate the Church Service Management System?':
                        response =
                            "To navigate the system, simply use the menu options provided on the website. You can access services, certificates, donations, and payment functions through the user-friendly interface. If you need assistance, refer to our user guide or contact our support team.";
                        break;
                    case 'How can I get in touch with the Iglesia Filipina Independiente Parish for additional support or inquiries?':
                        response =
                            "If you have any further questions or require support, please feel free to contact us through the provided contact information on our website. Our dedicated team is here to assist you with any concerns or inquiries you may have.";
                        break;
                    default:
                        response =
                            "Your message is more important to us, if you cannot find answer please click live chat.";
                }

                responseWrapper = '<div class="incoming_msg">' +
                    '<div class="incoming_msg_img"></div>' +
                    '<div class="received_msg">' +
                    '<div class="received_withd_msg">' +
                    '<p><strong>' + response + '</strong></p>' +
                    '<span class="time_date">' + getCurrentTime() + '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                sendMessage(responseWrapper, 'bot');
            }

            $('#message_filter').change(function() {
                var filter = $(this).val(); // Get the selected filter option
                $.ajax({
                    url: 'php/fetch_messages.php', // Change this to the URL of your PHP script to fetch messages
                    type: 'POST',
                    data: {
                        filter: filter
                    }, // Send selected filter option to the server
                    success: function(response) {
                        $('.inbox_chat').html(
                            response
                        ); // Update the message display area with fetched messages
                    }
                });
            });

            $(document).on('click', '.chat_people', function() {
                $('#auto').hide();
                var other_party = $(this).find('.other')
                    .text(); // Get the username from the clicked chat_people element
                $.ajax({
                    url: 'php/message_history.php', // Endpoint to fetch message history
                    type: 'post',
                    data: {
                        to: other_party
                    }, // Pass the username to fetch the message history
                    success: function(response) {
                        $('.msg_history').html(
                            response
                        ); // Update the message history section with the fetched data
                        $('.type_msg').show();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });

            })
            $(document).on('click', '.livechat', function() {
                $('.type_msg').hide();
                $('#auto').hide();
                var onlineStatusColor =
                    "<?php echo ($_SESSION['user']['isOnline'] == 1) ? 'green' : ''; ?>";
                var htmlContent = '<div class="custom-dropdown">' +
                    '<label>To:</label>' +
                    '<select type="text" class="form-control" id="to_message" >' +
                    '<option style="color: ' + onlineStatusColor +
                    ';"><?php echo $userName; ?></option>' +
                    '</select>' +
                    '</div>' +
                    '<br>' +
                    '<div class="type_msg">' +
                    '<div class="input_msg_write">' +
                    '<textarea class="form-control write_msg" id="message" placeholder="Type a message"></textarea>' +
                    '<button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>' +
                    '</div>' +
                    '</div>';
                $('.msg_history').html(htmlContent);
            });

            $(document).on('click', '.write', function() {
                $('.type_msg').hide();
                var onlineStatusColor =
                    "<?php echo ($_SESSION['user']['isOnline'] == 1) ? 'green' : ''; ?>";
                var htmlContent = '<div class="custom-dropdown">' +
                    '<label>To:</label>' +
                    '<select type="text" class="form-control" id="to_message" >' +
                    '<option style="color: ' + onlineStatusColor +
                    ';"><?php echo $userName; ?></option>' +
                    '</select>' +
                    '</div>' +
                    '<br>' +
                    '<div class="type_msg">' +
                    '<div class="input_msg_write">' +
                    '<textarea class="form-control write_msg" id="message" placeholder="Type a message"></textarea>' +
                    '<button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>' +
                    '</div>' +
                    '</div>';
                $('.msg_history').html(htmlContent);

            })

            $(document).on('click', '.msg_send_btn_reply', function() {
                var replyTo = $('#form').text();

                var formData = new FormData();
                formData.append('to_message', replyTo);
                formData.append('message', $('.write_msg').val());
                $.ajax({
                    url: 'php/insert_message.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            title: "Successfully!",
                            text: "Message successfully Send.",
                            icon: "success",
                            didClose: function() {

                            }
                        });
                    },
                    error: function(error) {
                        console.log(error.responseText);
                    }
                });

            })
            $(document).on('click', '.msg_send_btn', function() {
                var formData = new FormData();
                formData.append('to_message', $('#to_message').val());
                formData.append('message', $('#message').val());
                $.ajax({
                    url: 'php/insert_message.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            title: "Successfully!",
                            text: "Message successfully Send.",
                            icon: "success",
                            didClose: function() {
                                location.reload();
                            }
                        });
                    },
                    error: function(error) {
                        console.log(error.responseText);
                    }
                });
            })

            $("#date_filter").datepicker({
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
        });
        </script>
        <script src="./js/notification.js"></script>
        <script src="./js/message.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap-datepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="js/jquery.datetimepicker.full.js"></script>
</body>

</html>