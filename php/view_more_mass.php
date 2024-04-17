<?php
require_once 'connection.php';
try{
		$pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
		"SELECT * FROM payment Where event_type = 'Mass'
		"
		);
		$stmt->execute();
		$tbody = '';
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    $tbody .= '<tr>';
			$tbody .= '<td class="" >'.$row["payors_name"].'</td>';
			$tbody .= '<td class="" >'.$row["event_type"].'</td>';
			$tbody .= '<td class="" >'.$row["price"].'</td>';
			$tbody .= '<td class="" >'.$row["date_of_payment"].'</td>';
			$tbody .= '</tr>';
		}
	} catch (PDOException $e) {
	echo $e->getMessage();
	}
?>
<table class="table table-striped table-condensed table-hover table-bordered">
	<thead>
		<tr>
			
			<th class="head1">Client Name</th>
			<th class="head1">Event Type</th>
			<th class="head1">Amount Value</th>
			<th class="head1">Date of Payment</th>

		</tr>
	</thead>
	<tbody>
		<?php echo $tbody?>
	</tbody>
</table>