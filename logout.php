<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    require_once 'php/connection.php';

    try {
        $pdo = new PDO(DSN, DB_USR, DB_PWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Update isOnline status to 0
        $stmt = $pdo->prepare("UPDATE users SET isOnline = 0 WHERE userName = ?");
        $stmt->execute([$_SESSION['user']['userName']]);
    } catch (PDOException $e) {
        // Handle any errors
        echo $e->getMessage();
    }

    // Unset session variables
    session_unset();

    // Destroy the session
    session_destroy();
}

// Redirect to the index page
header("Location: index.php");
exit();