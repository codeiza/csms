<?php
session_start();
//Print_r($_SESSION);
date_default_timezone_set("Asia/manila");
	require_once 'connection.php';
 print_r($_REQUEST);
 
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

	$stmt = $pdo->prepare(
		"
		UPDATE payment
		SET
		delete_date = :delete_date
		WHERE
		id = :id
		"
	);
	$stmt->bindValue(':delete_date',date('Y-m-d h:i:s'),PDO::PARAM_STR);
	$stmt->bindValue(':id',$_REQUEST["id"],PDO::PARAM_INT);
	$stmt->execute();
	
} catch (PDOException $e) {
	echo $e->getMessage();
}
 
$pdo = null;