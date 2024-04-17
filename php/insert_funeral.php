<?php
session_start();
require_once 'connection.php';
move_uploaded_file(@$_FILES["requirements"]["tmp_name"],'../requirements/'.@$_FILES["requirements"]["name"]);
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO request_form
		(Event_type,funeral_deceased_name,funeral_age,funeral_date_of_death,event_location,start_datetime_event)
		VALUES
		(:Event_type,:funeral_deceased_name,:funeral_age,:funeral_date_of_death,:event_location,:start_datetime_event)"
	);
	$stmt->bindValue(':Event_type','Funeral',PDO::PARAM_STR);
	$stmt->bindValue(':funeral_deceased_name',@$_REQUEST["funeral_deceased_name"],PDO::PARAM_STR);
	$stmt->bindValue(':funeral_age',$_REQUEST["age"],PDO::PARAM_STR);
	$stmt->bindValue(':funeral_date_of_death',$_REQUEST["date_of_death"],PDO::PARAM_STR);
	$stmt->bindValue(':event_location',$_REQUEST["event_location"],PDO::PARAM_STR);
	$stmt->bindValue(':start_datetime_event',$_REQUEST["start_datetime_event"],PDO::PARAM_STR);
	$stmt->execute();
	$requestFormId = $pdo->lastInsertId();
	$stmt1 = $pdo->prepare(
		"INSERT INTO schedule_list
		(request_form_id,title,event_type,Status,start_datetime,contact_no,email,reserve_by,user_id,requirements)
		VALUES
		(:request_form_id,:title,:event_type,:Status,:start_datetime,:contact_no,:email,:reserve_by,:user_id,:requirements)"
	);
	$stmt1->bindValue(':request_form_id',$requestFormId, PDO::PARAM_INT);
	$stmt1->bindValue(':title','Funeral',PDO::PARAM_STR);
	$stmt1->bindValue(':event_type','Funeral',PDO::PARAM_STR);
	$stmt1->bindValue(':Status','For Schedule',PDO::PARAM_STR);
	$stmt1->bindValue(':start_datetime',$_REQUEST["start_datetime_event"],PDO::PARAM_STR);
	$stmt1->bindValue(':contact_no',$_REQUEST["contact_no"],PDO::PARAM_STR);
	$stmt1->bindValue(':email',$_REQUEST["email"],PDO::PARAM_STR);
	$stmt1->bindValue(':reserve_by',$_REQUEST["reserve_by"],PDO::PARAM_STR);
	$stmt1->bindValue(':user_id',$_SESSION["user"]["id"],PDO::PARAM_STR);
	$stmt1->bindValue(':requirements',@$_FILES["requirements"]["name"],PDO::PARAM_STR);
	
	
	$stmt1->execute();
} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
  echo "<script>alert('Funeral form submitted successfully!')</script>";
 echo "<script>window.location.href='../funeral.php';</script>";
    exit;
 ?>