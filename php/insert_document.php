<?php
//print_r($_REQUEST);
require_once 'connection.php';
move_uploaded_file($_FILES["original_doc"]["tmp_name"],'../original_doc/'.$_FILES["original_doc"]["name"]);
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO payment
		(request_form_id,event_type,mode_of_payment,price,date_of_payment,payors_name,original_doc)
		VALUES
		(:request_form_id,:event_type,:mode_of_payment,:price,:date_of_payment,:payors_name,:original_doc)"
	);
	$stmt->bindValue(':request_form_id',$_REQUEST["request_form_id"],PDO::PARAM_STR);
	$stmt->bindValue(':event_type',$_REQUEST["event_type"],PDO::PARAM_STR);
	$stmt->bindValue(':mode_of_payment',$_REQUEST["mode_of_payment"],PDO::PARAM_STR);
	$stmt->bindValue(':price',$_REQUEST["price"],PDO::PARAM_STR);
	$stmt->bindValue(':date_of_payment',$_REQUEST["date_of_payment"],PDO::PARAM_STR);
	$stmt->bindValue(':payors_name',$_REQUEST["payors_name"],PDO::PARAM_STR);
	$stmt->bindValue(':original_doc',$_FILES["original_doc"]["name"],PDO::PARAM_STR);
	$stmt->execute();
	
} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
 echo "<script>alert('Document request submitted successfully!')</script>";
 echo "<script>window.location.href='../document.php';</script>";
    exit;
?>