 <form method="post" action="php/insert_user.php" enctype="multipart/form-data">
  <div class="container">
	<div class="row">
		<div class="col-sm-6">
		<label>Account Type</label>
		<select name="accountType" class="form-control">
		<option>Client</option>
		<option>Admin</option>
		<option>Priest</option>
		<option>Parishioner	</option>
		</select>
		</div>
    	<div class="col-sm-6">
    		<label>First Name</label>
    		<input type="text" name="firstName" class="form-control" placeholder="First Name" />
    	</div>
	</div>
	<div class="row">
	<div class="col-sm-6">
	<label>Last Name</label>
	<input type="text" class="form-control" name="lastName" placeholder="Last Name" />
	</div>
	<div class="col-sm-6">
	<label>User Name</label>
	<input type="text" class="form-control" name="userName" placeholder="User Name" />
	</div>
	</div>
	<div class="row">
	<div class="col-sm-6">
	<label>Password</label>
	<input type="password" class="form-control" name="password" placeholder="password" />
	</div>
	<div class="col-sm-6">
	<label>Email</label>
	<input type="email" class="form-control" name="email" placeholder="Email" />
	</div>
	
	</div>
	<div class="row">
	<div class="col-sm-6">
	<label>Phone Number</label>
	<input type="number" class="form-control"  name="phoneNumber" placeholder="Phone Number" />
	</div>
	<div class="col-sm-6">
	<label>Birth Date</label>
	<input type="text" class="form-control" id="date_filter" name="birthdate" placeholder="Birth Date" />
	</div>
	</div>
	<div class="row">
	<div class="col-sm-6">
	<label>Age</label>
	<input type="number" class="form-control"  name="Age" placeholder="Age" />
	</div>
	<div class="col-sm-6">
	<label>Address</label>
	<input type="text" class="form-control" name="address" placeholder="Address" />
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
        //startDate: '-3m',
        autoclose: true
    });
   </script>
