<?php
session_start();
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO message
		(message_id,message,to_message,from_message)
		VALUES
		(:message_id,:message,:to_message,:from_message)"
	);
	$stmt->bindValue(':message_id',$_REQUEST["message_id"],PDO::PARAM_STR);
	$stmt->bindValue(':message',$_REQUEST["message"],PDO::PARAM_STR);
	$stmt->bindValue(':to_message',$_REQUEST["to_message"],PDO::PARAM_STR);
	$stmt->bindValue(':from_message',$_SESSION["user"]["userName"],PDO::PARAM_STR);
	
	$stmt->execute();
	
	} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
  echo "<script>alert('Reply send successfully!')</script>";
 echo "<script>window.location.href='../mass.php';</script>";
    exit;