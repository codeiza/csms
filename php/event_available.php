<style>
.click_wed:hover,.click_bap:hover,.click_link:hover{
	color:blue
}
</style>
<?php
 require_once 'connection.php';
try{
	   $pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare("SELECT * FROM schedule_list WHERE start_datetime like '".$_REQUEST["selectedDate"]."%' and event_type = 'wedding'");
		$stmt->execute();

// Wedding event
$cnt_weddingAM = 0;
$cnt_weddingPM = 0;
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $result) {
    $startdate = $result['start_datetime']; //format 2023-10-25 07:00:00
    $timestamp = strtotime($startdate);
    $ampm = date("A", $timestamp);

    if ($ampm === "AM") {
        $cnt_weddingAM++;
    } elseif ($ampm === "PM") {
        $cnt_weddingPM++;
    }
}
$dateString = $_REQUEST["selectedDate"]; // Assuming the format is dd-mm-yyyy
$date = DateTime::createFromFormat('Y-m-d', $dateString);

 if($cnt_weddingAM >= '1' || ($date->format('w') == 0 || $date->format('w') == 6)){
	 $amwedding = '<span style="color:red">Not Available</span>';
 }else{
	 $amwedding = 'Available';
 }
  if($cnt_weddingPM >= '1' || ($date->format('w') == 0 || $date->format('w') == 6)){
	 $pmwedding = '<span style="color:red">Not Available</span>';
 }else{
	 $pmwedding = 'Available';
 }

// Baptismal event
$stmt1 = $pdo->prepare("
    SELECT 
    COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '06:00' THEN 1 END) AS count_6am,
    COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '07:00' THEN 1 END) AS count_7am,
    COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '08:00' THEN 1 END) AS count_8am,
    COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '09:00' THEN 1 END) AS count_9am,
    COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '10:00' THEN 1 END) AS count_10am,
    COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '11:00' THEN 1 END) AS count_11am,
    COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '12:00' THEN 1 END) AS count_12pm,
    COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '01:00' THEN 1 END) AS count_1pm,
    COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '02:00' THEN 1 END) AS count_2pm,
     COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '03:00' THEN 1 END) AS count_3pm,
    COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '04:00' THEN 1 END) AS count_4pm,
    COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '05:00' THEN 1 END) AS count_5pm
FROM schedule_list 
WHERE DATE(start_datetime) = :selectedDate 
    AND event_type = 'Baptismal';

");

$selectedDate = $_REQUEST["selectedDate"] . '%';
$stmt1->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
$stmt1->execute();
while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
  $count_6am = $row1['count_6am'];
  $count_7am = $row1['count_7am'];	
  $count_8am = $row1['count_8am'];	
  $count_9am = $row1['count_9am'];	
  $count_10am = $row1['count_10am'];	
  $count_11am = $row1['count_11am'];	
  $count_12pm = $row1['count_12pm'];	
  $count_1pm = $row1['count_1pm'];	
  $count_2pm = $row1['count_2pm'];	
  $count_3pm = $row1['count_3pm'];	
  $count_4pm = $row1['count_4pm'];	
  $count_5pm = $row1['count_5pm'];	
	
	///baptismal table
	$stmt2 = $pdo->prepare(
		"SELECT * FROM schedule_setting
		where event = 'Baptismal'
		"
		);
	$stmt2->execute();
	$tbody = '';
	while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
		///Funeral
	$stmt26 = $pdo->prepare("
		SELECT 
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '06:00' THEN 1 END) AS count_6am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '07:00' THEN 1 END) AS count_7am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '08:00' THEN 1 END) AS count_8am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '09:00' THEN 1 END) AS count_9am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '10:00' THEN 1 END) AS count_10am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '11:00' THEN 1 END) AS count_11am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '12:00' THEN 1 END) AS count_12pm,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '01:00' THEN 1 END) AS count_1pm,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '02:00' THEN 1 END) AS count_2pm,
		 COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '03:00' THEN 1 END) AS count_3pm,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '04:00' THEN 1 END) AS count_4pm,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '05:00' THEN 1 END) AS count_5pm
	FROM schedule_list 
	WHERE DATE(start_datetime) = :selectedDate 
		AND event_type = 'Funeral';

	");

	$selectedDate = $_REQUEST["selectedDate"] . '%';
	$stmt26->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
	$stmt26->execute();
	while ($row123 = $stmt26->fetch(PDO::FETCH_ASSOC)) {
	  $count_6amf = $row123['count_6am'];
	  $count_7amf = $row123['count_7am'];	
	  $count_8amf = $row123['count_8am'];	
	  $count_9amf = $row123['count_9am'];	
	  $count_10amf = $row123['count_10am'];	
	  $count_11amf = $row123['count_11am'];	
	  $count_12pmf = $row123['count_12pm'];	
	  $count_1pmf = $row123['count_1pm'];	
	  $count_2pmf = $row123['count_2pm'];	
	  $count_3pmf = $row123['count_3pm'];	
	  $count_4pmf = $row123['count_4pm'];	
	  $count_5pmf = $row123['count_5pm'];
	}
	$date = DateTime::createFromFormat('Y-m-d', $dateString);
		if($row2["time"] =='6:00 AM'){
			if($count_6amf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_6am;
			}
		}else if($row2["time"] =='7:00 AM'){
			if($count_7amf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_7am;
			}
		}else if($row2["time"] =='8:00 AM'){
			if($count_8amf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_8am;
			}
		}else if($row2["time"] =='9:00 AM'){
			if($count_9amf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_9am;
			}
		}else if($row2["time"] =='10:00 AM'){
			if($count_10amf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_10am;
			}
		}else if($row2["time"] =='11:00 AM'){
			if($count_11amf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_11am;
			}
		}else if($row2["time"] =='12:00 NN'){
			if($count_12pmf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_12pm;
			}
		}else if($row2["time"] =='1:00 PM'){
			if($count_1pmf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_1pm;
			}
		}else if($row2["time"] =='2:00 PM'){
			if($count_2pmf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_2pm;
			}
		}else if($row2["time"] =='3:00 PM'){
			if($count_3pmf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_3pm;
			}
		}else if($row2["time"] =='4:00 PM'){
			if($count_4pmf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_4pm;
			}
		}else if($row2["time"] =='5:00 PM'){
			if($count_5pmf >0){
				$numberOfDays =0;
			}else{
			$numberOfDays = $row2["days"]-$count_5pm;
			}
		}else{
			$numberOfDays = $row2["days"];	
		}
	 $tbody .= '<tr>';
	 $tbody .= '<td>'.$row2["time"].'</td>';
	 if($date->format('w') == 0 && $row2["time"] =='6:00 AM' ){
		 $tbody .= '<td style="color:red">Not Available</td>';
	 }else{
		 if($numberOfDays >0){
		$tbody .= '<td class="click_bap" datetime_bap="'.$row2["time"].'">'.$numberOfDays.' - Available</td>';
		 }else{
		$tbody .= '<td style="color:red">Not Available</td>';	 
		 }
	 }
	 $tbody .= '</tr>';
	}
	///Funeral
	$stmt2 = $pdo->prepare("
		SELECT 
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '06:00' THEN 1 END) AS count_6am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '07:00' THEN 1 END) AS count_7am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '08:00' THEN 1 END) AS count_8am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '09:00' THEN 1 END) AS count_9am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '10:00' THEN 1 END) AS count_10am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '11:00' THEN 1 END) AS count_11am,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '12:00' THEN 1 END) AS count_12pm,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '01:00' THEN 1 END) AS count_1pm,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '02:00' THEN 1 END) AS count_2pm,
		 COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '03:00' THEN 1 END) AS count_3pm,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '04:00' THEN 1 END) AS count_4pm,
		COUNT(CASE WHEN DATE_FORMAT(start_datetime, '%h:%i') = '05:00' THEN 1 END) AS count_5pm
	FROM schedule_list 
	WHERE DATE(start_datetime) = :selectedDate 
		AND event_type = 'Funeral';

	");

	$selectedDate = $_REQUEST["selectedDate"] . '%';
	$stmt2->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
	$stmt2->execute();
	///Funeral while
	while ($row12 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
	  $count_6amf = $row12['count_6am'];
	  $count_7amf = $row12['count_7am'];	
	  $count_8amf = $row12['count_8am'];	
	  $count_9amf = $row12['count_9am'];	
	  $count_10amf = $row12['count_10am'];	
	  $count_11amf = $row12['count_11am'];	
	  $count_12pmf = $row12['count_12pm'];	
	  $count_1pmf = $row12['count_1pm'];	
	  $count_2pmf = $row12['count_2pm'];	
	  $count_3pmf = $row12['count_3pm'];	
	  $count_4pmf = $row12['count_4pm'];	
	  $count_5pmf = $row12['count_5pm'];	
		
	///Funeral table
	$stmt2 = $pdo->prepare(
		"SELECT * FROM schedule_setting
		where event = 'Funeral'
		"
		);
	$stmt2->execute();
	$tbody1 = '';
	while ($row23 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
			$daysSched = $row23["days"];
		if($row23["time"] =='6:00 AM'){
			if($count_6am >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_6amf;
			}
		}else if($row23["time"] =='7:00 AM'){
			if($count_7am >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_7amf;
			}
		}else if($row23["time"] =='8:00 AM'){
			if($count_8am >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_8amf;
			}
		}else if($row23["time"] =='9:00 AM'){
			if($count_9am >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_9amf;
			}
		}else if($row23["time"] =='10:00 AM'){
			if($count_10am >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_10amf;
			}
		}else if($row23["time"] =='11:00 AM'){
			if($count_11am >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_11amf;
			}
		}else if($row23["time"] =='12:00 NN'){
			if($count_12pm >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_12pmf;
			}
		}else if($row23["time"] =='1:00 PM'){
			if($count_1pm >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_1pmf;
			}
		}else if($row23["time"] =='2:00 PM'){
			if($count_2pm >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_2pmf;
			}
		}else if($row23["time"] =='3:00 PM'){
			if($count_3pm >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_3pmf;
			}
		}else if($row23["time"] =='4:00 PM'){
			if($count_4pm >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_4pmf;
			}
		}else if($row23["time"] =='5:00 PM'){
			if($count_5pm >0){
				$funeNumberDays =0;
			}else{
			$funeNumberDays = $daysSched-$count_5pmf;
			}
		}else{
			$funeNumberDays = $daysSched;	
		}
	$date = DateTime::createFromFormat('Y-m-d', $dateString);
	 $tbody1 .= '<tr>';
	 $tbody1 .= '<td>'.$row23["time"].'</td>';
	 if($date->format('w') == 0 && $row23["time"] =='6:00 AM' ){
		 $tbody1 .= '<td style="color:red">Not Available</td>';
	 }else{
		 if($funeNumberDays >0){
			$tbody1 .= '<td class="click_link" fune_dateTime="'.$row23["time"].'">'.$funeNumberDays.' - Available</td>';
		}else{
			$tbody1 .= '<td style="color:red">Not Available</td>';	 
		 }
	 }
	 $tbody1 .= '</tr>';
	}

	}
	

}

	 } catch (PDOExeption $e) {
	   echo $e->getMessage();
   }
   //echo $sample2;
   $pdo = null; 


?>
<input type="hidden" id="date_click" class="form-control" value="<?php echo $_REQUEST["selectedDate"]; ?> ">
<html>
<div class="row">
<div class="col-sm-4">
<table class="table table-striped table-condensed table-hover table-bordered">
	<thead class="btn-info">
	<tr>
	<th colspan="2" style="text-align:center">Wedding</th>
	</tr>
		<tr>
		<th>Time</th>
		<th>Status</th>
		</tr>
		
	</thead>
	<tbody>
		<tr>
		<td>AM</td>
		<td class="click_wed" time= "7:00AM"><?php echo $amwedding; ?></td>
		</tr>
		
		<tr>
		<td>PM</td>
		<td class="click_wed" time= "5:00AM"><?php echo $pmwedding; ?></td>
		
		</tr>
	</tbody>
</table>
</div>
<div class="col-sm-4">
<table class="table table-striped table-condensed table-hover table-bordered">
	<thead class="btn-primary">
	<tr>
	<th colspan="2" style="text-align:center">Baptismal</th>
	</tr>
		<tr>
		<th>Time</th>
		<th>Status</th>
		</tr>
		
	</thead>
	<tbody>
	<?php echo $tbody ?>
		
	
	</tbody>
</table>
</div>
<div class="col-sm-4">
<table class="table table-striped table-condensed table-hover table-bordered">
	<thead class="btn-danger">
	<tr>
	<th colspan="2" style="text-align:center">Funeral</th>
	</tr>
		<tr>
			<th>Time</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tbody1; ?>
	</tbody>
</table>
</div>
<center>
<div class="col-sm-6">
<table class="table table-striped table-condensed table-hover table-bordered">
	<thead class="btn-success">
	<tr>
	<th colspan="2" style="text-align:center">Regular Mass</th>
	</tr>
		<tr>
		<th>Day</th>
		<th>Time</th>
		</tr>
		
	</thead>
	<tbody>
		<tr>
		<td>Wednesday</td>
		<td>6:00 PM</td>
		</tr>
		<tr>
		<td>Friday</td>
		<td>6:00 PM</td>
		</tr>
		<tr>
		<td>Sunday</td>
		<td>6:00 AM and 6:00 PM</td>
		
		</tr>
		
		
	</tbody>

</table>
</div>
</center>
</div>
</html>
<script>
/*
$(document).on('click','.click_link',function(){
	var sample = $(this).attr('datetimew')
	 $.ajax({
					type:'post',
					url: 'funeral.php',
					data:{
						datetime : sample

					}
				}).done(function (response) {
        // Handle the response from funeral.php here
        window.open('funeral.php');
        // You can update the current page or manipulate the DOM based on the response
    });
	})
	
	$(document).on('click','.click_bap',function(){
	var sample = $(this).attr('datetimew')
	 $.ajax({
					type:'post',
					url: 'funeral.php',
					data:{
						datetime : sample

					}
				}).done(function (response) {
        // Handle the response from funeral.php here
        window.open('baptism.php');
        // You can update the current page or manipulate the DOM based on the response
    });
	})
	
	$(document).on('click','.click_wed',function(){
	var sample = $(this).attr('datetimew')
	 $.ajax({
					type:'post',
					url: 'funeral.php',
					data:{
						datetime : sample

					}
				}).done(function (response) {
        // Handle the response from funeral.php here
        window.open('wedding.php');
        // You can update the current page or manipulate the DOM based on the response
    });
	})
	*/
</script>