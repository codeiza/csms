<?php
print_r($_REQUEST);
require_once 'connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);	
	$stmt = $pdo->prepare(
		"SELECT * FROM users
		Where email = '".$_REQUEST["email"]."'
		"
		);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$id = $row["id"];
		}


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
$mail->Subject = 'Pasword reset';

$mail->Body = 'Please click here to reset your password ⇢ <a href="https://iglesiafilipinaindependiente.com/php/reset.php?id='.$id.'"> Reset Password </a> <br><br> Thank you. <br> <span style="color:red; font-size:10px">This is system generated; please do not reply.</span>';

if ($mail->send()) {
	    echo 'Check your email for a password reset';
	  echo "<script>alert('Check your email for a password reset.')</script>";
    echo "<script>window.location.href='../login.php';</script>";
} else {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}

}catch(PDOException $e){
	echo $e->getMessage();
}
$pdo = null;
?>