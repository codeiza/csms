<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/logo.png" type="image/x-icon"> 
        <!--========== BOX ICONS ==========-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

        <!--========== CSS ==========-->
        <link rel="stylesheet" href="csss/styles.css">

        <title>Home</title>
    </head>
    <body>
        <!--========== HEADER ==========-->
        <header class="header">
            <div class="header__container">
                <img src="assets/img/perfil.jpg" alt="" class="header__img">

                <a href="#" class="header__logo">Calendar</a>
   
    
                <div class="header__toggle">
                   <?php if (!isset($_SESSION['user'])) { ?>
                <img src="picture_data/profile.png" alt="Profile" id="profile">
              <?php } else { ?>
                <img src="picture_data/<?php echo $_SESSION["user"]["picture_data"]; ?>" alt="Profile" id="profile">
              <?php } ?>
                </div>
            </div>
        </header>

        <!--========== NAV ==========-->
        <div class="nav" id="navbar">
            <nav class="nav__container">
                <div>
                    <div style="text-align: center;">
    <img src="image/logo.png" alt="Company Logo" style="width: 100px; height: auto;">
          <?php
          if (isset($_SESSION["user"]["firstName"])) {
            echo '<h6>Welcome ' . $_SESSION["user"]["firstName"] . '!</h6>';
            if ($_SESSION["user"]["accountType"] == 'Priest') {
              echo '<>You are logged in as a Secretary  </p>';
            } else {
              echo '<p>You are logged in as a ' . $_SESSION["user"]["accountType"] . '  </p>';
            }
          } else {
            echo '<h5>Welcome Guest!</h5>'; // or any other default message you want
          }
          ?>
        </div>
                    </a>
    
                    <div class="nav__list">
                        <div class="nav__items">
    
                            <a href="#" class="nav__link active">
                                <i class='bx bx-home nav__icon' ></i>
                                <span class="nav__name">Home</span>
                            </a>
                            
                            <div class="nav__dropdown">
                                <a href="#" class="nav__link">
                                    <i class='bx bx-donate-heart nav__icon'></i>
                                    <span class="nav__name">Services</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="#" class="nav__dropdown-item">Baptismal</a>
                                        <a href="#" class="nav__dropdown-item">Funeral</a>
                                        <a href="#" class="nav__dropdown-item">Wedding</a>
                                        <a href="#" class="nav__dropdown-item">Mass</a>
                                        <a href="#" class="nav__dropdown-item">Blessing</a>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="nav__link">
                                <i class='bx bx-message-rounded nav__icon' ></i>
                                <span class="nav__name">Messages</span>
                            </a>
                            <a href="#" class="nav__link">
                                <i class='bx bx-file nav__icon'></i>
                                <span class="nav__name">Documents</span>
                            </a>
                            <a href="#" class="nav__link">
                                <i class='bx bx-transfer-alt nav__icon'></i>
                                <span class="nav__name">Transaction</span>
                            </a>
                            <a href="#" class="nav__link">
                               <i class='bx bx-message-square-detail nav__icon'></i>
                                <span class="nav__name">Chatbot</span>
                            </a>
                        </div>
    
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Menu</h3>
    
                            <div class="nav__dropdown">
                                <a href="#" class="nav__link">
                                    <i class='bx bx-bell nav__icon' ></i>
                                    <span class="nav__name">Notifications</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                    
                                </a>

                               

                            </div>

                        </div>
                    </div>
                </div>

                <a href="#" class="nav__link nav__logout">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

  

        <!--========== MAIN JS ==========-->
        <script src="jss/main.js"></script>
    </body>
</html>
