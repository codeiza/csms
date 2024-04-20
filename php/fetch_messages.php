<?php
session_start(); // Make sure session is started
require_once 'connection.php'; // Include your database configuration

$filter = isset($_REQUEST["filter"]) ? $_REQUEST["filter"] : 'All'; // Get the selected filter

$where = ""; // Initialize the WHERE clause
$bindParams = []; // Initialize an array to hold the bound parameters

if ($filter == 'Sent Items') {
	$where .= "WHERE from_message = :username"; // Filter for messages sent by the user
} else if ($filter == 'Inbox') {
	$where .= "WHERE to_message = :username"; // Filter for messages received by the user
} else {
	// For the 'All' filter, include messages where the user is either the sender or the recipient
	$where .= "WHERE from_message = :username OR to_message = :username";
}

try {
	$pdo = new PDO(DSN, DB_USR, DB_PWD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Prepare the SQL statement with the WHERE clause
	$stmt = $pdo->prepare(
		"SELECT * FROM message " . $where
	);

	// Bind the username parameter
	$bindParams[':username'] = $_SESSION["user"]["userName"];

	// Bind the parameters
	foreach ($bindParams as $param => $value) {
		$stmt->bindParam($param, $value, PDO::PARAM_STR);
	}

	// Execute the query
	$stmt->execute();

	// Fetch and display messages
	echo '<div class="inbox_chat">';
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$date_update = $row["date"];
		$formatted_date = date("M d", strtotime($date_update));
		echo '<div class="chat_list active_chat">';
		echo '<div class="chat_people">';
		echo '<div class="chat_img">' . $row["from_message"] . '</div>';
		echo '<div class="chat_ib">';
		echo '<h5><span class="other"></span><span class="chat_date">' . $formatted_date . '</span></h5>';
		echo '<p>' . $row["message"] . '</p>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
	echo '</div>';
} catch (PDOException $e) {
	echo $e->getMessage(); // Send any errors back to the AJAX request
}