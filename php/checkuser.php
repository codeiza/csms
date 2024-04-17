<?php
require_once 'php/connection.php';

function authenticateUser($username, $password, $pdo) {
    try {
        // Make sure $pdo is not null before preparing the statement
        if ($pdo !== null) {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE userName = :username AND delete_date is null and email_verification is not null");
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return null; // Authentication failed
    } catch (PDOException $e) {
        // Log the error or handle it as needed
        return null; // Authentication failed due to an error
    }
}
