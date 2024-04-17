 <?php
require_once 'connection.php';
//print_r($_REQUEST);
$where = "";
if($_REQUEST["searchkey"]){
		$where .="WHERE (wedding_husband_name like '".$_REQUEST["searchkey"]."%' or wedding_wife_name like '".$_REQUEST["searchkey"]."%' or bap_fullname like '".$_REQUEST["searchkey"]."%') AND Event_type = '".$_REQUEST["docType"]."' "; 
	 }else{
		 $where .="WHERE wedding_husband_name IS null";
	 }

try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);	
	$stmt = $pdo->prepare(
		"SELECT * FROM request_form
		
		".$where
		);
		$stmt->execute();
		$cnt = $stmt->rowCount();
		$tbody = '';
		$sNum = 1;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		
		
		
		if($_REQUEST["docType"] == 'Wedding'){
		$tbody .= '<tr>';
		$tbody .= '<td>'.$sNum.'</td>';
		$tbody .= '<td>'.$row["id"].'</td>';	
		$tbody .= '<td>'.$row["Event_type"].'</td>';
		$tbody .= '<td>'.$row["wedding_husband_name"].'</td>';	
		$tbody .= '<td>'.$row["wedding_wife_name"].'</td>';	
		//$tbody .= '<td>'.$row["wedding_officiant_name"].'</td>';
		$tbody .= '<td>'.$row["start_datetime_event"].'</td>';
		$tbody .= '</tr>';
		}elseif($_REQUEST["docType"] == 'Baptismal'){
		$tbody .= '<tr>';
		$tbody .= '<td>'.$sNum.'</td>';
		$tbody .= '<td>'.$row["id"].'</td>';	
		$tbody .= '<td>'.$row["Event_type"].'</td>';
		$tbody .= '<td>'.$row["bap_fullname"].'</td>';	
		$tbody .= '<td>'.$row["bap_date_of_birth"].'</td>';
		$tbody .= '<td>'.$row["bap_fatherName"].'</td>';
		$tbody .= '<td>'.$row["bap_motherName"].'</td>';
		$tbody .= '<td>'.$row["start_datetime_event"].'</td>';
		$tbody .= '</tr>';
		}else{
		}
		
		
        $sNum ++;	
		
	    }
}catch(PDOException $e){
	echo $e->getMessage();
}
$pdo = null;
?>
<?php if(!$cnt){
echo '<span style="font-size:50px; color:red;">No History of Event please contact the person or verify the document owner</span>';	
}else{ ?>
<table class="table table-striped table-condensed table-hover table-bordered">
	<thead class="bg-success">
		<tr>
		<th colspan="10" style="text-align:center;">EVENT SCHEDULE HISTORY </th>
		</tr>
		<tr>
			
			<?php if($_REQUEST["docType"] == 'Wedding'){ ?>
			<th class="head1">No.</th>
			<th class="head1">Event ID</th>
			<th class="head1">Event Type</th>
			<th class="head1">Wedding Groom Name</th>
			<th class="head1">Wedding Brides Name</th>
			<th class="head1">Date of Event</th>
			<?php }elseif($_REQUEST["docType"] == 'Baptismal'){ ?>
			<th class="head1">No.</th>
			<th class="head1">Event ID</th>
			<th class="head1">Event Type</th>
		    <th class="head1">Full Name</th>
			<th class="head1">Date of Birth</th>
			<th class="head1">Father Name</th>
			<th class="head1">Mother Name</th>
			<th class="head1">Date of Event</th>
	<?php	} ?>
			
		</tr>
	</thead>
	<tbody>
		<?php echo $tbody?>
	</tbody>
</table>
<?php }?>