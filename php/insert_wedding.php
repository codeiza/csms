<?php
//print_r($_REQUEST);
session_start();
require_once 'connection.php';
move_uploaded_file($_FILES["requirements"]["tmp_name"],'../requirements/'.$_FILES["requirements"]["name"]);
move_uploaded_file($_FILES["Confession"]["tmp_name"],'../requirements/'.$_FILES["Confession"]["name"]);
move_uploaded_file($_FILES["sponsors"]["tmp_name"],'../requirements/'.$_FILES["sponsors"]["name"]);
move_uploaded_file($_FILES["Mlicense"]["tmp_name"],'../requirements/'.$_FILES["Mlicense"]["name"]);
move_uploaded_file($_FILES["CCertificate"]["tmp_name"],'../requirements/'.$_FILES["CCertificate"]["name"]);
move_uploaded_file($_FILES["Mbanns"]["tmp_name"],'../requirements/'.$_FILES["Mbanns"]["name"]);
move_uploaded_file($_FILES["Bcertificate"]["tmp_name"],'../requirements/'.$_FILES["Bcertificate"]["name"]);
move_uploaded_file($_FILES["cenomar"]["tmp_name"],'../requirements/'.$_FILES["cenomar"]["name"]);
//move_uploaded_file($_FILES["permit"]["tmp_name"],'../requirements/'.$_FILES["permit"]["name"]);
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO request_form
		(Event_type,wedding_province,wedding_municipality,wedding_husband_name,wedding_wife_name,wedding_husband_dob,wedding_wife_dob,wedding_husband_pob,wedding_wife_pob,
		wedding_husband_citizenship,wedding_wife_citizenship,wedding_husband_sex,wedding_wife_sex,wedding_husband_residence,wedding_wife_residence,wedding_husband_religion,
		wedding_wife_religion,wedding_husband_civistatus,wedding_wife_civistatus,wedding_husband_name_father,wedding_wife_name_father,wedding_husband_citizenship_parent,wedding_wife_citizenship_parent,
		wedding_husband_name_mother,wedding_wife_name_mother,wedding_wife_citizenship_parents,wedding_husband_citizenship_parents,peroson_gave_consent,peroson_gave_consent_wife,
		concent_relation_wife,concent_relation_hus,residence_wife_side,residence_husband_side,place_of_merriage,datetime_merriage,others_contact_no,others_email,others_reserve_by,others_sched_type,number_of_guest,start_datetime_event)
		VALUES
		(:Event_type,:wedding_province,:wedding_municipality,:wedding_husband_name,:wedding_wife_name,:wedding_husband_dob,:wedding_wife_dob,:wedding_husband_pob,:wedding_wife_pob,
		:wedding_husband_citizenship,:wedding_wife_citizenship,:wedding_husband_sex,:wedding_wife_sex,:wedding_husband_residence,:wedding_wife_residence,:wedding_husband_religion,
		:wedding_wife_religion,:wedding_husband_civistatus,:wedding_wife_civistatus,:wedding_husband_name_father,:wedding_wife_name_father,:wedding_husband_citizenship_parent,:wedding_wife_citizenship_parent,
		:wedding_husband_name_mother,:wedding_wife_name_mother,:wedding_wife_citizenship_parents,:wedding_husband_citizenship_parents,:peroson_gave_consent,:peroson_gave_consent_wife,
		:concent_relation_wife,:concent_relation_hus,:residence_wife_side,:residence_husband_side,:place_of_merriage,:datetime_merriage,:others_contact_no,:others_email,:others_reserve_by,:others_sched_type,:number_of_guest,:start_datetime_event
		)"
	);
	$stmt->bindValue(':Event_type','wedding',PDO::PARAM_STR);
	$stmt->bindValue(':wedding_province',$_REQUEST["wedding_province"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_municipality',$_REQUEST["wedding_municipality"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_name',$_REQUEST["wedding_husband_name"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_name',$_REQUEST["wedding_wife_name"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_dob',$_REQUEST["wedding_husband_dob"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_dob',$_REQUEST["wedding_wife_dob"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_pob',$_REQUEST["wedding_husband_pob"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_pob',$_REQUEST["wedding_wife_pob"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_citizenship',$_REQUEST["wedding_husband_citizenship"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_citizenship',$_REQUEST["wedding_wife_citizenship"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_sex',$_REQUEST["wedding_husband_sex"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_sex',$_REQUEST["wedding_wife_sex"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_residence',$_REQUEST["wedding_husband_residence"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_residence',$_REQUEST["wedding_wife_residence"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_religion',$_REQUEST["wedding_husband_religion"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_religion',$_REQUEST["wedding_wife_religion"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_civistatus',$_REQUEST["wedding_husband_civistatus"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_civistatus',$_REQUEST["wedding_wife_civistatus"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_name_father',$_REQUEST["wedding_husband_name_father"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_name_father',$_REQUEST["wedding_wife_name_father"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_citizenship_parent',$_REQUEST["wedding_husband_citizenship_parent"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_citizenship_parent',$_REQUEST["wedding_wife_citizenship_parent"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_name_mother',$_REQUEST["wedding_husband_name_mother"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_name_mother',$_REQUEST["wedding_wife_name_mother"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_wife_citizenship_parents',$_REQUEST["wedding_wife_citizenship_parents"],PDO::PARAM_STR);
	$stmt->bindValue(':wedding_husband_citizenship_parents',$_REQUEST["wedding_husband_citizenship_parents"],PDO::PARAM_STR);
	$stmt->bindValue(':peroson_gave_consent',$_REQUEST["peroson_gave_consent"],PDO::PARAM_STR);
	$stmt->bindValue(':peroson_gave_consent_wife',$_REQUEST["peroson_gave_consent_wife"],PDO::PARAM_STR);
	$stmt->bindValue(':concent_relation_wife',$_REQUEST["concent_relation_wife"],PDO::PARAM_STR);
	$stmt->bindValue(':concent_relation_hus',$_REQUEST["concent_relation_hus"],PDO::PARAM_STR);
	$stmt->bindValue(':residence_wife_side',$_REQUEST["residence_wife_side"],PDO::PARAM_STR);
	$stmt->bindValue(':residence_husband_side',$_REQUEST["residence_husband_side"],PDO::PARAM_STR);
	$stmt->bindValue(':place_of_merriage',$_REQUEST["place_of_merriage"],PDO::PARAM_STR);
	$stmt->bindValue(':datetime_merriage',$_REQUEST["date_of_event"],PDO::PARAM_STR);
	$stmt->bindValue(':others_contact_no',$_REQUEST["contact_number"],PDO::PARAM_STR);
	$stmt->bindValue(':others_email',$_REQUEST["email"],PDO::PARAM_STR);
	$stmt->bindValue(':others_reserve_by',$_REQUEST["reserve_by"],PDO::PARAM_STR);
	$stmt->bindValue(':others_sched_type',$_REQUEST["wedding_type"],PDO::PARAM_STR);
	$stmt->bindValue(':number_of_guest',$_REQUEST["number_of_guest"],PDO::PARAM_STR);
	$stmt->bindValue(':start_datetime_event',$_REQUEST["date_of_event"],PDO::PARAM_STR);
	$stmt->execute();
	$requestFormId = $pdo->lastInsertId();

	$stmt1 = $pdo->prepare(
		"INSERT INTO schedule_list
		(request_form_id,title,event_type,Status,start_datetime,contact_no,email,reserve_by,user_id,requirements,Confession,sponsors,Mlicense,CCertificate,Mbanns,Bcertificate,cenomar)
		VALUES
		(:request_form_id,:title,:event_type,:Status,:start_datetime,:contact_no,:email,:reserve_by,:user_id,:requirements,:Confession,:sponsors,:Mlicense,:CCertificate,:Mbanns,:Bcertificate,:cenomar)"
	);
	$stmt1->bindValue(':request_form_id',$requestFormId, PDO::PARAM_INT);
	$stmt1->bindValue(':title','wedding',PDO::PARAM_STR);
	$stmt1->bindValue(':event_type','wedding',PDO::PARAM_STR);
	$stmt1->bindValue(':Status','Confirm_docs',PDO::PARAM_STR);
	$stmt1->bindValue(':start_datetime',$_REQUEST["date_of_event"],PDO::PARAM_STR);
	$stmt1->bindValue(':contact_no',$_REQUEST["contact_no"],PDO::PARAM_STR);
	$stmt1->bindValue(':email',$_REQUEST["email"],PDO::PARAM_STR);
	$stmt1->bindValue(':reserve_by',$_REQUEST["reserve_by"],PDO::PARAM_STR);
	$stmt1->bindValue(':user_id',$_SESSION["user"]["id"],PDO::PARAM_STR);
	$stmt1->bindValue(':requirements',$_FILES["Baptismalcert"]["name"],PDO::PARAM_STR);
	
	$stmt1->bindValue(':Confession',$_FILES["Confession"]["name"],PDO::PARAM_STR);
	$stmt1->bindValue(':sponsors',$_FILES["sponsors"]["name"],PDO::PARAM_STR);
	$stmt1->bindValue(':Mlicense',$_FILES["Mlicense"]["name"],PDO::PARAM_STR);
	$stmt1->bindValue(':CCertificate',$_FILES["CCertificate"]["name"],PDO::PARAM_STR);
	$stmt1->bindValue(':Mbanns',$_FILES["Mbanns"]["name"],PDO::PARAM_STR);
	$stmt1->bindValue(':Bcertificate',$_FILES["Bcertificate"]["name"],PDO::PARAM_STR);
	$stmt1->bindValue(':cenomar',$_FILES["cenomar"]["name"],PDO::PARAM_STR);
	//$stmt1->bindValue(':permit',$_FILES["permit"]["name"],PDO::PARAM_STR);

	
	$stmt1->execute();
	
} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
  echo "<script>alert('Wedding form submitted successfully!')</script>";
 echo "<script>window.location.href='../wedding.php';</script>";
    exit;
	
 ?>