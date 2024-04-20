<?php
session_start();
print_r($_REQUEST);
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	if($_REQUEST["column"] == 'comment'){
		$stmt = $pdo->query(
			 "
			 UPDATE schedule_list
			 SET
			 ".$_REQUEST["column"]." = '".$_REQUEST["value"]."'
			 WHERE
			 id = ".$_REQUEST["id"]." 
			 "
			 );
		
	}else{
		$stmt = $pdo->query(
			 "
			 UPDATE schedule_list
			 SET
			 ".$_REQUEST["column"]." = '".$_SESSION["user"]["userName"]."',
			 Status = 'Cancel',
			 cancel_delete = '".date('Y-m-d')."'
			 WHERE
			 id = ".$_REQUEST["id"]."
			 "
			 );
	}		 
	}catch(PDOException $e){
	echo $e->getMessage();
}	 