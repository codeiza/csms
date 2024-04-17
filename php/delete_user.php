<?php
session_start();

// Uncomment the line below for debugging purposes to print the received data
// print_r($_REQUEST);

date_default_timezone_set("Asia/Manila");
require_once 'connection.php';

try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare(
        "UPDATE users
        SET
        delete_date = :delete_date
        WHERE
        id = :id"
    );

    // Use named parameters to improve readability and security
    $stmt->bindValue(':delete_date', date('Y-m-d H:i:s'), PDO::PARAM_STR);
    $stmt->bindValue(':id', $_REQUEST["id"], PDO::PARAM_INT);
    $stmt->execute();

    // You can add a success message here if needed
    echo "User deleted successfully.";

} catch (PDOException $e) {
    // Handle exceptions gracefully, log them, or display a user-friendly error message
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$pdo = null;
