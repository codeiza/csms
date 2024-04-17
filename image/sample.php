<?php
session_start();
//print_r($_SESSION);
require_once 'php/connection.php';
try {
  $pdo = new PDO(DSN, DB_USR, DB_PWD);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //$userEmail = $_SESSION["email"];
  $stmt = $pdo->prepare(
    "SELECT * FROM schedule_list
	   WHERE (Status = 'Confirm_docs' or Status = 'For Payment' or (Status = 'Confirm' AND start_datetime > '" . date('Y-m-d') . "')) AND user_id = '" . $_SESSION["user"]["id"] . "' AND cancel_delete IS NULL
	   "
  );
  // $stmt->bindParam(':email', $_SESSION["email"]);
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
if ($_SESSION["user"]["accountType"] == 'Client') {

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
    <title>Home</title>
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/my_style.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./fullcalendar/lib/main.min.js"></script>
    <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.datetimepicker.css">
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
          <a href="index.php">
            <img src="image/logo.png" alt="Company Logo">
          </a>
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
          <hr>
          <?php if (@$_SESSION["user"]["accountType"] == 'Admin') { ?>
            <li>
              <a href="summary.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Dashboard</a>
            </li>
          <?php } elseif (@$_SESSION["user"]["accountType"] == 'Priest') { ?>
            <li>
              <a href="Schedule.php" class="dashboard-link"> <img src="image/dashboard.png" alt="Dashboard Logo" class="dashboard-img">Dashboard</a>
            </li>
          <?php } else { ?>
            <li>
              <a href="client_dash_board.php" class="dashboard-link"> <img src="image/home.png" alt="Dashboard Logo" class="dashboard-img">Home</a>
            </li>
          <?php }
          if (@$_SESSION["user"]["accountType"] == 'Admin') { ?>
            <li>
              <a href="user.php" class="dashboard-link"><img src="image/user.png" alt="user Forms Logo" class="dashboard-img">User Monitoring</a>
            </li>
            <li>
              <a href="Schedule.php" class="dashboard-link"> <img src="image/reservation.png" alt="Notify Logo" class="dashboard-img">Event Schedule</a>
            </li>
            <li>
              <a href="document.php" class="dashboard-link"> <img src="image/request.png" alt="request Logo" class="dashboard-img">Request Document<sup style="color:red; font-weight:bold" class="flashited"> New <?php echo $totaldoc; ?></sup></a>
            </li>

            <li>
              <a href="certificate.php" class="dashboard-link"> <img src="image/certificate.png" alt="Notify Logo" class="dashboard-img">Certificate</a>
            </li>
          <?php }  ?>

          <li>
            <a href="services.php" class="dashboard-link"> <img src="image/services.png" alt="Services Logo" class="dashboard-img">Services</a>
          </li>

          <li>
            <a href="reqest_document.php" class="dashboard-link"> <img src="image/payments.png" alt="Docs Logo" class="dashboard-img">Documents</a>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-btn">
              <img src="image/transactions.png" alt="Transactions Logo" class="dropdown-img">Transactions</a>
            <div class="dropdown-content">
              <a href="notification.php"><img src="image/forpay.png" alt="Transactions Logo" class="dropdown-img">For Pay</a>
              <a href="progress.php"><img src="image/status.png" alt="Status Logo" class="dropdown-img">Scheduled Status</a>
              <a href="donation.php"> <img src="image/donations.png" class="dropdown-img">Add Your Donation</a>
              <a href="mass_ofering.php"><img src="image/offering.png" alt="Transactions Logo" class="dropdown-img">Mass Offerings</a>
              <a href="history.php"><img src="image/payments.png" alt="Transactions Logo" class="dropdown-img">History Transaction</a>
            </div>
          </li>

          <li>
            <a href="chatbot.php" class="dashboard-link"><img src="image/chatbot.png" alt="chatbot Logo" class="dashboard-img">Chatbot</a>
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
            <span>Dashboard</span>
            <div>

              <span class="fa fa-bell noti_client" style="color:red">
                <?php if (@$_SESSION["user"]["accountType"] == 'Client' and $total > '0') { ?>
                  <sup style="color:red;" class="flashited"><?php echo $total; ?></sup>
                <?php } ?>


              </span>
              <?php if (!isset($_SESSION['user'])) { ?>
                <img src="picture_data/profile.png" alt="Profile" id="profile">
              <?php } else { ?>
                <img src="picture_data/<?php echo $_SESSION["user"]["picture_data"]; ?>" alt="Profile" id="profile">
              <?php } ?>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
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
        <div class="row">
          <div class="col-sm-3">
            <input type="hidden" placeholder="Search Keyword" id="keyword" class="form-control" />
          </div>
          <div class="col-sm-2">
            <input type="hidden" value="500" id="perpage" />
          </div>
        </div>
        <div class="container py-5" id="page-container">

          <div id='calendar' class="col-sm-12 mx-auto"></div>
          <?php $event_count = 0; ?>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              var calendarEl = document.getElementById('calendar');
              var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                dayCellContent: function(dayInfo) {
                  info = dayInfo;
                  var content = document.createElement('div');

                  // Add the date text
                  var dateText = document.createElement('div');
                  dateText.innerText = info.date.getDate();
                  content.appendChild(dateText);

                  // Add the button with Bootstrap classes
                  var button = document.createElement('button');
                  button.innerText = 'Show Event';
                  button.classList.add('btn', 'btn-primary'); // Add Bootstrap classes here

                  // Check if the date is past or equal to today
                  if (info.date < new Date()) {
                    button.hidden = true;
                    //button.innerText = 'Unavailable';
                    button.classList.add('btn', 'btn-danger');
                  }

                  button.addEventListener('click', function() {
                    var selectedDate = dayInfo.date;
                    var formattedDate =
                      selectedDate.getFullYear() +
                      '-' +
                      ('0' + (selectedDate.getMonth() + 1)).slice(-2) +
                      '-' +
                      ('0' + selectedDate.getDate()).slice(-2);

                    // Use AJAX to send the selected date to PHP
                    $.ajax({
                      url: 'php/event_available.php',
                      type: 'POST',
                      data: {
                        selectedDate: formattedDate
                      },
                      success: function(response) {
                        $(".modal-title").html('Event Schedule For ' + formattedDate); // Format date as "yyyy-mm-dd"
                        $(".modal-body-1").html(response);
                        $("#confirmModal").modal('show');
                      },
                      error: function(error) {
                        console.error('Error:', error);
                      },
                    });
                  });
                  content.appendChild(button);

                  return {
                    domNodes: [content]
                  };
                },
              });

              calendar.render();
              $(document).on('click', '.click_bap', function() {

                if (info.date < new Date()) {
                  // Handle past dates as needed
                  alert('Selected date is in the past.');
                  return;
                }

                var selectedDate = info.date;
                var formattedDate =
                  selectedDate.getFullYear() +
                  '-' +
                  ('0' + (selectedDate.getMonth() + 1)).slice(-2) +
                  '-' +
                  ('0' + selectedDate.getDate()).slice(-2);

                var sample = $(this).attr('datetime_bap');
                var url = 'baptism.php?dateTime=' + sample + '&formattedDate=' + formattedDate;
                location.href = url;
              });
              $(document).on('click', '.click_link', function() {
                if (info.date < new Date()) {
                  // Handle past dates as needed
                  alert('Selected date is in the past.');
                  return;
                }

                var selectedDate = info.date;
                var formattedDate =
                  selectedDate.getFullYear() +
                  '-' +
                  ('0' + (selectedDate.getMonth() + 1)).slice(-2) +
                  '-' +
                  ('0' + selectedDate.getDate()).slice(-2);

                var sample = $(this).attr('fune_dateTime');
                var url = 'funeral.php?dateTime=' + sample + '&formattedDate=' + formattedDate;
                location.href = url;
              })
              $(document).on('click', '.click_wed', function() {
                if (info.date < new Date()) {
                  // Handle past dates as needed
                  alert('Selected date is in the past.');
                  return;
                }

                var selectedDate = info.date;
                var formattedDate =
                  selectedDate.getFullYear() +
                  '-' +
                  ('0' + (selectedDate.getMonth() + 1)).slice(-2) +
                  '-' +
                  ('0' + selectedDate.getDate()).slice(-2);

                var sample = $(this).attr('time');
                var url = 'wedding.php?dateTime=' + sample + '&formattedDate=' + formattedDate;
                location.href = url;
              })
              // Function to filter events based on selection
              document.getElementById('event_selection').addEventListener('change', function() {
                var selectedEvent = this.value;

                calendar.getEvents().forEach(function(event) {
                  if (selectedEvent === 'All' || event.classNames.includes(selectedEvent)) {
                    event.setProp('display', '');
                  } else {
                    event.setProp('display', 'none');
                  }
                });
              });
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
<?php

} else {
  header('Location: index.php');
}


?>
<script>
  $(document).ready(function() {
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
<script src="./js/user.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="js/jquery.datetimepicker.full.js"></script>

  </html>