<?php 
session_start();
require_once 'connection.php';

try{
	   $pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
	   "SELECT * FROM schedule_list
	   WHERE
	   (Status = 'Confirm_docs' or Status = 'For Payment' or Status = 'disapproved' or (Status = 'Confirm' AND start_datetime > '".date('Y-m-d')."%')) AND user_id = '".$_SESSION["user"]["id"]."' AND cancel_delete IS NULL
	   "
	   );
	 $stmt->execute();
	 $tbody ='';
	 $sNum = 1;
	 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$id=$row["id"];
		 if($row["Status"] == 'disapproved'){
		 $tbody .= '<tr style="color:red">';
		 }else{
		$tbody .= '<tr>';	 
		 }
		   $tbody .= '<td>'.$row["title"].'</td>';
			
		   $tbody .= '<td>'.$row["Status"].'</td>';	
		   $tbody .= '<td>₱' . number_format($row["amount_paid"], 2) . '</td>';
		   $tbody .= '<td>'.$row["start_datetime"].'</td>';	
		  if($row["Status"] == 'Confirm'){
		   $tbody .= '<td><p style="color: black; font-size: 14px;"</p><b>Attention:</b>&nbsp;'.$row["reserve_by"].'<br>
		   Good day! Your '.$row["event_type"].' schedule has been approved. To proceed
		    with your reservation, please make the payment in the Transactions under "For Pay" for your payment. Thank you!
		   </td>';
		  }else if($row["Status"] == 'Confirm_docs'){
			$tbody .= '<td><b>Attention:</b>&nbsp;'.$row["reserve_by"].'<br>
			We regret to inform you that your submitted document has been confirm and approved Please proceed for payment to continue your schedule.<a href="php/sample.php?id='.$id.'">Click me for payment</a>
		  </td>'; 
		  }else{
			 $tbody .= '<td><b>Attention:</b>&nbsp;'.$row["reserve_by"].'<br>
			 We regret to inform you that your schedule has been '.$row["Status"].'; feel free to reach out if you have any questions.
		   </td>';  
			  
		  }
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
		<th>Message</th>

		</tr>
		
	</thead>
	<tbody>
		<?php echo $tbody?>
	</tbody>
</table>