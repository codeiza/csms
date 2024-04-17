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
$mail->Subject = 'Document Request for Payment';
$mail->Body = 'Good day! <br><br> Your Document Request for the '.$_REQUEST["event_type"]. ' is now already approved. <br>
Please proceed with your'.$_REQUEST["request_status"].' and attach your receipt here ⇢ <a href="https://iglesiafilipinaindependiente.com/php/requestD_payment.php?id='.$_REQUEST["id"].'"> Payment</a> <br><br> Thank you. <br><br> <span style="color:red; font-size:10px">This is system-generated; please do not reply.</span>';
if ($mail->send()) {
	 
	 $stmt = $pdo->prepare(
		"
		UPDATE requested_document
		SET
		request_status = :request_status,
		amount = :amount
		WHERE
		id = :id
		"
	);
	$stmt->bindValue(':id',$_REQUEST["id"],PDO::PARAM_INT);
	$stmt->bindValue(':request_status',$_REQUEST["request_status"],PDO::PARAM_INT);
	$stmt->bindValue(':amount',$_REQUEST["amount"],PDO::PARAM_INT);
	$stmt->execute();
	//echo 'Email sent successfully';
	echo "<script> alert('Email Sent Successfully!')</script>";
	echo "<script>window.location.href='../document.php';</script>";
	} else {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}
	} catch (PDOException $e) {
	echo $e->getMessage();
}
 
$pdo = null;
?>