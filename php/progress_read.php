<?php
session_start();
//print_r($_SESSION);
function days($rec, $fin, $today)
{
    if ($fin) {
        $days = ($fin - $rec) / 60 / 60 / 24;
    } else {
        $days = ($today - $rec) / 60 / 60 / 24;
    }
    return ceil($days);
}
//print_r($_SESSION); 
require_once 'pagination.class.php';
require_once 'connection.php';
$where = "";

if ($_REQUEST["keyword"]) {
    $where .= "WHERE event_type like '%" . $_REQUEST["keyword"] . "%' and user_id = '" . $_SESSION["user"]["id"] . "' ";
} else {
    $where .= "WHERE event_type is not null and user_id = '" . @$_SESSION["user"]["id"] . "' ";
}

$limit = " limit " . (($_REQUEST["page"] - 1) * $_REQUEST["perpage"]) . ", " . $_REQUEST["perpage"];
try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare(
        "SELECT * FROM schedule_list " . $where
    );

    $stmt->execute();
    $total = $stmt->rowCount();

    $stmt = $pdo->prepare(
        "SELECT * FROM schedule_list " . $where . $limit
    );
    $stmt->execute();
    $cnt = $stmt->rowCount();
    $tbody = '';
    $sNum = 1;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $eventDateTime = date("F j, Y (H:i)", strtotime($row["start_datetime"])); // Format date and time
        $tbody .= '<tr>';
        $tbody .= '<td class="">' . $row["event_type"] . '</td>';

        if ($row["Status"] == 'For Schedule') {
            $tbody .= '<td class="pending">Pending</td>';
        } else if ($row["Status"] == 'Confirm') {
            $tbody .= '<td class="confirmed">Confirmed</td>';
        } else if ($row["Status"] == 'Cancel') {
            $tbody .= '<td class="canceled">Cancelled</td>';
        } else {
            $tbody .= '<td class="">' . $row["Status"] . '</td>';
        }

        $tbody .= '<td class="">' . $eventDateTime . '</td>'; // Use formatted date and time
        $tbody .= '<td class="">' . $row["reserve_by"] . '</td>';

        // Delete action button with modal confirmation
        $tbody .= '<td class="text-center">';

        $tbody .= '<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal' . $row["id"] . '">Delete</button>';
        $tbody .= '</td>';

        // Modal for confirmation
        $tbody .= '<div class="modal fade" id="deleteModal' . $row["id"] . '" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel' . $row["id"] . '" aria-hidden="true">';
        $tbody .= '<div class="modal-dialog" role="document">';
        $tbody .= '<div class="modal-content">';
        $tbody .= '<div class="modal-header">';
        $tbody .= '<h5 class="modal-title" id="deleteModalLabel' . $row["id"] . '">Delete Event</h5>';
        $tbody .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        $tbody .= '<span aria-hidden="true">&times;</span>';
        $tbody .= '</button>';
        $tbody .= '</div>';
        $tbody .= '<div class="modal-body">';
        $tbody .= 'Are you sure you want to delete this event? ';
        $tbody .= '</div>';
        $tbody .= '<div class="modal-footer">';
        $tbody .= '<form id="deleteForm' . $row["id"] . '" method="POST" action="delete_schedevent.php">';
        $tbody .= '<input type="hidden" name="id" value="' . $row["id"] . '">';
        $tbody .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
        $tbody .= '<button type="button" name="delete_btn" class="btn btn-danger" onclick="submitDeleteForm(' . $row["id"] . ')">Delete</button>';
        $tbody .= '</form>';
        $tbody .= '</div>';
        $tbody .= '</div>';
        $tbody .= '</div>';
        $tbody .= '</div>';

        $tbody .= '</tr>';
        $sNum++;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<table id="scheduleTable" class="table table-striped table-hover">
    <thead class="bg-success text-white">
        <tr>
            <th class="text-center">Event Type</th>
            <th class="text-center">Status</th>
            <th class="text-center">Date & Time of Event</th>
            <th class="text-center">Name of Reserver</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php echo $tbody ?>
    </tbody>
</table>

<p><span id="cnt"><?php echo $cnt ?></span> Record(s) Found.</p>

<!-- Include Bootstrap CSS and JavaScript libraries -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .status {
    padding: .4rem 0;
    border-radius: 2rem;
    text-align: center;
}

    .pending {
        background-color: #ebc474
    }

    .confirmed {
        background-color: #86e49d;
    color: #006b21;
    }

    .canceled {
        background-color: #d893a3;
    color: #b30021;
    }

    .event-box {
        display: inline-block;
        padding: 4px 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }


</style>

<script>
    function submitDeleteForm(id) {
        document.getElementById('deleteForm' + id).submit();
    }
</script>
