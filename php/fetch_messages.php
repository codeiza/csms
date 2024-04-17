<?php
session_start(); // Make sure session is started
require_once 'connection.php'; // Include your database configuration
//print_r($_REQUEST);
$where = "";
if($_REQUEST["filter"]== 'Sent Items'){
		$where .="WHERE to_message != '".$_SESSION["user"]["userName"]."' AND from_message = '".$_SESSION["user"]["userName"]."' ";
	 }else if($_REQUEST["filter"]== 'Inbox'){
		$where .="WHERE to_message = '".$_SESSION["user"]["userName"]."' AND from_message != '".$_SESSION["user"]["userName"]."' ";
	 }
try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo '<div class="inbox_chat">';
	$stmt = $pdo->prepare(
		"SELECT * FROM message
		
		".$where
		);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$date_update = $row["date"];
			$formatted_date = date("M d", strtotime($date_update));
			echo '<div class="chat_list active_chat">';
			echo '<div class="chat_people">';
			echo '<div class="chat_img">'.$row["from_message"].'</div>';
			echo '<div class="chat_ib">';
			echo '<h5><span class="other"></span><span class="chat_date">'.$formatted_date.'</span></h5>';
			echo '<p>'.$row["message"].'</p>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			
		}
	echo '</div>';
	} catch (PDOException $e) {
    echo $e->getMessage(); // Send any errors back to the AJAX request
}