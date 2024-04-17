  <?php
  date_default_timezone_set("Asia/manila");

?>

  <form method="post" action="php/insert_mass_offering.php" enctype="multipart/form-data">
  <div class="container">
	<div class="row">
		<div class="col-sm-6">
		<label>Mass Offered By</label>
		<input type="text" name="payors_name" class="form-control" placeholder="Optional" />
		</div>
    	<div class="col-sm-6">
    		<label>Mass Offering Type</label>
    		<select  class="form-control" name="mode_of_payment" required > 
			<option></option>
			<option>Cash</option>
			<option>Things</option>
			</select>
    	</div>
	</div>
	<div class="row">
	<div class="col-sm-6">
	<label>Amount if Cash</label>
	<input type="number" class="form-control" name="price" placeholder="Donated Amount" />
	</div>
	<div class="col-sm-6">
	<label>Mass Offering Date</label>
	<input type="text" class="form-control" id="date_filter" name="date_of_payment" placeholder="Donated Amount" />
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