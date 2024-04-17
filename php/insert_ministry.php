<?php
//print_r($_REQUEST);
require_once 'connection.php';
move_uploaded_file($_FILES["Picture"]["tmp_name"],'../Picture/'.$_FILES["Picture"]["name"]);
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO workship
		(Picture,firstName,lastName,email,phoneNumber,birthdate,Age,address)
		VALUES
		(:Picture,:firstName,:lastName,:email,:phoneNumber,:birthdate,:Age,:address)"
	);
	$stmt->bindValue(':Picture',$_FILES["Picture"]["name"],PDO::PARAM_STR);
	$stmt->bindValue(':firstName',$_REQUEST["firstName"],PDO::PARAM_STR);
	$stmt->bindValue(':lastName',$_REQUEST["lastName"],PDO::PARAM_STR);
	$stmt->bindValue(':email',$_REQUEST["email"],PDO::PARAM_STR);
	$stmt->bindValue(':phoneNumber',$_REQUEST["phoneNumber"],PDO::PARAM_STR);
	$stmt->bindValue(':birthdate',$_REQUEST["birthdate"],PDO::PARAM_STR);
	$stmt->bindValue(':Age',$_REQUEST["Age"],PDO::PARAM_STR);
	$stmt->bindValue(':address',$_REQUEST["address"],PDO::PARAM_STR);
	
	
	$stmt->execute();
	
} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
  echo "<script>alert('Ministry member added successfully!')</script>";
 echo "<script>window.location.href='../worship.php';</script>";
    exit;
 ?>