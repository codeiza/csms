<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Scheduled Progress</h1>
            &nbsp;&nbsp;&nbsp;&nbsp;<div class="input-group">
                <input type="search" placeholder="Search Data...">
                <img src="img/search.png" alt="">
            </div>
            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">
                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <label for="export-file" id="toPDF">PDF <img src="img/pdf.png" alt=""></label>
                    <label for="export-file" id="toJSON">JSON <img src="img/json.png" alt=""></label>
                    <label for="export-file" id="toCSV">CSV <img src="img/csv.png" alt=""></label>
                    <label for="export-file" id="toEXCEL">EXCEL <img src="img/excel.png" alt=""></label>
                </div>
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Event Type <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Name <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Event Date & Time<span class="icon-arrow">&UpArrow;</span></th>
                        <th> Status <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Action <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <?php
require_once 'connection.php';
$where = "";

// Check if the keyword parameter is set
if (isset($_REQUEST["keyword"])) {
    $where .= "WHERE event_type like '%" . $_REQUEST["keyword"] . "%' and user_id = '" . $_SESSION["user"]["id"] . "' ";
} else {
    $where .= "WHERE event_type is not null and user_id = '" . @$_SESSION["user"]["id"] . "' ";
}

$limit = "";
// Check if page and perpage parameters are set
if (isset($_REQUEST["page"]) && isset($_REQUEST["perpage"])) {
    $limit = " LIMIT " . (($_REQUEST["page"] - 1) * $_REQUEST["perpage"]) . ", " . $_REQUEST["perpage"];
}

try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Construct the SQL query
    $sql = "SELECT * FROM schedule_list " . $where . $limit;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $total = $stmt->rowCount();

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
        $tbody .= '</tr>'; // Add closing tag for table row
    }

    // Now, output the tbody within the table
    echo '<tbody id="schedule_list">' . $tbody . '</tbody>';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

            </table>
        </section>
    </main>
    <script src="script.js"></script>

</body>

</html>
