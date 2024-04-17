 <?php
 //print_r($_REQUEST);
 ?>
 <form method="post" action="php/send_document_owner.php" enctype="multipart/form-data">
 <div class="row">
	<div class="col-sm-3">
		<label>Requestor</label>
		<input type="text" class="form-control" value="<?php echo $_REQUEST["requested_by"]; ?>" readonly>
   </div>
   <div class="col-sm-3">
		<label>Email</label>
		<input type="text" class="form-control" name="email" value="<?php echo $_REQUEST["email"]; ?>" readonly>
   </div>
 </div>
 <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>"/>
 <div class="col-sm-6">
    		<label>Attachment</label>
   <input type="file" class="form-control" name="payment_attachment" required>
   </div>
   <button type="submit" class="btn btn-sm btn-success" NAME="addrecord"> Send Document</button>
 </form>