<?php
//print_r($_REQUEST);
session_start();
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO request_form
		(Event_type,mass_type_of_mass,mass_name_person,event_location,start_datetime_event)
		VALUES
		(:Event_type,:mass_type_of_mass,:mass_name_person,:event_location,:start_datetime_event)"
	);
	$stmt->bindValue(':Event_type','Mass',PDO::PARAM_STR);
	$stmt->bindValue(':mass_type_of_mass',$_REQUEST["mass_type_of_mass"],PDO::PARAM_STR);
	$stmt->bindValue(':mass_name_person',$_REQUEST["mass_name_person"],PDO::PARAM_STR);
	$stmt->bindValue(':event_location',$_REQUEST["event_location"],PDO::PARAM_STR);
	$stmt->bindValue(':start_datetime_event',$_REQUEST["date_of_event"],PDO::PARAM_STR);
	$stmt->execute();
	$requestFormId = $pdo->lastInsertId();
	$stmt1 = $pdo->prepare(
		"INSERT INTO schedule_list
		(request_form_id,title,event_type,Status,start_datetime,contact_no,email,reserve_by,user_id)
		VALUES
		(:request_form_id,:title,:event_type,:Status,:start_datetime,:contact_no,:email,:reserve_by,:user_id)"
	);
	$stmt1->bindValue(':request_form_id',$requestFormId, PDO::PARAM_INT);
	$stmt1->bindValue(':title','mass',PDO::PARAM_STR);
	$stmt1->bindValue(':event_type','mass',PDO::PARAM_STR);
	$stmt1->bindValue(':Status','For Schedule',PDO::PARAM_STR);
	$stmt1->bindValue(':start_datetime',$_REQUEST["date_of_event"],PDO::PARAM_STR);
	$stmt1->bindValue(':contact_no',$_REQUEST["contact_no"],PDO::PARAM_STR);
	$stmt1->bindValue(':email',$_REQUEST["email"],PDO::PARAM_STR);
	$stmt1->bindValue(':reserve_by',$_REQUEST["reserve_by"],PDO::PARAM_STR);
	$stmt1->bindValue(':user_id',$_SESSION["user"]["id"],PDO::PARAM_STR);

	
	$stmt1->execute();
} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
 echo "<script>alert('Mass form submitted successfully! ')</script>";
echo "<script>window.location.href='../mass.php';</script>";
    exit;
 ?>