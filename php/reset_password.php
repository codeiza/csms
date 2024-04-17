<?php 
require_once 'connection.php';
//move_uploaded_file($_FILES["picture_data"]["tmp_name"],'../picture_data/'.$_FILES["picture_data"]["name"]);
//print_r($_REQUEST);
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	
	$stmt = $pdo->prepare(
		"
		UPDATE users
		SET
		password = :password
	
		WHERE
		id = :id
		"
	);
	$stmt->bindValue(':id',$_REQUEST["id"],PDO::PARAM_INT);
	$stmt->bindValue(':password', password_hash($_REQUEST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
	$stmt->execute();

	} catch (PDOException $e) {
	echo $e->getMessage();
}
 
$pdo = null;
 echo "<script>alert('Password Reset Successfully')</script>";
 echo "<script>window.location.href='../login.php';</script>";
    exit;
?>