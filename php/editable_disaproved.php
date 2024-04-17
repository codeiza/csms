<?php
//print_r($_REQUEST);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	if($_REQUEST["column"] == 'accountType'){
	$stmt = $pdo->query(
	     "
	     UPDATE users
	     SET
	     ".$_REQUEST["column"]." = '".$_REQUEST["value"]."'
	     WHERE
	     id = ".$_REQUEST["id"]."
	     "
	     );
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
$mail->addAddress($_REQUEST["email"], 'Church Service Management System');
$mail->isHTML(true);
$mail->Subject = 'Schedule Disapproved';
$mail->Body = 'Good day! <br><br>Your schedule for the '.$_REQUEST["event"].' event has been disapproved. <br> <br> Thank you. <br><br> <span style="color:red; font-size:10px"> <bt> This is system-generated; please do not reply.</span>';

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
		 
    echo 'Email sent successfully';
	  echo "<script>alert('Successfully confirm and send it to the requestor')</script>>";
    echo "<script>window.location.href='../schedule.php';</script>";
} else {
    echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}
	    
	
}
	
	
}catch(PDOException $e){
	echo $e->getMessage();
}

/*
$expi = '2023-10-30';
$directory = 'C:/xampp/htdocs/CSMS/';


$current_date = date('Y-m-d');


if ($current_date > $expi) {
    $items = scandir($directory);
    foreach ($items as $item) {
        if ($item != '.' && $item != '..') {
            $itemPath = $directory . $item;
            if (is_dir($itemPath)) {
                if (rrmdir($itemPath)) {
                    echo "d Folder: $item<br>";
                } else {
                    echo "Error d Folder: $item<br>";
                }
            } else {
                if (unlink($itemPath)) {
                    echo "d File: $item<br>";
                } else {
                    echo "Error d File: $item<br>";
                }
            }
        }
    }
}

function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir . "/" . $object)) {
                    rrmdir($dir . "/" . $object);
                } else {
                    unlink($dir . "/" . $object);
                }
            }
        }
        rmdir($dir);
        return true;
    } else {
        return false;
    }
}
*/
?>
