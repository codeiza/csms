<?php
date_default_timezone_set("Asia/Manila");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Form</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Add FontAwesome CSS link -->
    <link rel="stylesheet" href="path/to/your/style.css"> <!-- Add the path to your CSS file -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-rTRtQyT6h4Khlc5l9TDzDFLbD9tAjxSVC9SMtFjCzjp0j3WzWb2zvLv9fwM8i5Fb" crossorigin="anonymous">
   
    <style>
        /* Add your custom styles here */
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .input-group-prepend span {
            width: 40px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control-feedback {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
        }
        body {
    font-family: Arial, sans-serif;
}
    </style>
</head>

<body>
    <br>
<div class="payment-info">
<h2>&nbsp;Donation Information</h2>
<p>&nbsp;&nbsp;For your donation, you can send it to the following GCash number:</p>
                <p class="phone-number">
    <span style="color: black;">&nbsp;&nbsp;GCash: </span>
    <span style="color: #007bff;">0922-2525-848</span>
</p>
                <p>&nbsp;&nbsp;Please make sure to include your reference number when sending your donation.</p>
                <p>&nbsp;&nbsp;Thank you for your contribution!</p>
                </div>
                <hr>
    <form method="post" action="php/insert_donation.php" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="payors_name" class="form-control" placeholder="Donated By"
                                required />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-donate"></i></span>
                            </div>
                            <select class="form-control" name="mode_of_payment" required>
                                <option disabled selected value="">Select Donation Type</option>
                                <option value="G-Cash">G-Cash</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                            </div>
                            <input type="text" max="11" name="acc_num" class="form-control" placeholder="Account Number"
                                required />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-signature"></i></span>
                            </div>
                            <input type="text" name="acc_name" class="form-control" placeholder="Account Name"
                                required />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-receipt"></i></span>
                            </div>
                            <input type="text" max="13" name="reference_num" class="form-control" placeholder="Reference No."
                                required />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                            </div>
                            <input type="number" class="form-control" name="price" placeholder="Donated Amount"
                                required />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" class="form-control" name="date_of_payment" placeholder="Date" required />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-paperclip"></i></span>
                            </div>
                            <input type="file" class="form-control" name="receipt" required />
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <center>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit</button>
                    </div>
                </div>
            </center>
        </div>
        <br>
    </form>

    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1
