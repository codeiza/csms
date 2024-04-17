  <?php
  date_default_timezone_set("Asia/manila");

?>

  <form method="post" action="php/insert_ministry.php" enctype="multipart/form-data">
  <div class="container">
	<div class="row">
		<div class="col-sm-3">
		<label>Picture</label>
		<input type="file" name="Picture" class="form-control" required />
		</div>
		<div class="col-sm-3">
		<label>FirstName</label>
		<input type="text" name="firstName" class="form-control" placeholder="Optional" />
		</div>
		<div class="col-sm-3">
		<label>LastName</label>
		<input type="text" name="lastName" class="form-control" placeholder="Optional" />
		</div>
	</div>
	<div class="row">
	<div class="col-sm-3">
	<label>Email</label>
	<input type="email" class="form-control" name="email" placeholder="email " />
	</div>
	<div class="col-sm-3">
	<label>Phone Number</label>
	<input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="phoneNumber" />
	</div>
	<div class="col-sm-3">
	<label>Birthdate</label>
	<input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="birthdate" />
	</div>
	</div>
	<div class="row">
	<div class="col-sm-3">
	<label>Age</label>
	<input type="text" class="form-control" id="Age" name="Age" placeholder="Age" />
	</div>
	<div class="col-sm-6">
	<label>Address</label>
	<input type="text" class="form-control" id="address" name="address" placeholder="address" />
	</div>
	</div>
	
	<div>
	<br><br>
	<button type="submit" class="btn btn-sm btn-success" >Done</button>
	</div>
	</div>
	 </form>
   <script>
   $("#date_filter").datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3m',
        autoclose: true
    });
   </script>