<?php
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);	
	$stmt = $pdo->prepare(
		"SELECT * FROM message
		WHERE message_id = '".$_REQUEST["id"]."'
		"
		);
		$stmt->execute();
		$cnt = $stmt->rowCount();
		$tbody = '';
		$sNum = 1;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$id = $row["id"];
			$message_id = $row["message_id"];
			$from_message = $row["from_message"];
			$to_message = $row["to_message"];
			$message = $row["message"];
		echo '<div class="row mt-5">';
        echo '    <div class="col-md-6 offset-md-3">';
        echo '        <div class="card">';
        echo '            <div class="card-body">';
        echo '                <p class="card-text">' . $_REQUEST["message"] . '</p>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
		 
		echo '<div class="row mt-5">';
        echo '    <div class="col-md-6 offset-md-3">';
        echo '        <div class="card">';
        echo '            <div class="card-body">';
        echo '                <p class="card-text">' . $message . '</p>';
        echo '            </div>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
	    }
}catch(PDOException $e){
	echo $e->getMessage();
}
$pdo = null;
?>

<form  method="post" action="php/insert_reply.php" enctype="multipart/form-data">

<input type="hidden" value="<?php echo $_REQUEST["from_message"] ?>" name="to_message"/>
<input type="hidden" value="<?php echo $_REQUEST["id"] ?>" name="message_id" />
<div class="col-md-6 offset-md-3">
<textarea class="form-control" placeholder="Input reply here" name="message"></textarea>
</div>
<input type="submit" class="btn btn-success" value="send" />
<form>
<?php