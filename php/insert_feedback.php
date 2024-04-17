<?php
session_start();
//print_r($_REQUEST);
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO customer_feeback
		(ratings,message,customer_name)
		VALUES
		(:ratings,:message,:customer_name)"
	);
	$stmt->bindValue(':ratings',$_REQUEST["ratings"],PDO::PARAM_STR);
	$stmt->bindValue(':message',$_REQUEST["message"],PDO::PARAM_STR);
	$stmt->bindValue(':customer_name',$_SESSION["user"]["userName"],PDO::PARAM_STR);
	
	$stmt->execute();
	
	} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
  exit;
 ?>