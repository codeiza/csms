<html>
<h1>Verify here</h1>
<?php
//print_r($_REQUEST);
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	
	$stmt = $pdo->prepare(
		"
		UPDATE users
		SET
		email_verification = :email_verification
		WHERE
		id = :id
		"
	);
	 $stmt->bindValue(':id', $_REQUEST["id"], PDO::PARAM_INT);
    $stmt->bindValue(':email_verification',date('Y-m-d'), PDO::PARAM_STR);

    $stmt->execute();

	} catch (PDOException $e) {
	echo $e->getMessage();
}
 
$pdo = null;
  echo "<script>alert('Account verification successfully!')</script>";
echo "<script>window.location.href='../login.php';</script>";
    exit;
 ?>
</html>