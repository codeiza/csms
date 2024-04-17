<?php
require_once 'connection.php';
try {
	$pdo = new PDO(DSN, DB_USR, DB_PWD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"SELECT * FROM schedule_setting 
		
		"
	);

	$stmt->execute();
	$tbody = '';
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$id = $row["id"];
		$tbody .= '<tr>';
		$tbody .= '<td>' . $row["event"] . '</td>';
		$tbody .= '<td>' . $row["time"] . '</td>';

		$tbody .= '<td class="editable" id="days-' . $row["id"] . '">';
		$tbody .= '<span class="show_text">' . $row["days"] . '</span>'; // Original text
		$tbody .= '<input type="text" class="form-control numbertext edit_input" id="' . $row["id"] . '" style="display:none;" value="' . $row["days"] . '" />'; // Input field
		$tbody .= '</td>';

		$tbody .= '<td>
			<button type="button" class="btn btn-warning edit-btn"><i class="fas fa-edit"></i> Edit</button>
<button type="button" class="btn btn-info save"><i class="fas fa-save"></i> Save</button>
			</td>';
		$tbody .= '</tr>';
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>
<table class="table table-striped table-condensed table-hover table-bordered">
	<thead>
		<tr class="bg-success">
			<th>Event</th>
			<th>Time</th>
			<th>Available Event(s)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tbody ?>
	</tbody>
</table>
<script>
	$(document).ready(function() {

		$('.save').click(function() {
			location.reload()
		});
		$('.edit-btn').click(function() {
			var row = $(this).closest('tr');
			var textSpan = row.find('.show_text');
			var inputField = row.find('.edit_input');
			var value_input = $('.edit_input').val()
			// Toggle visibility
			textSpan.toggle();
			inputField.toggle();
			/* var buttonText = $(this).text();
    if (buttonText === "Edit") {
        $(this).text("Save");
    } else {
        $(this).text("Edit");
    }*/
			//$(textSpan).html(inputField)
		});
		$(document).on('blur', '.numbertext', function() {
			var column = 'days'
			var id = $(this).attr('id')
			var value = $(this).val()
			$.ajax({
				type: 'post',
				url: 'php/editable_schedule.php',
				data: {
					value: value,
					id: id,
					column: column
				}
			}).done(function(data) {
				//alert('already updated')
			})
		});
		$(document).on('dblclick', '.editable', editable())

		function editable() {
			//alert('f')
			var edit_flag = false;
			return function() {
				if (edit_flag) return
				var column = $(this).attr('id').split('-')[0]
				var id = $(this).attr('id').split('-')[1]
				if (column == 'accountType') {
					var input =
						'<select id="myselect">' +
						'<option value="' + $(this).text() + '"></option>' +
						'<option>Client</option>' +
						'<option>Admin</option>' +
						'<option>Priest</option>' +
						'<option>Parishioner</option>'
					'</select>';
				} else {
					var input =
						'<input type="number" value="' + $(this).text() + '">'
				}

				$(this).html(input)
				$("input,select", this).focus().blur(function() {
					saveEditable($(this).val(), id, column)
					$(this).after($(this).val()).unbind().remove()
					edit_flag = false
				})
				edit_flag = true
			}
		}

		function saveEditable(value, id, column) {
			$.ajax({
				type: 'post',
				url: 'php/editable_schedule.php',
				data: {
					value: value,
					id: id,
					column: column
				}
			}).done(function(data) {
				//alert('already updated')
			})
		}



	})
</script>