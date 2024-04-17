<?php
//print_r($_REQUEST);
session_start();
require_once 'connection.php';
move_uploaded_file($_FILES["receipt"]["tmp_name"],'../receipt_donation/'.$_FILES["receipt"]["name"]);
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO payment
		(event_type,payors_name,mode_of_payment,price,date_of_payment,original_doc)
		VALUES
		(:event_type,:payors_name,:mode_of_payment,:price,:date_of_payment,:original_doc)"
	);
	$stmt->bindValue(':event_type','Donation',PDO::PARAM_STR);
	$stmt->bindValue(':payors_name',$_REQUEST["payors_name"],PDO::PARAM_STR);
	$stmt->bindValue(':mode_of_payment',$_REQUEST["mode_of_payment"],PDO::PARAM_STR);
	$stmt->bindValue(':price',$_REQUEST["price"],PDO::PARAM_STR);
	$stmt->bindValue(':date_of_payment',$_REQUEST["date_of_payment"],PDO::PARAM_STR);
	$stmt->bindValue(':original_doc',$_FILES["receipt"]["name"],PDO::PARAM_STR);
	$stmt->execute();
	
	$stmt1 = $pdo->prepare(
		"INSERT INTO donation
		(donated_by,amount_value,date_of_donation,acc_num,acc_name,reference_num,receipt,user_id)
		VALUES
		(:donated_by,:amount_value,:date_of_donation,:acc_num,:acc_name,:reference_num,:receipt,:user_id)"
	);
	//$stmt1->bindValue(':user_id','Donation',PDO::PARAM_STR);
	$stmt1->bindValue(':donated_by',$_REQUEST["payors_name"],PDO::PARAM_STR);
	$stmt1->bindValue(':amount_value',$_REQUEST["price"],PDO::PARAM_STR);
	$stmt1->bindValue(':date_of_donation',$_REQUEST["date_of_payment"],PDO::PARAM_STR);
	$stmt1->bindValue(':acc_num',$_REQUEST["acc_num"],PDO::PARAM_STR);
	$stmt1->bindValue(':acc_name',$_REQUEST["acc_name"],PDO::PARAM_STR);
	$stmt1->bindValue(':reference_num',$_REQUEST["reference_num"],PDO::PARAM_STR);
	$stmt1->bindValue(':receipt',$_FILES["receipt"]["name"],PDO::PARAM_STR);
	$stmt1->bindValue(':user_id',$_SESSION["user"]["id"],PDO::PARAM_STR);
	$stmt1->execute();
	
} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
  echo "<script>alert('Your donation was successful. Thank you for your generosity!)</script>";
  
 echo "<script>window.location.href='../donation.php';</script>";
    exit;
 ?>