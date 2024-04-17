<?php
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	 $stmt = $pdo->query(
        "
        UPDATE schedule_setting
        SET
        ".$_REQUEST["column"]." = '".$_REQUEST["value"]."'
        WHERE
        id = ".$_REQUEST["id"]."
        "
    );
	
	}catch(PDOException $e){
	echo $e->getMessage();
}
