<?php
// print_r($_REQUEST);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/your/style.css"> <!-- Add the path to your CSS file -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-rTRtQyT6h4Khlc5l9TDzDFLbD9tAjxSVC9SMtFjCzjp0j3WzWb2zvLv9fwM8i5Fb" crossorigin="anonymous">
</head>
<style>
    /* Set a fixed width and height for the icons */
    .payment-icon img {
        width: 80px;
        /* Adjust as needed */
        height: 80px;
        /* Adjust as needed */
    }

    body {
        font-family: Arial, sans-serif;
    }
</style>

<body>
    <div class="container">
        <form method="post" action="php/update_attachement.php" enctype="multipart/form-data">
            <!-- Your existing hidden inputs -->
            <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>" />
            <input type="hidden" name="event_type" value="<?php echo $_REQUEST["event_type"]; ?>" />
            <input type="hidden" class="form-control" name="reserve_by" value="<?php echo $_REQUEST["reserve_by"]; ?>" placeholder="Reference Number" required>
            <input type="hidden" class="form-control" name="payment_type" value="<?php echo $_REQUEST["payment_type"]; ?>" placeholder="Reference Number" required>
            <input type="hidden" class="form-control" name="amount_paid" value="<?php echo $_REQUEST["amount_paid"]; ?>" placeholder="Reference Number" required>

            <!-- ... more hidden inputs ... -->

            <br>
            <!-- Payment Information Section -->
            <div class="payment-info">
                <h2>Payment Information</h2>
                <p>For your payment, you can send it to the following number:</p>
                <p class="phone-number">
                    <span style="color: black;">GCash: </span>
                    <span style="color: #007bff;">0922-2525-848</span>
                </p>
                <p>Please make sure to include your reference number when sending the payment.</p>
            </div>
            <hr>
            <h4>Upload your payment here:</h4>
            <center>
                <div id="gcash-icon" class="payment-icon" style="display: none;">
                    <img src="image/gcash-icon.png" alt="GCash Icon">
                </div>
            </center>
            <br>
            <!-- Payment Form Section -->
            <div class="form-row">
                <div class="form-group col-md-5 mx-auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                        </div>
                        <select class="form-control" name="mode_of_payment" id="mode_of_payment" required>
                            <option value="G-Cash">G-Cash</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-5 mx-auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                        </div>
                        <input type="text" class="form-control" name="reference_num" placeholder="Reference Number" required>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5 mx-auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-university"></i></span>
                        </div>
                        <input type="text" class="form-control" name="account_num" placeholder="Account Number" required>
                    </div>
                </div>

                <div class="form-group col-md-5 mx-auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="account_name" placeholder="Account Name" required>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5 mx-auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" class="form-control" name="amount" value="<?php echo number_format($_REQUEST["amount_paid"], 2); ?>" placeholder="Amount" required readonly>
                    </div>
                </div>


                <div class="form-group col-md-5 mx-auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-paperclip"></i></span>
                        </div>
                        <input type="file" class="form-control" name="payment_attachment" placeholder="Attach Receipt" required>
                    </div>
                </div>
            </div>

            <!-- ... more form fields ... -->

            <center>
                <button type="submit" class="btn btn-sm btn-success" name="addrecord"><i class="fas fa-check"></i> Submit</button>
            </center>
            <br>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#mode_of_payment").change(function() {
                var selectedPayment = $(this).val();

                // Hide all icons
                $("#gcash-icon, #maya-icon, #online-bank-icon").hide();

                // Show the selected icon based on the payment method
                if (selectedPayment === "G-Cash") {
                    $("#gcash-icon").show();
                } else if (selectedPayment === "Maya") {
                    $("#maya-icon").show();
                } else if (selectedPayment === "Online bank") {
                    $("#online-bank-icon").show();
                }
            });
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>