<?php 
require_once 'connection.php';

try{
	   $pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
	   "SELECT * FROM schedule_list
	   WHERE
	   Status = 'For Payment' and cancel_delete is null
	   "
	   );
	 $stmt->execute();
	 $tbody ='';
	 $sNum = 1;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$tbody .= '<tr>';
			
			$tbody .= '<td>'.$row["title"].'</td>';	
			$tbody .= '<td>'.$row["Status"].'</td>';	
			$tbody .= '<td>'.$row["amount_paid"].'</td>';	
			$tbody .= '<td>'.$row["start_datetime"].'</td>';	
			
			$tbody .= '<td><b>Name.:</b>'.$row["reserve_by"].'<br>Phone Number:</b>'.$row["contact_no"].'<br><b>Email:</b>'.$row["email"].'</td>';
	
		/*  
		   $tbody .= '<td>
		   <button class="btn btn-danger delete_notify" id="Status-'.$row["id"].'">delete Notification</button>
		   </td>';
		*/
		   $tbody .= '</tr>';
		
	 }
	 } catch (PDOExeption $e) {
	   echo $e->getMessage();
   }
   //echo $sample2;
   $pdo = null; 
?>

<table class="table table-striped table-condensed table-hover table-bordered">
	<thead class="btn-info">
		<tr>
		<th class="tsugtsug">Event</th>
		<th class="tsugtsug">Status</th>
		<th class="tsugtsug">Amount</th>
		<th>Date & Time Event</th>
		<th>Contact Info</th>

		</tr>
		
	</thead>
	<tbody>
		<?php echo $tbody?>
	</tbody>
</table>