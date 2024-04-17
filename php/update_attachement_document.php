<?php 

//print_r($_REQUEST);
move_uploaded_file($_FILES["payment_attachment"]["tmp_name"],'../resibo/'.$_FILES["payment_attachment"]["name"]);

require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"UPDATE requested_document
		SET
		payment_attachment = :payment_attachment,
		request_status = :request_status

		
		WHERE
		id = :id"
	);
	$stmt->bindValue(':id',$_REQUEST["id"],PDO::PARAM_STR);
	$stmt->bindValue(':payment_attachment',$_FILES["payment_attachment"]["name"],PDO::PARAM_STR);
	$stmt->bindValue(':request_status','For Verification',PDO::PARAM_STR);
	//$stmt->bindValue(':payment_type','Already Paid',PDO::PARAM_STR);
	$stmt->execute();
	
	
	} catch (PDOException $e) {
	echo $e->getMessage();
}

$pdo = null;

 echo "<script> alert('Payment Success! Please wait for admin verification.')</script>";
 echo "<script>window.location.href='../index.php';</script>";
    exit;
?>