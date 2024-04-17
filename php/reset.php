<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
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
            font-family: 'Garamond';
            color: #333;
        }
    </style>

    <?php
    require_once 'connection.php';
    $firstName = $lastName = $id = ''; // Initialize variables to avoid undefined variable warnings
    try {
        $pdo = new PDO(DSN, DB_USR, DB_PWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $firstName = $user["firstName"];
                $lastName = $user["lastName"];
                $id = $user["id"];
            } else {
                echo "User not found.";
            }
        } else {
            echo "ID parameter is missing.";
        }
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
    ?>
</head>

<body class="bg-light">
    <br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-custom-header text-white">
                        <center>
                            <h4 class="mb-0 card-title">RESET PASSWORD</h4>
                        </center>
                    </div> <br>
                    <div class="card-body">
                        <center><i class="fas fa-lock" style="font-size: 60px;"></i></center> <br>
                        <form method="post" action="reset_password.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="firstName" class="form-label">Firstname:</label> <br>
                                <input id="firstName" class="form-control" type="text" value="<?php echo $firstName; ?>" readonly>
                                <input class="form-control" type="hidden" name="id" value="<?php echo $id; ?>" readonly>
                            </div> <br>
                            <div class="form-group">
                                <label for="lastName" class="form-label">Lastname:</label> <br>
                                <input id="lastName" class="form-control" type="text" value="<?php echo $lastName; ?>" readonly>
                                <input class="form-control" type="hidden" name="id" value="<?php echo $id; ?>" readonly>
                            </div> <br>
                            <div class="form-group">
                                <label for="password" class="form-label">New Password:</label> <br>
                                <div class="input-group">
                                    <input id="password" class="form-control" name="password" type="password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-custom-success btn-block"><b>SUBMIT</b></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function () {
        $('#togglePassword').click(function () {
            var passwordInput = $('#password');
            var type = passwordInput.attr('type');
            if (type === 'password') {
                passwordInput.attr('type', 'text');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.upload', function() {
                $.ajax({
                    type: 'post',
                    url: 'upload_receipt.php',
                    data: {
                        id: $(this).attr('id'),
                    }
                }).done(function(data) {
                    $(".modal-title").html('Upload receipt')
                    $(".modal-body-1").html(data)
                    $(".modal").modal('show');
                })
            })
        });
    </script>
</body>
</body>

</html>