<?php
//print_r($_REQUEST);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	if($_REQUEST["column"] == 'phoneNumber' || $_REQUEST["column"] == 'email' || $_REQUEST["column"] == 'accountType' || $_REQUEST["column"] == 'firstName' || $_REQUEST["column"] == 'userName' || $_REQUEST["column"] == 'lastName'){
	$stmt = $pdo->query(
	     "
	     UPDATE users
	     SET
	     ".$_REQUEST["column"]." = '".$_REQUEST["value"]."'
	     WHERE
	     id = ".$_REQUEST["id"]."
	     "
	     );
	}else if($_REQUEST["column"] == 'amount_paid' || $_REQUEST["column"] == 'payment_type' ){
	$stmt = $pdo->query(
	     "
	     UPDATE schedule_list
	     SET
	     ".$_REQUEST["column"]." = '".$_REQUEST["value"]."'
	     WHERE
	     id = ".$_REQUEST["id"]."
	     "
	     );
	}else if($_REQUEST["col"] == 'verify'){
	
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
$mail->Subject = 'Payment Confirmation';

// Styling for the email body
$mail->Body = '
    <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.6;">
        <p>Good day!</p>
        <p>Your payment for the '.$_REQUEST["event"].' event has now been approved.</p>
        <p>Take note of the date and time: '.$_REQUEST["start"].'</p>
        <p>Thank you.</p>
        <p style="color: red; font-size: 10px;">This is a system-generated message; please do not reply.</p>
    </div>';

if ($mail->send()) {
    $stmt = $pdo->query(
        "
        UPDATE schedule_list
        SET
        ".$_REQUEST["column"]." = '".$_REQUEST["value"]."'
        WHERE
        id = ".$_REQUEST["id"]."
        "
    );
		 
		$stmt = $pdo->prepare(
		"INSERT INTO payment
		(request_form_id,event_type,payors_name,mode_of_payment,price,date_of_payment)
		VALUES
		(:request_form_id,:event_type,:payors_name,:mode_of_payment,:price,:date_of_payment)"
	);
	$stmt->bindValue(':request_form_id',$_REQUEST["request_form_id"],PDO::PARAM_STR);
	$stmt->bindValue(':event_type',$_REQUEST["event"],PDO::PARAM_STR);
	$stmt->bindValue(':payors_name',$_REQUEST["reserve_by"],PDO::PARAM_STR);
	$stmt->bindValue(':mode_of_payment',$_REQUEST["payment_type"],PDO::PARAM_STR);
	$stmt->bindValue(':price',$_REQUEST["amount_paid"],PDO::PARAM_STR);
	$stmt->bindValue(':date_of_payment',$_REQUEST["date_paid"],PDO::PARAM_STR);
	$stmt->execute(); 
    echo 'Email Sent Successfully!';
	  echo "<script>alert(''Successfully confirm and send it to the requestor')</script>";
    echo "<script>window.location.href='../schedule.php';</script>";
} else {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}
	
	
	}else{


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
$mail->Subject = 'Schedule Confirmation';

// Styling for the email body
if ($_REQUEST["payment_type"] == 'For Donation') {
    $mail->Body = '
        <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.6;">
            <p>Good day!</p>
            <p>Your schedule for the '.$_REQUEST["event"].' event has now been approved.</p>
            <p>Please proceed with your '.$_REQUEST["payment_type"].' and attach your receipt here ⇢ <a href="https://iglesiafilipinaindependiente.com/php/sample.php?id='.$_REQUEST["id"].'">Payment</a></p>
            <p>Take note of the date and time: '.$_REQUEST["start"].'</p>
            <p>Thank you.</p>
            <p style="color: red; font-size: 10px;">This is a system-generated message; please do not reply.</p>
        </div>';
} else {
    $mail->Body = '
        <div style="font-family: Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.6;">
            <p>Good day!</p>
            <p>Your schedule for the '.$_REQUEST["event"].' event is now already approved.</p>
            <p>Please proceed with your '.$_REQUEST["payment_type"].' amounting to '.$_REQUEST["amount_paid"].' and attach your receipt here ⇢ <a href="https://iglesiafilipinaindependiente.com/php/sample.php?id='.$_REQUEST["id"].'">Payment</a></p>
            <p>Take note of the date and time: '.$_REQUEST["start"].'</p>
            <p>Thank you.</p>
            <p style="color: red; font-size: 10px;">This is a system-generated message; please do not reply.</p>
        </div>';
}

if ($mail->send()) {
    $stmt = $pdo->query(
        "
        UPDATE schedule_list
        SET
        ".$_REQUEST["column"]." = '".$_REQUEST["value"]."'
        WHERE
        id = ".$_REQUEST["id"]."
        "
    );


/*		 
		$stmt = $pdo->prepare(
		"INSERT INTO payment
		(request_form_id,event_type,payors_name,mode_of_payment,price,date_of_payment)
		VALUES
		(:request_form_id,:event_type,:payors_name,:mode_of_payment,:price,:date_of_payment)"
	);
	$stmt->bindValue(':request_form_id',$_REQUEST["request_form_id"],PDO::PARAM_STR);
	$stmt->bindValue(':event_type',$_REQUEST["event"],PDO::PARAM_STR);
	$stmt->bindValue(':payors_name',$_REQUEST["reserve_by"],PDO::PARAM_STR);
	$stmt->bindValue(':mode_of_payment',$_REQUEST["payment_type"],PDO::PARAM_STR);
	$stmt->bindValue(':price',$_REQUEST["amount_paid"],PDO::PARAM_STR);
	$stmt->bindValue(':date_of_payment',$_REQUEST["date_paid"],PDO::PARAM_STR);
	$stmt->execute(); */
    echo 'Email sent successfully';
	  echo "<script>alert('Successfully confirm and send it to the requestor')</script>";
    echo "<script>window.location.href='../schedule.php';</script>";
} else {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}
	    
	
}
	
	
}catch(PDOException $e){
	echo $e->getMessage();
}



?>
