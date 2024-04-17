<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection (replace with your database credentials)
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'dbcsms';

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

    $sql = "INSERT INTO users (firstName, lastName, username, password, email, phoneNumber, birthdate, age, address)
            VALUES ( '$firstName', '$lastName', '$username', '$password', '$email', '$phoneNumber', '$birthdate', $age, '$address')";

    if ($conn->query($sql) === TRUE) {
        // Close the database connection
        $conn->close();

        // Display a JavaScript popup message and redirect to login page
        echo '<script>alert("Registered successfully! You can now log in."); window.location.href = "login.php";</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
