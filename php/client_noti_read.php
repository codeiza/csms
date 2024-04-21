<?php
session_start();
require_once 'pagination.class.php';
require_once 'connection.php';

try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare(
        "SELECT * FROM schedule_list WHERE payment_type = 'For Payment' and user_id = '" . $_SESSION["user"]["id"] . "'
		
		"
    );
    $stmt->execute();
    $cnt = $stmt->rowCount();
    $tbody = '';
    $sNum = 1;


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $tbody .= '<tr>';
        $tbody .= '<td class="" id="title-' . $row["id"] . '">' . $row["title"] . '</td>';
        $tbody .= '<td>₱' . number_format($row["amount_paid"], 2) . '</td>';
        $tbody .= '<td style="text-align: center;">'; // Center-align the cell content
        $tbody .= '<button class="btn btn-info upload" 
				id="' . $row["id"] . '" 
				title="' . $row["title"] . '" 
				event_type="' . $row["event_type"] . '" 
				reserve_by="' . $row["reserve_by"] . '" 
				payment_type="' . $row["payment_type"] . '"
				amount_paid="' . $row["amount_paid"] . '"
			><i class="fa fa-cloud-upload"></i> Payment</button>';
        $tbody .= '</td>';

        $tbody .= '</tr>';
        $sNum++;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<table class="table table-striped table-condensed table-hover table-bordered dark-cyan-table">
    <thead class="bg-success text-white">
        <th class="head1">Event Type</th>
        <th class="head1">Amount Payment</th>
        <th class="head1">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php echo $tbody ?>
    </tbody>
</table>
<p><span id="cnt"><?php echo $cnt ?></span> Record(s) Found.</p>

<style>
.dark-cyan-table th {
    background-color: darkcyan;
    color: white;
    text-align: center;
}
</style>

<script>
$(document).ready(function() {
    $(document).on('click', '.upload', function() {
        //alert('');
        /*	$(".modal-title").html('Upload receipt')
        	$(".modal-body-1").load('upload_receipt.php')
        	$("#confirmModal").modal('show')
        	*/
        $.ajax({
            type: 'post',
            url: 'php/upload_receipt2.php',
            data: {
                id: $(this).attr('id'),
                event_type: $(this).attr('event_type'),
                reserve_by: $(this).attr('reserve_by'),
                payment_type: $(this).attr('payment_type'),
                amount_paid: $(this).attr('amount_paid')



            }
        }).done(function(data) {
            $(".modal-title").html('Upload receipt')
            $(".modal-body-1").html(data)
            $(".modal").modal('show');
        })

    })

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
                    '<input type="text" value="' + $(this).text() + '">'
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
            url: 'php/editable.php',
            data: {
                value: value,
                id: id,
                column: column
            }
        }).done(function(data) {
            //alert('already updated')
        })
    }
    $(document).on('click', '.delete', function() {
        if (!confirm('Are you sure you want to delete ???')) {
            return false;
        }

        $.ajax({
            type: 'post',
            url: 'php/delete_user.php',
            data: {
                id: $(this).attr('id')

            }
        }).done(function(data) {
            //alert(data);
            //location.href='./'
            var type = $("#type").val();
            swal({
                title: "Title",
                text: "Success fully Deleted",
                type: type
            });
            location.href = './floor.php'
        })

    })


})
</script>