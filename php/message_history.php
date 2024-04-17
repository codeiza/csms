<?php
session_start(); // Make sure session is started
require_once 'connection.php'; // Include your database configuration
date_default_timezone_set('Asia/Manila');
try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $otherParty = $_POST['to']; // Get the username of the other party from the AJAX request
    $currentUser = $_SESSION["user"]["userName"];

    // Retrieve messages exchanged between the current user and the other party, ordered by date
    $stmt = $pdo->prepare("SELECT * FROM message WHERE (from_message = :currentUser AND to_message = :to) OR (from_message = :to AND to_message = :currentUser) ORDER BY date ASC");
    $stmt->execute([':currentUser' => $currentUser, ':to' => $otherParty]);

    $messageHistory = '';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $message = $row["message"];
        $from = $row["from_message"];
        $to = $row["to_message"];
		

        // Check if the message is incoming or outgoing
        if ($from == $currentUser) {
			echo'<span id="form" style="display:none">'.$row["to_message"].'</span>';
            // Outgoing message
            $messageHistory .= '<div class="outgoing_msg">';
            $messageHistory .= '<div class="sent_msg">';
            $messageHistory .= '<p>'.$message.'</p>';
            $messageHistory .= '<span class="time_date">'.date("h:i A | F j", strtotime($row["date"])).'</span>';
            $messageHistory .= '</div>';
            $messageHistory .= '</div>';
        } else {
			echo'<span id="form" style="display:none">'.$row["from_message"].'</span>';
            // Incoming message
            $messageHistory .= '<div class="incoming_msg">';
            $messageHistory .= '<div class="incoming_msg_img">  </div>';
            $messageHistory .= '<div class="received_msg">';
            $messageHistory .= '<div class="received_withd_msg">';
            $messageHistory .= '<p><strong>From: '.$from.'</strong> <br>'.$message.'</p>';
            $messageHistory .= '<span class="time_date">'.date("h:i A | F j", strtotime($row["date"])).'</span>';
            $messageHistory .= '</div>';
            $messageHistory .= '</div>';
            $messageHistory .= '</div>';
        }
    }

    echo $messageHistory; // Send the fetched message history back to the AJAX request
} catch (PDOException $e) {
    echo $e->getMessage(); // Send any errors back to the AJAX request
}
?>

