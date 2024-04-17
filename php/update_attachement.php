<?php

//print_r($_REQUEST);
move_uploaded_file($_FILES["payment_attachment"]["tmp_name"], '../resibo/' . $_FILES["payment_attachment"]["name"]);

require_once 'connection.php';
try {
	$pdo = new PDO(DSN, DB_USR, DB_PWD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"UPDATE schedule_list
		SET
		payment_attachment = :payment_attachment,
		Status = :Status,
		payment_type = :payment_type,
		date_paid = :date_paid,
		reference_num = :reference_num,
		account_num = :account_num,
		account_name = :account_name,
		amount = :amount
		
		WHERE
		id = :id"
	);
	$stmt->bindValue(':id', $_REQUEST["id"], PDO::PARAM_STR);
	$stmt->bindValue(':payment_attachment', $_FILES["payment_attachment"]["name"], PDO::PARAM_STR);
	$stmt->bindValue(':Status', 'For Verification', PDO::PARAM_STR);
	$stmt->bindValue(':payment_type', $_REQUEST["payment"], PDO::PARAM_STR);
	$stmt->bindValue(':date_paid', date('Y-m-d h:i:s A'), PDO::PARAM_STR);
	$stmt->bindValue(':reference_num', $_REQUEST["reference_num"], PDO::PARAM_STR);
	$stmt->bindValue(':account_num', $_REQUEST["account_num"], PDO::PARAM_STR);
	$stmt->bindValue(':account_name', $_REQUEST["account_name"], PDO::PARAM_STR);
	$stmt->bindValue(':amount', $_REQUEST["amount"], PDO::PARAM_STR);
	$stmt->execute();

	$stmt = $pdo->prepare(
		"INSERT INTO payment
		(event_type,payors_name,mode_of_payment,price,date_of_payment,original_doc)
		VALUES
		(:event_type,:payors_name,:mode_of_payment,:price,:date_of_payment,:original_doc)"
	);
	$stmt->bindValue(':event_type', $_REQUEST["event_type"], PDO::PARAM_STR);
	$stmt->bindValue(':payors_name', $_REQUEST["reserve_by"], PDO::PARAM_STR);
	$stmt->bindValue(':mode_of_payment', $_REQUEST["payment_type"], PDO::PARAM_STR);
	$stmt->bindValue(':price', $_REQUEST["amount_paid"], PDO::PARAM_STR);
	$stmt->bindValue(':date_of_payment', date('Y-m-d'), PDO::PARAM_STR);
	$stmt->bindValue(':original_doc', $_FILES["payment_attachment"]["name"], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $e) {
	echo $e->getMessage();
}

$pdo = null;

echo "<script> alert('Payment Successful! Amount Paid: ₱" . number_format($_REQUEST["amount_paid"], 2) . "')</script>";
echo "<script>window.location.href='../client_dashboard.php';</script>";
exit;
