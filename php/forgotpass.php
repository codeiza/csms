<!DOCTYPE html>
<html lang="en">

<head>
<link rel="icon" href="images/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Lobster&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif; 
			background-image: url('image/bg1.png');
			background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .card-custom-header {
            background-color: #ADDCDC; 
        }

        .btn-custom-success {
            background-color: #ADDCDC !important; 
            border-color: #ADDCDC !important;
			color: #333;
        }

        .card-title {
            font-family: 'Garamond	'; 
			color: #333;

        }
    </style>
</head>

<body class="bg-light">
	<br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-custom-header text-white">
                        <center><h4 class="mb-0 card-title">FORGOT PASSWORD</h4></center>
                    </div>
                    <div class="card-body">
					<img src="images/logo.png" alt="Logo" style="width: 150px; height: auto; display: block; margin: 0 auto;">  <br>
                        <form method="post" action="php/forgotpassword.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email">Email Address:</label> <br>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-custom-success btn-block"><b>RESET PASSWORD</b></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>
