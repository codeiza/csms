<?php
session_start();
//print_r($_REQUEST);
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"INSERT INTO users
		(accountType,firstName,lastName,userName,password,email,phoneNumber,birthdate,Age,address)
		VALUES
		(:accountType,:firstName,:lastName,:userName,:password,:email,:phoneNumber,:birthdate,:Age,:address)"
	);
	$stmt->bindValue(':accountType',$_REQUEST["accountType"],PDO::PARAM_STR);
	$stmt->bindValue(':firstName',$_REQUEST["firstName"],PDO::PARAM_STR);
	$stmt->bindValue(':lastName',$_REQUEST["lastName"],PDO::PARAM_STR);
	$stmt->bindValue(':userName',$_REQUEST["userName"],PDO::PARAM_STR);
	//$stmt->bindValue(':password',$_REQUEST["password"],PDO::PARAM_STR);
	$stmt->bindValue(':password', password_hash($_REQUEST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
	$stmt->bindValue(':email',$_REQUEST["email"],PDO::PARAM_STR);
	$stmt->bindValue(':phoneNumber',$_REQUEST["phoneNumber"],PDO::PARAM_STR);
	$stmt->bindValue(':birthdate',$_REQUEST["birthdate"],PDO::PARAM_STR);
	$stmt->bindValue(':Age',$_REQUEST["Age"],PDO::PARAM_STR);
	$stmt->bindValue(':address',$_REQUEST["address"],PDO::PARAM_STR);
	//$stmt->bindValue(':from_message',$_SESSION["user"]["userName"],PDO::PARAM_STR);
	
	$stmt->execute();
	
	} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;
  echo "<script>alert('User added successfully!)</script>";
 echo "<script>window.location.href='../user.php';</script>";
    exit;