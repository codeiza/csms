<?php
require_once 'connection.php';
try{
		$pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
		"SELECT * FROM workship
		"
		);
		$stmt->execute();
		$tbody = '';
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    $tbody .= '<tr>';
			$tbody .= '<td class="" >'.$row["firstName"].'</td>';
			$tbody .= '<td class="" >'.$row["lastName"].'</td>';
			$tbody .= '<td class="" >'.$row["email"].'</td>';
			$tbody .= '<td class="" >'.$row["phoneNumber"].'</td>';
			$tbody .= '</tr>';
		}
	} catch (PDOException $e) {
	echo $e->getMessage();
	}
?>
<table class="table table-striped table-condensed table-hover table-bordered">
	<thead>
		<tr>
			
			<th class="head1">First Name</th>
			<th class="head1">Last Name</th>
			<th class="head1">Email</th>
			<th class="head1">Phone Number</th>

		</tr>
	</thead>
	<tbody>
		<?php echo $tbody?>
	</tbody>
</table>