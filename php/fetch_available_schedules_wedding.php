<?php

require_once 'connection.php';

if (isset($_POST['selectedDateTime']) && isset($_POST['eventType'])) {
    try {
        $selectedDateTime = $_POST['selectedDateTime'];
        $eventType = $_POST['eventType'];

        $pdo = new PDO(DSN, DB_USR, DB_PWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $selectedDate = date('Y-m-d', strtotime($selectedDateTime));
        $selectedAMPM = date('A', strtotime($selectedDateTime));


        $stmt = $pdo->prepare("
            SELECT *
            FROM schedule_list
            WHERE title = 'Wedding'
            AND DATE(start_datetime) = :selectedDate
            AND DATE_FORMAT(start_datetime, '%p') = :selectedAMPM
            AND cancel_delete IS NULL
        ");

        $stmt->bindParam(':selectedDate', $selectedDate);
        $stmt->bindParam(':selectedAMPM', $selectedAMPM);
        $stmt->execute();
		$cnt = $stmt->rowCount();

      if($cnt == '1' && $eventType == 'Regular'){
	  echo 0;
	  }elseif($cnt == '0' && $eventType == 'Regular'){
	  echo 1;
	   }elseif($cnt < '15' && $eventType == 'Special(kasalang bayan)'){
	  echo 15;
	   }elseif($cnt >= '15' && $eventType == 'Special(kasalang bayan)'){
	  echo 0;
	   }else{
	   echo 0;
	   }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
