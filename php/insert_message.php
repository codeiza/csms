<?php
session_start();
//print_r($_REQUEST);
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO message
		(to_message,message,from_message)
		VALUES
		(:to_message,:message,:from_message)"
	);
	$stmt->bindValue(':to_message',$_REQUEST["to_message"],PDO::PARAM_STR);
	$stmt->bindValue(':message',$_REQUEST["message"],PDO::PARAM_STR);
	$stmt->bindValue(':from_message',$_SESSION["user"]["userName"],PDO::PARAM_STR);
	
	$stmt->execute();
	
	} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
  exit;
 ?>