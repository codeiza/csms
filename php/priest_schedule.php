<?php
session_start();
require_once 'connection.php';

try {
	$pdo = new PDO(DSN, DB_USR, DB_PWD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"SELECT * FROM schedule_list
	   WHERE
	   (Status = 'For Schedule' or Status = 'Confirm' or Status = 'Confirm_docs' or Status = 'For Document Verification') and confirm_priest is null and start_datetime > '" . date('Y-m-d') . "%' and cancel_delete is null
	   "
	);
	$stmt->execute();
	$tbody = '';
	$sNum = 1;
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$scheduleid = $row["request_form_id"];
		$stmt1 = $pdo->prepare(
			"SELECT event_location,place_of_merriage,bap_location FROM request_form
		where id = '" . $scheduleid . "'
		"
		);
		$stmt1->execute();
		$result345 = $stmt1->fetch(PDO::FETCH_ASSOC);
		$event_location = $result345['event_location'];
		$place_of_merriage = $result345['place_of_merriage'];
		$bap_location = $result345['bap_location'];
		$tbody .= '<tr>';
		$tbody .= '<td>' . $row["title"] . '</td>';
		$tbody .= '<td>' . $row["event_type"] . '</td>';
		$start_time = strtotime($row["start_datetime"]);
		$hour = date('G', $start_time);
		if ($hour >= 6 && $hour < 12) {
			$formatted_time = date('F j, Y g:i:i', $start_time);
		} else {
			$formatted_time = date('F j, Y g:i:i', $start_time);
			if ($hour >= 13 && $hour <= 18) {
				$formatted_time = str_replace('AM', 'PM', $formatted_time);
			}
		}
		$tbody .= '<td>' . $formatted_time . '</td>';
		if ($_SESSION["user"]["accountType"] == 'Priest') {


			if ($row["event_type"] == 'wedding') {
				$tbody .= '<td><b>Name: </b>' . $row["reserve_by"] . '<br><b>Phone Number: </b>' . $row["contact_no"] . '<br><b>Email: </b>' . $row["email"] . '<br><b>Location: </b>' . $place_of_merriage . '</td>';
			} else if ($row["event_type"] == 'Baptismal') {
				$tbody .= '<td><b>Name: </b>' . $row["reserve_by"] . '<br><b>Phone Number: </b>' . $row["contact_no"] . '<br><b>Email: </b>' . $row["email"] . '<br><b>Location: </b>' . $bap_location . '</td>';
			} else {
				$tbody .= '<td><b>Name: </b>' . $row["reserve_by"] . '<br><b>Phone Number: </b>' . $row["contact_no"] . '<br><b>Email: </b>' . $row["email"] . '<br><b>Location: </b>' . $event_location . '</td>';
			}

			$tbody .= '<td>
		   <div class="btn-group"> 
		   <button class="btn btn-success approved_father" id="confirm_priest-' . $row["id"] . '">Accept</button>
		   <button class="btn btn-danger disapproved" id="confirm_priest-' . $row["id"] . '">Decline</button>
		   <div>
		   </td>';
			$tbody .= '<td >
			<div ><textarea class="form-control remarks" id="comment-' . $row["id"] . '" >' . $row["comment"] . '</textarea></div>
			</td>';
		} else {
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
			<th class="tsugtsug text-center">Event</th>
			<th class="tsugtsug text-center">Description</th>
			<th class="text-center">Event Date & Time</th>
			<?php if ($_SESSION["user"]["accountType"] == 'Priest') { ?>
				<th class="text-center">Contact Information</th>
				<th class="text-center">Action</th>
				<th class="text-center">Add comment for disapproval</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php echo $tbody ?>
	</tbody>
</table>


<script>
	$(document).ready(function() {
		$('.approved_father').on('click', function() {
			Swal.fire({
				title: "Confirmation",
				text: "Are you sure you want to approve this event?",
				icon: "question",
				showCancelButton: true,
				confirmButtonText: "Yes",
				cancelButtonText: "No",
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					var column = $(this).attr('id').split('-')[0]
					var id = $(this).attr('id').split('-')[1]
					$(this).html('Confirm')
					$.ajax({
						type: 'post',
						url: 'php/confirm_priest.php',
						data: {
							id: id,
							column: column
						}
					}).done(function(data) {
						Swal.fire({
							title: "Success",
							text: "The event has been successfully approved!",
							icon: "success",
							didClose: function() {
								location.reload();
							}
						});
					})
				} else if (
					result.dismiss === Swal.DismissReason.cancel
				) {
					Swal.fire({
						title: "Cancelled",
						text: "No changes have been made.",
						icon: "error"
					});
				}
			});
		})
		$('.disapproved').on('click', function() {
			Swal.fire({
				title: "Confirmation",
				text: "Are you sure you want to disapprove this event?",
				icon: "question",
				showCancelButton: true,
				confirmButtonText: "Yes",
				cancelButtonText: "No",
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					var column = $(this).attr('id').split('-')[0]
					var id = $(this).attr('id').split('-')[1]
					$(this).html('Confirm')
					$.ajax({
						type: 'post',
						url: 'php/confirm_priest_disapproved.php',
						data: {
							id: id,
							column: column,

						}
					}).done(function(data) {
						Swal.fire({
							title: "Success",
							text: "The event has been successfully disapproved!",
							icon: "info",
							didClose: function() {
								location.reload();
							}
						});
					})
				} else if (
					result.dismiss === Swal.DismissReason.cancel
				) {
					Swal.fire({
						title: "Cancelled",
						text: "No changes have been made.",
						icon: "error"
					});
				}
			});
		})
		$('.remarks').blur(function() {
			var column = $(this).attr('id').split('-')[0]
			var id = $(this).attr('id').split('-')[1]
			var value = $(this).val();
			Swal.fire({
				title: "Message Saved",
				text: "Your comment has been successfully saved.",
				icon: "success",
				timer: 1000

			});
			$.ajax({
				type: 'post',
				url: 'php/confirm_priest_disapproved.php',
				data: {
					id: id,
					column: column,
					value: value
				}
			}).done(function(data) {})
		})
	})
</script>