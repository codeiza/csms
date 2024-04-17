<?php
require_once 'connection.php';


if(isset($_POST['delete_btn']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sched_query = "SELECT * FROM schedule_list WHERE id='$id'";
    $sched_query_run = mysqli_query($con, $sched_query);
    $sched_data = mysqli_fetch_array($sched_query_run);

    $delete_query = "DELETE FROM schedule_list WHERE id='$id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

}

$conn->close();
?>
