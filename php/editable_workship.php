<?php
//print_r($_REQUEST);
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->query(
	     "
	     UPDATE workship
	     SET
	     ".$_REQUEST["column"]." = '".$_REQUEST["value"]."'
	     WHERE
	     id = ".$_REQUEST["id"]."
	     "
	     );

	
	
}catch(PDOException $e){
	echo $e->getMessage();
}



?>
