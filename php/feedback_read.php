 <?php
require_once 'connection.php';
//print_r($_REQUEST);
/*
$where = "";
if($_REQUEST["searchkey"]){
		$where .="WHERE (wedding_groom_name like '".$_REQUEST["searchkey"]."%' or wedding_bride_name like '".$_REQUEST["searchkey"]."%' or child_first_name like '".$_REQUEST["searchkey"]."%' or child_last_name like '".$_REQUEST["searchkey"]."%')  "; 
	 }else{
		 $where .="WHERE wedding_groom_name IS null";
	 }
*/
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);	
	$stmt = $pdo->prepare(
		"SELECT * FROM customer_feeback
		
		"
		);
		$stmt->execute();
		$cnt = $stmt->rowCount();
		$tbody = '';
		$sNum = 1;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$customer_name = $row["customer_name"];
			$ratings = $row["ratings"];
			$message = $row["message"];
			echo '<div class="row mt-5">';
        echo '    <div class="col-md-6 offset-md-3">';
        echo '        <div class="card">';
        echo '            <div class="card-body">';
        echo '                <h5 class="card-title">Client Name: ' . $customer_name . '</h5>';
        echo '                <h5 class="card-title">Rating: ' . $ratings . '</h5>';
        echo '                <p class="card-text">Message: ' . $message . '</p>';
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
			

