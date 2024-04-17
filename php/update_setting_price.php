<?php
require_once 'connection.php';
//print_r($_REQUEST);
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	
	$stmt = $pdo->prepare(
		"
		UPDATE setting_of_prices
		SET
        price = :price
		WHERE
		id = :id
		"
	);
	 $stmt->bindValue(':id', $_REQUEST["id"], PDO::PARAM_INT);
    $stmt->bindValue(':price', $_REQUEST["value"], PDO::PARAM_STR);
   
    $stmt->execute();

	} catch (PDOException $e) {
	echo $e->getMessage();
}
 
$pdo = null;
 // echo "<script>alert('Updated Successfully')</script>";
//echo "<script>window.location.href='../user.php';</script>";
    exit;
 ?>