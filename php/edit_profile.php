<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="path/to/bootstrap.css">
  <title>Edit Profile</title>
  <style>
    /* Additional styles can be added here if needed */
    .btn-custom-width {
      width: 100px;
      height: 40px;
      /* Adjust the width as needed */
    }
  </style>
</head>

<body>

  <div class="container mt-4">
    <form method="post" action="php/update_profile.php" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-4 mb-2">
          <label for="firstName">Firstname:</label>
          <input type="text" name="firstName" class="form-control" placeholder="First Name" value="<?= $_SESSION["user"]["firstName"]; ?>" required />
          <input type="hidden" name="id" class="form-control" value="<?= $_SESSION["user"]["id"]; ?>" required />
        </div>
        <div class="col-md-4 mb-2">
          <label for="lastName">Lastname:</label>
          <input type="text" name="lastName" class="form-control" placeholder="Last Name" value="<?= $_SESSION["user"]["lastName"]; ?>" required />
        </div>
        <div class="col-md-4 mb-2">
          <label for="userName">Username:</label>
          <input type="text" name="userName" class="form-control" placeholder="User Name" value="<?= $_SESSION["user"]["userName"]; ?>" required />
        </div>
        <div class="col-md-4 mb-2">
          <label for="password">Password:</label>
          <input type="password" name="password" class="form-control" placeholder="Password" required />
        </div>
        <div class="col-md-4 mb-2">
          <label for="email">Email:</label>
          <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $_SESSION["user"]["email"]; ?>" required />
        </div>
        <div class="col-md-4 mb-2">
          <label for="phoneNumber">Phone Number:</label>
          <input type="text" name="phoneNumber" class="form-control" required maxlength="11" placeholder="Phone Number" value="<?= $_SESSION["user"]["phoneNumber"]; ?>" required />
        </div>
        <div class="col-md-4 mb-2">
          <label for="birthdate">Birthdate:</label>
          <input type="text" name="birthdate" class="form-control" placeholder="Birthdate" value="<?= $_SESSION["user"]["birthdate"]; ?>" required />
        </div>
        <div class="col-md-4 mb-2">
          <label for="Age">Age:</label>
          <input type="text" name="Age" class="form-control" placeholder="Age" value="<?= $_SESSION["user"]["Age"]; ?>" required />
        </div>
        <div class="col-md-4 mb-2">
          <label for="address">Address:</label>
          <input type="text" name="address" class="form-control" placeholder="Address" value="<?= $_SESSION["user"]["address"]; ?>" required />
        </div>
        <div class="col-md-4 mb-2">
          <label for="picture_data">Profile Picture:</label>
          <input type="file" name="picture_data" class="form-control" />
        </div>
      </div>
      <br>
      <center>
        <div class="col-md-8 mx-auto">
          <input type="submit" value="Save" class="btn btn-success btn-block btn-custom-width" />
        </div>
      </center>
    </form>
    <br>
  </div>

  <script>
    document.getElementById('number').addEventListener('input', function() {
      if (this.value.length > 11) {
        this.value = this.value.slice(0, 11); // Limit input to 11 characters
      }
    });
  </script>
  <script src="path/to/bootstrap.js"></script>
</body>

</html>