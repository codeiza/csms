<?php
session_start();
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['id']) && isset($_POST['column'])) {
		$id = $_POST['id'];
		$column = $_POST['column'];

		try {
			$pdo = new PDO(DSN, DB_USR, DB_PWD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// Update the specified column to the current user's username
			$stmt = $pdo->prepare("
                UPDATE schedule_list
                SET " . $_REQUEST["column"] . " = :username
                WHERE id = :id
            ");
			$stmt->bindParam(':username', $_SESSION["user"]["userName"], PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			// Update the status to 'Confirm'
			$stmt = $pdo->prepare("
                UPDATE schedule_list
                SET Status = 'Confirm'
                WHERE id = :id
            ");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();

			echo "Success";
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}
