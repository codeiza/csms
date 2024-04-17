<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection (replace with your database credentials)
    $dbHost = '127.0.0.1';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'u423960254_dbcsms';
    // $dbHost = 'localhost';
    // $dbUser = 'root';
    // $dbPass = '';
    // $dbName = 'dbcsms';

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and insert form data into the database
    // $accountNumber = $_POST['accountNumber'];
    $accountType = 'Client';
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    $sql = "INSERT INTO users (firstName, lastName, username, password, email, phoneNumber, birthdate, age, address, accountType)
            VALUES ( '$firstName', '$lastName', '$username', '$password', '$email', '$phoneNumber', '$birthdate', $age, '$address' ,'$accountType')";

    if ($conn->query($sql) === TRUE) {
        // Close the database connection
        $conn->close();

        require_once 'php/connection.php';
        try {
            $pdo = new PDO(DSN, DB_USR, DB_PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare(
                "SELECT * FROM users
		Where email = '" . $_POST["email"] . "'
		"
            );
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row["id"];
            }




            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'iglesiafilipinaparish@gmail.com';
            $mail->Password = 'cwgw kaey dnco tqen';

            $mail->SMTPSecure = 'tls';

            $mail->setFrom($_REQUEST["email"], 'Church Service Management System'); // Sender's email address and name
            $mail->addAddress($_REQUEST["email"], 'Church Service Management System'); // Recipient's email address and name
            $mail->isHTML(true);
            $mail->Subject = 'Email verification';

            $mail->Body = '<h3>Verify your email address to complete your registration <a href="https://iglesiafilipinaindependiente.com/php/verify.php?id=' . $id . '" class="btn btn-success"> Verify Email</a> <br><br> Thank you <br> <h3><span style="color:red; font-size:10px">This is system generated; please do not reply.</span>';

            if ($mail->send()) {
                echo 'reset your password sent to your email';
                echo "<script>alert('Registered successfully! Please check your email to verify')</script>";
                echo "<script>window.location.href='login.php';</script>";
            } else {
                echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $pdo = null;
        // Display a JavaScript popup message and redirect to login page
        //   echo '<script>alert("Registered successfully! You can now log in."); window.location.href = "login.php";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}