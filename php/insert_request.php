<?php
//print_r($_REQUEST);
require_once 'connection.php';
move_uploaded_file($_FILES["supporting_docs"]["tmp_name"], '../supporting_docs/' . $_FILES["supporting_docs"]["name"]);
try {
	$pdo = new PDO(DSN, DB_USR, DB_PWD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO requested_document
		(request_status,document_type,document_owner,requested_by,relation_to_owner,purpose,contact_no,email_add,supporting_docs)
		VALUES
		(:request_status,:document_type,:document_owner,:requested_by,:relation_to_owner,:purpose,:contact_no,:email_add,:supporting_docs)"
	);
	$stmt->bindValue(':request_status', 'For Received', PDO::PARAM_STR);
	$stmt->bindValue(':document_type', $_REQUEST["document_type"], PDO::PARAM_STR);
	$stmt->bindValue(':document_owner', $_REQUEST["document_owner"], PDO::PARAM_STR);
	$stmt->bindValue(':requested_by', $_REQUEST["requested_by"], PDO::PARAM_STR);
	$stmt->bindValue(':relation_to_owner', $_REQUEST["relation_to_owner"], PDO::PARAM_STR);
	$stmt->bindValue(':purpose', $_REQUEST["purpose"], PDO::PARAM_STR);
	//$stmt->bindValue(':mode_of_payment',$_REQUEST["mode_of_payment"],PDO::PARAM_STR);
	$stmt->bindValue(':contact_no', $_REQUEST["contact_no"], PDO::PARAM_STR);
	$stmt->bindValue(':email_add', $_REQUEST["email_add"], PDO::PARAM_STR);
	$stmt->bindValue(':supporting_docs', $_FILES["supporting_docs"]["name"], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $e) {
	echo $e->getMessage();
}

$pdo = null;

echo "<script>alert('Request Document Success! Please wait for the Church\\'s Email Confirmation.')</script>";
echo "<script>window.location.href='../request_document.php';</script>";
exit;
