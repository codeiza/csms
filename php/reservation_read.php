<?php
require_once 'connection.php';

try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare(
        "SELECT * FROM schedule_list
        WHERE
        (Status = 'For Schedule' OR Status = 'For Verification' OR Status = 'Confirm_docs' OR Status = 'For Document Verification') AND confirm_priest IS NOT NULL AND cancel_delete IS NULL"
    );
    $stmt->execute();
    $tbody = '';
    $sNum = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $scheduleid = $row["request_form_id"];
        $stmt1 = $pdo->prepare(
            "SELECT event_location, place_of_merriage, bap_location FROM request_form
            WHERE id = '" . $scheduleid . "'
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
        $tbody .= '<td>' . $row["start_datetime"] . '</td>';
        $tbody .= '<td class="editable" id="payment_type-' . $row["id"] . '"><input type="text" class="payment-type-input form-control" id="payment_type_input-' . $row["id"] . '" value="' . $row["payment_type"] . '"></td>';
        $tbody .= '<td class="editable" id="amount_paid-' . $row["id"] . '"><input type="text" class="payment-input form-control" id="amount_paid_input-' . $row["id"] . '" value="' . $row["amount_paid"] . '"></td>';

        if ($row["event_type"] == 'wedding') {
            $tbody .= '<td><b>Name:</b> ' . $row["reserve_by"] . '<br><b>Phone Number:</b> ' . $row["contact_no"] . '<br><b>Email:</b> ' . $row["email"] . '<br><b>Location:</b> ' . $place_of_merriage . '</td>';
        } elseif ($row["event_type"] == 'Baptismal') {
            $tbody .= '<td><b>Name:</b> ' . $row["reserve_by"] . '<br><b>Phone Number:</b> ' . $row["contact_no"] . '<br><b>Email:</b> ' . $row["email"] . '<br><b>Location:</b> ' . $bap_location . '</td>';
        } else {
            $tbody .= '<td><b>Name:</b> ' . $row["reserve_by"] . '<br><b>Phone Number:</b> ' . $row["contact_no"] . '<br><b>Email:</b> ' . $row["email"] . '<br><b>Location:</b> ' . $event_location . '</td>';
        }
        if ($row["Status"] == 'For Verification') {
            $tbody .= '<td><a href="resibo/' . $row["payment_attachment"] . '" target="blank">' . $row["Status"] . '</a></td>';
        } elseif ($row["Status"] == 'For Verify Document') {
            $tbody .= '<td><a href="requirements/' . $row["requirements"] . '" target="blank">' . $row["Status"] . '</a></td>';
        } else {
            $tbody .= '<td class="" id="Status-' . $row["id"] . '">' . $row["Status"] . '</td>';
        }
        if ($row["Status"] == 'For Verification') {
            $tbody .= '<td>
                <button class="btn btn-info verify" col="verify" request_form_id="' . $row["request_form_id"] . '" payment_type="' . $row["payment_type"] . '" reserve_by="' . $row["reserve_by"] . '" date_paid="' . $row["date_paid"] . '" amount_paid="' . $row["amount_paid"] . '" start="' . $row["start_datetime"] . '" email="' . $row["email"] . '"  event="' . $row["title"] . '" id="Status-' . $row["id"] . '" title="once you approve automatically send to client through email"><span class="fa fa-thumbs-up"></span></button> 
                <button class="btn btn-warning disapproved" event="' . $row["title"] . '" email="' . $row["email"] . '"  id="Status-' . $row["id"] . '"><span class="fa fa-thumbs-down"></span></button>
            </td>';
        } elseif ($row["Status"] == 'For Verify Document') {
            $tbody .= '<td>
                <button class="btn btn-success approved_docs" request_form_id="' . $row["request_form_id"] . '" payment_type="' . $row["payment_type"] . '" reserve_by="' . $row["reserve_by"] . '" date_paid="' . $row["date_paid"] . '" amount_paid="' . $row["amount_paid"] . '" start="' . $row["start_datetime"] . '" email="' . $row["email"] . '"  event="' . $row["title"] . '" id="Status-' . $row["id"] . '" title="once you approve automatically send to client through email">Document Approved</button> 
                <button class="btn btn-danger disapproved" event="' . $row["title"] . '" email="' . $row["email"] . '"  id="Status-' . $row["id"] . '">Document DissApproved</button>
            </td>';
        } else {
            $tbody .= '<td>
                <button class="btn btn-success approved" request_form_id="' . $row["request_form_id"] . '" payment_type="' . $row["payment_type"] . '" reserve_by="' . $row["reserve_by"] . '" date_paid="' . $row["date_paid"] . '" amount_paid="' . $row["amount_paid"] . '" start="' . $row["start_datetime"] . '" email="' . $row["email"] . '"  event="' . $row["title"] . '" id="Status-' . $row["id"] . '" title="once you approve automatically send to client through email"><span class="fa fa-thumbs-up"></span></button> 
                <button class="btn btn-danger s disapproved" event="' . $row["title"] . '" email="' . $row["email"] . '"  id="Status-' . $row["id"] . '"><span class="fa fa-thumbs-down"></span></button>
            </td>';
        }
        $tbody .= '</tr>';
    }
    $stmt2 = $pdo->prepare(
        "SELECT * FROM setting_of_prices"
    );
    $stmt2->execute();
    while ($row3 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        if ($row3["event"] == 'Baptismal') {
            $priceBaptismal = $row3["price"];
        } elseif ($row3["event"] == 'Funeral') {
            $priceFuneral = $row3["price"];
        } elseif ($row3["event"] == 'Wedding') {
            $priceWedding = $row3["price"];
        } elseif ($row3["event"] == 'Mass') {
            $priceMass = $row3["price"];
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
$pdo = null;
?>

<style>
.fa-pencil.setting {
    color: blue;
    cursor: pointer;
}

.edited {
    border: 2px solid #ccc;
    padding: 10px;
    margin-top: 10px;
}

.edit_this {
    width: 80px;
}

.btn-success.hide {
    margin-top: 10px;
}
</style>

<table class="table table-striped table-condensed table-hover table-bordered text-center">
    <thead class="btn-info">
        <tr>
            <th class="tsugtsug">Event</th>
            <th class="tsugtsug">Description</th>
            <th>Date & Time of Event</th>
            <th>Payment Type</th>
            <th>Amount Payment <br><span style="font-weight: normal;">(Note: For donations, amount payment is
                    optional)</span></th>
            <th>Contact Information</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php echo $tbody ?>
    </tbody>
</table>
<hr>
<button type="button" class="btn btn-warning edit-btn"><i class="fas fa-edit"></i> Edit</button> <br>
<div class="col-sm-3" edited" style="display:none">
    <p>Baptismal <input name="bap" type="text" class="form-control edit_this" id="1"
            value="<?php echo $priceBaptismal ?>"></p>
    <p>Wedding <input name="wed" type="text" class="form-control edit_this" id="2" value="<?php echo $priceWedding ?>">
    </p>
    <p>Funeral <input name="funeral" type="text" class="form-control edit_this" id="3"
            value="<?php echo $priceFuneral ?>"></p>
    <p>Mass <input name="funeral" type="text" class="form-control edit_this" id="4" value="<?php echo $priceMass ?>">
    </p>
    <input type="button" class="btn btn-success hide" value="Hide" />
</div>

<script>
$(document).ready(function() {
    $(document).on('click', '.edit-btn', function() {
        $('.edited').show();
    });
    $(document).on('click', '.hide', function() {
        $('.edited').hide();
    });

    $('.edit_this').on('blur', function() {
        var value = $(this).val();
        var id = $(this).attr('id');
        $.ajax({
            type: 'post',
            url: 'php/update_setting_price.php',
            data: {
                id: id,
                value: value
            }
        }).done(function(data) {
            alert('Updated Successfully');
        });
    });

    // Handle the payment input field
    $(document).on('blur', '.payment-input', function() {
        var value = $(this).val();
        var id = $(this).attr('id').split('-')[2]; // Extract the ID from the input's ID
        $.ajax({
            type: 'post',
            url: 'php/update_payment.php', // Change this to your PHP endpoint to handle payment update
            data: {
                id: id,
                value: value
            }
        }).done(function(data) {
            alert('Payment Updated Successfully');
        });
    });

    $(document).on('blur', '.payment-type-input', function() {
        var value = $(this).val();
        var id = $(this).attr('id').split('-')[2]; // Extract the ID from the input's ID
        $.ajax({
            type: 'post',
            url: 'php/update_payment_type.php', // Change this to your PHP endpoint to handle payment type update
            data: {
                id: id,
                value: value
            }
        }).done(function(data) {
            alert('Payment Type Updated Successfully');
        });
    });
});
</script>