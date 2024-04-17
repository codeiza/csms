 <?php
 //print_r($_REQUEST);
 ?>
 <form method="post" action="update_attachement.php" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>"/>
 <input type="hidden" name="event_type" value="<?php echo $_REQUEST["event_type"]; ?>"/>
 <input type="hidden" name="payors_name" value="<?php echo $_REQUEST["reserve_by"]; ?>"/>
 <input type="hidden" name="price" value="<?php echo $_REQUEST["amount_paid"]; ?>"/>
 <div class="row">
 <div class="col-sm-6">
    		<label>Attachment receipt</label>
   <input type="file" class="form-control" name="payment_attachment" required>
   </div>
    <div class="col-sm-6">
	<label>Payment Type</label>
	<select class="form-control" name="payment">
	<option>G-Cash</option>
	<option>Online Banking</option>
	</select>
   </div>
 </div>
   <button type="submit" class="btn btn-sm btn-success" NAME="addrecord"> Save</button>
 </form>