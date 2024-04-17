<?php
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	
	$stmt = $pdo->prepare(
		"
		UPDATE users
		SET
		firstName = :firstName,
		lastName = :lastName,
		userName = :userName,
		email = :email,
		phoneNumber = :phoneNumber,
		birthdate = :birthdate,
		Age = :Age,
		address = :address
		WHERE
		id = :id
		"
	);
	 $stmt->bindValue(':id', $_REQUEST["id"], PDO::PARAM_INT);
    $stmt->bindValue(':firstName', $_REQUEST["firstName"], PDO::PARAM_STR);
    $stmt->bindValue(':lastName', $_REQUEST["lastName"], PDO::PARAM_STR);
    $stmt->bindValue(':userName', $_REQUEST["userName"], PDO::PARAM_STR);
    $stmt->bindValue(':email', $_REQUEST["email"], PDO::PARAM_STR);
    $stmt->bindValue(':phoneNumber', $_REQUEST["phoneNumber"], PDO::PARAM_STR);
    $stmt->bindValue(':birthdate', $_REQUEST["birthdate"], PDO::PARAM_STR);
    $stmt->bindValue(':Age', $_REQUEST["Age"], PDO::PARAM_INT);
    $stmt->bindValue(':address', $_REQUEST["address"], PDO::PARAM_STR);
    $stmt->execute();

	} catch (PDOException $e) {
	echo $e->getMessage();
}
 
$pdo = null;
  echo "<script>alert('Updated Successfully')</script>";
echo "<script>window.location.href='../user.php';</script>";
    exit;
 ?>