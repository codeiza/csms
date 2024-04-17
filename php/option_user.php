<?php
require_once 'connection.php';
try {
		$pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if (@$_SESSION["user"]["accountType"] == 'Admin' || $_SESSION["user"]["accountType"] == 'Priest'){
		$stmt = $pdo->prepare(
			"SELECT DISTINCT (userName),accountType FROM users where accountType is not null  ORDER BY userName ASC"
		);
		
		$stmt->execute();
		}else{
		$stmt = $pdo->prepare(
			"SELECT DISTINCT (userName),accountType FROM users where accountType != 'Client'  ORDER BY userName ASC"
		);
		
		$stmt->execute();	
		}
		
		$userName = '';
	
		while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
			
			$userName.= '<option value="'.$row["userName"].'" style="color:black;">'.$row["userName"].'('.$row["accountType"].')</option>';
			
			
		}
	} catch( PDOException $e ) {
		echo $e->getMessage();
	}	
	$pdo = null;
	
	

	//echo $team;
?>