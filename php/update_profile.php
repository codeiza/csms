<?php
//print_r($_REQUEST);
require_once 'connection.php';

// Check if a file is uploaded
if (!empty($_FILES["picture_data"]["name"])) {
    move_uploaded_file($_FILES["picture_data"]["tmp_name"], '../picture_data/' . $_FILES["picture_data"]["name"]);
}

try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare(
        "
		UPDATE users
		SET
		firstName = :firstName,
		lastName = :lastName,
		userName = :userName,
		password = :password,
		email = :email,
		phoneNumber = :phoneNumber,
		birthdate = :birthdate,
		Age = :Age,
		address = :address
		" . (!empty($_FILES["picture_data"]["name"]) ? ", picture_data = :picture_data" : "") . "
		WHERE
		id = :id
		"
    );

    $stmt->bindValue(':id', $_REQUEST["id"], PDO::PARAM_INT);
    $stmt->bindValue(':firstName', $_REQUEST["firstName"], PDO::PARAM_STR);
    $stmt->bindValue(':lastName', $_REQUEST["lastName"], PDO::PARAM_STR);
    $stmt->bindValue(':userName', $_REQUEST["userName"], PDO::PARAM_STR);
    $stmt->bindValue(':password', password_hash($_REQUEST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
    $stmt->bindValue(':email', $_REQUEST["email"], PDO::PARAM_STR);
    $stmt->bindValue(':phoneNumber', $_REQUEST["phoneNumber"], PDO::PARAM_STR);
    $stmt->bindValue(':birthdate', $_REQUEST["birthdate"], PDO::PARAM_STR);
    $stmt->bindValue(':Age', $_REQUEST["Age"], PDO::PARAM_INT);
    $stmt->bindValue(':address', $_REQUEST["address"], PDO::PARAM_STR);

    // Bind picture_data only if a file is uploaded
    if (!empty($_FILES["picture_data"]["name"])) {
        $stmt->bindValue(':picture_data', $_FILES["picture_data"]["name"], PDO::PARAM_STR);
    }

    $stmt->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}

$pdo = null;
echo "<script>alert('Profile updated successfully! <br> Please Login again your account.')</script>";
echo "<script>window.location.href='../login.php';</script>";
exit;
?>
