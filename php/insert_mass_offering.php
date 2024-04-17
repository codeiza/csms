<?php
//print_r($_REQUEST);
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO payment
		(event_type,payors_name,mode_of_payment,price,date_of_payment)
		VALUES
		(:event_type,:payors_name,:mode_of_payment,:price,:date_of_payment)"
	);
	$stmt->bindValue(':event_type','Mass Offering',PDO::PARAM_STR);
	$stmt->bindValue(':payors_name',$_REQUEST["payors_name"],PDO::PARAM_STR);
	$stmt->bindValue(':mode_of_payment',$_REQUEST["mode_of_payment"],PDO::PARAM_STR);
	$stmt->bindValue(':price',$_REQUEST["price"],PDO::PARAM_STR);
	$stmt->bindValue(':date_of_payment',$_REQUEST["date_of_payment"],PDO::PARAM_STR);
	$stmt->execute();
	
	
} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
  echo "<script>alert('Thank you for your generous mass offering!')</script>";
  
  echo "<script>window.location.href='../mass_ofering.php';</script>";
    exit;
 ?>