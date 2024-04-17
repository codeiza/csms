<?php
//print_r($_REQUEST);
session_start();
require_once 'connection.php';
move_uploaded_file($_FILES["requirements"]["tmp_name"],'../requirements/'.$_FILES["requirements"]["name"]);

try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO request_form
		(Event_type,bap_fullname,midlename,lastname,bap_municipality,bap_province,bap_baptismDateTime,bap_location,bap_date_of_birth,bap_placeOB,bap_nationality,
	    bap_recidence,bap_paternal_gp,bap_maternal_gp,bap_sponsors,sponsors2,sponsors3,sponsors4,sponsors5,sponsors6,sponsors7,sponsors8
		,bap_civil_status,bap_recidence2,fatherFirstName,fatherMiddleName,fatherLastName,
		motherFirstName,motherMiddleName,motherLastName,residence_father,civil_status_father,
		others_contact_no,others_email,others_reserve_by,others_sched_type,others_status)
		VALUES
		(:Event_type,:bap_fullname,:midlename,:lastname,:bap_municipality,:bap_province,:bap_baptismDateTime,:bap_location,:bap_date_of_birth,:bap_placeOB,:bap_nationality,
		:bap_recidence,:bap_paternal_gp,:bap_maternal_gp,:bap_sponsors,:sponsors2,:sponsors3,:sponsors4,:sponsors5,:sponsors6,:sponsors7,:sponsors8,
		:bap_civil_status,:bap_recidence2,:fatherFirstName,:fatherMiddleName,:fatherLastName,
		:motherFirstName,:motherMiddleName,:motherLastName,:residence_father,:civil_status_father,
		:others_contact_no,:others_email,:others_reserve_by,:others_sched_type,:others_status)"
	);
	$stmt->bindValue(':Event_type','Baptismal',PDO::PARAM_STR);
	$stmt->bindValue(':bap_fullname',$_REQUEST["fullname"],PDO::PARAM_STR);
	$stmt->bindValue(':midlename',$_REQUEST["midlename"],PDO::PARAM_STR);
	$stmt->bindValue(':lastname',$_REQUEST["lastname"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_municipality',$_REQUEST["municipality"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_province',$_REQUEST["province"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_baptismDateTime',$_REQUEST["baptismDateTime"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_location',$_REQUEST["location_baptism"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_date_of_birth',$_REQUEST["date_of_birth"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_placeOB',$_REQUEST["placeOB"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_nationality',$_REQUEST["nationality"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_recidence',$_REQUEST["residence"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_paternal_gp',$_REQUEST["paternal_gp"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_maternal_gp',$_REQUEST["maternal_gp"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_sponsors',$_REQUEST["sponsors"],PDO::PARAM_STR);
	
	$stmt->bindValue(':sponsors2',$_REQUEST["sponsors2"],PDO::PARAM_STR);
	$stmt->bindValue(':sponsors3',$_REQUEST["sponsors3"],PDO::PARAM_STR);
	$stmt->bindValue(':sponsors4',$_REQUEST["sponsors4"],PDO::PARAM_STR);
	$stmt->bindValue(':sponsors5',$_REQUEST["sponsors5"],PDO::PARAM_STR);
	$stmt->bindValue(':sponsors6',$_REQUEST["sponsors6"],PDO::PARAM_STR);
	$stmt->bindValue(':sponsors7',$_REQUEST["sponsors7"],PDO::PARAM_STR);
	$stmt->bindValue(':sponsors8',$_REQUEST["sponsors8"],PDO::PARAM_STR);
	
	$stmt->bindValue(':bap_civil_status',$_REQUEST["civil_status"],PDO::PARAM_STR);
	$stmt->bindValue(':bap_recidence2',$_REQUEST["recidence2"],PDO::PARAM_STR);
	
	$stmt->bindValue(':fatherFirstName',$_REQUEST["fatherFirstName"],PDO::PARAM_STR);
	$stmt->bindValue(':fatherMiddleName',$_REQUEST["fatherMiddleName"],PDO::PARAM_STR);
	$stmt->bindValue(':fatherLastName',$_REQUEST["fatherLastName"],PDO::PARAM_STR);
	
	$stmt->bindValue(':motherFirstName',$_REQUEST["motherFirstName"],PDO::PARAM_STR);
	$stmt->bindValue(':motherMiddleName',$_REQUEST["motherMiddleName"],PDO::PARAM_STR);
	$stmt->bindValue(':motherLastName',$_REQUEST["motherLastName"],PDO::PARAM_STR);
	
	$stmt->bindValue(':residence_father',$_REQUEST["residence_father"],PDO::PARAM_STR);
	$stmt->bindValue(':civil_status_father',$_REQUEST["civil_status_father"],PDO::PARAM_STR);
	/// other info need in system
	$stmt->bindValue(':others_contact_no',$_REQUEST["contact_no"],PDO::PARAM_STR);
	$stmt->bindValue(':others_email',$_REQUEST["email"],PDO::PARAM_STR);
	$stmt->bindValue(':others_reserve_by',$_REQUEST["reserve_by"],PDO::PARAM_STR);
	$stmt->bindValue(':others_sched_type',$_REQUEST["sched_type"],PDO::PARAM_STR);
	$stmt->bindValue(':others_status',$_REQUEST["Status"],PDO::PARAM_STR);
	$stmt->execute();
	$requestFormId = $pdo->lastInsertId();

	$stmt1 = $pdo->prepare(
		"INSERT INTO schedule_list
		(request_form_id,title,event_type,Status,start_datetime,email,contact_no,reserve_by,user_id,requirements)
		VALUES
		(:request_form_id,:title,:event_type,:Status,:start_datetime,:email,:contact_no,:reserve_by,:user_id,:requirements)"
	);
	$stmt1->bindValue(':request_form_id',$requestFormId, PDO::PARAM_INT);
	$stmt1->bindValue(':title','Baptismal',PDO::PARAM_STR);
	$stmt1->bindValue(':event_type','Baptismal',PDO::PARAM_STR);
	$stmt1->bindValue(':Status',$_REQUEST["Status"],PDO::PARAM_STR);
	$stmt1->bindValue(':start_datetime',$_REQUEST["baptismDateTime"],PDO::PARAM_STR);
	$stmt1->bindValue(':email',$_REQUEST["email"],PDO::PARAM_STR);
	
	$stmt1->bindValue(':contact_no',$_REQUEST["contact_no"],PDO::PARAM_STR);
	$stmt1->bindValue(':reserve_by',$_REQUEST["reserve_by"],PDO::PARAM_STR);
	$stmt1->bindValue(':user_id',$_SESSION["user"]["id"],PDO::PARAM_STR);
	$stmt1->bindValue(':requirements',$_FILES["requirements"]["name"],PDO::PARAM_STR);
	$stmt1->execute();
		
} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
  echo "<script>alert('Baptismal form submitted successfully!')</script>";
 echo "<script>window.location.href='../baptism.php';</script>";
    exit;
 ?>