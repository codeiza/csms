<?php
//Print_r($_REQUEST)
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Update Form</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }
  </style>
</head>

<body>

  <form method="post" action="php/update_user_b.php" enctype="multipart/form-data">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <label>Firstname:</label>
          <input type="text" class="form-control" name="firstName" value="<?php echo $_REQUEST["firstName"] ?>" placeholder="First Name" />
        </div>
        <div class="col-sm-6">
          <label>Lastname:</label>
          <input type="text" class="form-control" name="lastName" value="<?php echo $_REQUEST["lastName"] ?>" placeholder="Last Name" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label>Username:</label>
          <input type="text" class="form-control" name="userName" value="<?php echo $_REQUEST["userName"] ?>" placeholder="User Name" />
        </div>
        <div class="col-sm-6">
          <label>Email:</label>
          <input type="text" class="form-control" name="email" value="<?php echo $_REQUEST["email"] ?>" placeholder="Email" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label>Phone Number:</label>
          <input type="text" class="form-control" name="phoneNumber" value="<?php echo $_REQUEST["phoneNumber"] ?>" placeholder="Phone Number" maxlength="11" />
          <input type="hidden" class="form-control" name="id" value="<?php echo $_REQUEST["id"] ?>" placeholder="Phone Number" />
        </div>

        <div class="col-sm-6">
          <label>Birthdate:</label>
          <input type="text" class="form-control" name="birthdate" id="date_filter" value="<?php echo $_REQUEST["birthdate"] ?>" placeholder="Birthdate" />
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label>Age:</label>
          <input type="text" class="form-control" name="Age" value="<?php echo $_REQUEST["Age"] ?>" placeholder="Age" />
        </div>
        <div class="col-sm-6">
          <label>Address:</label>
          <input type="text" class="form-control" name="address" value="<?php echo $_REQUEST["address"] ?>" placeholder="Address" />
        </div>
      </div>
      <br>
      <div class="col-sm-6">
        <input type="submit" class="btn" value="Update" />
      </div>
    </div>
  </form>

</body>

</html>


<script>
  $("#date_filter").datepicker({
    format: 'yyyy-mm-dd',
    //startDate: '-3m',
    autoclose: true
  })
</script>