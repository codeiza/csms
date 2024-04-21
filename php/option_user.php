<?php
require_once 'connection.php';
try {
	$pdo = new PDO(DSN, DB_USR, DB_PWD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (@$_SESSION["user"]["accountType"] == 'Admin' || @$_SESSION["user"]["accountType"] == 'Priest') {
		$stmt = $pdo->prepare(
			"SELECT DISTINCT (userName), accountType, isOnline FROM users WHERE accountType IS NOT NULL ORDER BY userName ASC"
		);

		$stmt->execute();
	} else {
		$stmt = $pdo->prepare(
			"SELECT DISTINCT (userName), accountType, isOnline FROM users WHERE accountType != 'Client' ORDER BY userName ASC"
		);

		$stmt->execute();
	}

	$userName = '';

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$onlineColor = ($row["isOnline"] == 1) ? 'green' : 'black'; // Set color based on isOnline value
		$status = ($row["isOnline"] == 1) ? ' (Online)' : ''; // Add "(Online)" if user is online
		$userName .= '<option value="' . $row["userName"] . '" style="color:' . $onlineColor . ';">' . $row["userName"] . '(' . $row["accountType"] . ')' . $status . '</option>';
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}
$pdo = null;