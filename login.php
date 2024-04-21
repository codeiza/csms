<?php
session_start();
if (isset($_REQUEST["user"]) && isset($_REQUEST["pass"])) {
    require_once 'php/checkuser.php';

    try {
        $pdo = new PDO(DSN, DB_USR, DB_PWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $user = authenticateUser($_REQUEST["user"], $_REQUEST["pass"], $pdo);

        if ($user !== null) {
            $_SESSION['user'] = $user;
            $stmt = $pdo->prepare("UPDATE users SET isOnline = 1 WHERE userName = ?");
            $stmt->execute([$user['userName']]);
            if (isset($_SESSION["user"]["accountType"])) {
                if ($_SESSION["user"]["accountType"] == 'Admin') {
                    header('Location: ./summary.php'); // Redirect to admin-specific path
                } else if ($_SESSION["user"]["accountType"] == 'Priest') {
                    header('Location: ./schedule.php'); // Redirect to priest-specific path
                } else if ($_SESSION["user"]["accountType"] == 'Parishioner') {
                    header('Location: ./schedule.php'); // Redirect to parishioner-specific path
                } else {
                    header('Location: ./client_dashboard.php'); // Redirect to default user path
                }
            } else {
                header('Location: ./index.php'); // Default path if accountType is not set
            }
            exit;
        } else {
            $errorMessage = "Wrong password or username";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

/*
if (isset($_REQUEST["status"])) {
    echo '<span style="color:red">Incorrect username or password. Please check your credentials.</span>';
}*/
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/login_css.css">
    <style>
    .container-fluid {
        height: 100vh;
        overflow-y: auto;/
    }

    body {
        background-image: url('image/bg1.png');
    }

    p {
        font-size: 14px;
    }

    .margin {
        margin-bottom: 45px;
    }

    .navbar {
        padding-top: 15px;
        padding-bottom: 15px;
        border: 0;
        border-radius: 0;
        margin-bottom: 0px;
        font-size: 12px;
        letter-spacing: 4px;
    }

    .navbar-nav li a:hover {
        color: #1abc9c !important;

    }


    .login-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

    }

    label,
    select,
    input {
        display: block;
        margin-bottom: 10px;
    }

    select,
    input[type="password"] {
        font-size: 17px;
        display: block;
        width: 100%;
        height: 100%;
        padding: 5px 10px;
        background: none;
        background-image: none;
        border: 1px solid #01939c;
        color: #050505;
        border-radius: 6px;
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
    }

    .form {
        background: #e0e4f7;
        padding: 40px;
        max-width: 380px;
        margin: 40px auto;
        border-radius: 12px;
        box-shadow: 0 4px 10px 4px rgba(19, 35, 47, .3);
    }

    /* Style for the Show Password icon */
    .password-wrap {
        position: relative;
    }

    #show-password {
        position: absolute;
        right: 10px;
        top: 84%;
        transform: translateY(-50%);
        cursor: pointer;
    }

    /* Style the icon differently when password is visible */
    #password[type="text"]+#show-password {
        color: #3498db;
        /* Change the color as needed */
    }
    </style>
</head>

<body>



    <div class="form">
        <form role="form" action="" method="post">
            <div class="tab-content">
                <div id="signup">
                    <img src="images/logo.png" alt="Logo"
                        style="width: 150px; height: auto; display: block; margin: 0 auto;"> <br>
                    <h3>Login Account</h3>
                    <?php if (isset($errorMessage)) : ?>
                    <p class="error-message" style="color:red"><?= $errorMessage ?></p>
                    <?php endif; ?>
                    <form method="post">
                        <div class="top-row"></div>
                        <!--          <div class="field-wrap">
            <label for="accountType">Login as:</label>
    <select name="accountType" id="accountType" required>
        <option value="Client">Client</option>
        <option value="Parishioner">Parishioner</option>
        <option value="Priest">Priest</option>
        <option value="Admin">Admin</option>
    </select>
</div>--->
                        <div class="field-wrap">
                            <input id="text" type="text" name="user" required placeholder="Username" /><br>
                            <input id="password" type="password" name="pass" required placeholder="Password" />
                            <i class="fas fa-eye" id="show-password" onclick="togglePassword()"></i>
                        </div>

                        <p class="forgot"><a href="forgotpass.php">Forgot Password?</a></p>
                        <button id="button" type="submit" class="button button-block">Login</button><br>
                    </form>
                </div>

                <p class="mb-0 mt-4 center-text" style="text-align: center;">
                    <a href="signup.php" class="link">Not a member? <span style="color: blue;">Sign up
                            now</span></a><br><br>
                    <a href="index.php" class="link">Back</a>

                </p>

                <script>
                function togglePassword() {
                    var passwordInput = document.getElementById("password");
                    if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                    } else {
                        passwordInput.type = "password";
                    }
                }
                </script>


</body>

</html>