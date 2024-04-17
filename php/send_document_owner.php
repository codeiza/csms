<?php

//print_r($_REQUEST);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	
	
	
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'iglesiafilipinaparish@gmail.com';
$mail->Password = 'cwgw kaey dnco tqen';

$mail->SMTPSecure = 'tls';

$mail->setFrom($_REQUEST["email"], 'Church Service Management System'); // Sender's email address and name
$mail->addAddress($_REQUEST["email"], 'Church Service Management System'); // Recipient's email address and name
$mail->isHTML(true);
$mail->Subject = 'Document request confirm';
$attachment = $_FILES['payment_attachment']['tmp_name'];
$mail->addAttachment($attachment, $_FILES['payment_attachment']['name']);
$mail->Body = 'Good day! <br><br> I attached the copy of your document request.<br>The original copy is now available, please pick up during office hours at 8:00am to 5:00pm<br><br>  Thank you. <br> <span style="color:red; font-size:10px">This is system generated; please do not reply.</span>';
if ($mail->send()) {
	 
	 $stmt = $pdo->prepare(
		"
		UPDATE requested_document
		SET
		request_status = :request_status,
		original_document = :original_document

		WHERE
		id = :id
		"
	);
	$stmt->bindValue(':id',$_REQUEST["id"],PDO::PARAM_INT);
	$stmt->bindValue(':request_status','For pickup',PDO::PARAM_INT);
	$stmt->bindValue(':original_document',$_FILES["payment_attachment"]["name"],PDO::PARAM_STR);
	$stmt->execute();
	//echo 'Email sent successfully';
	move_uploaded_file($_FILES["payment_attachment"]["tmp_name"],'../parent_signature/'.$_FILES["payment_attachment"]["name"]);
	echo "<script> alert('Document Sent Successfully!')</script>";
	echo "<script>window.location.href='../document.php';</script>";
	} else {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}
	} catch (PDOException $e) {
	echo $e->getMessage();
}
 
$pdo = null;
?>