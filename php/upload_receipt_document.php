 <?php
 //print_r($_REQUEST);
 ?>
 <form method="post" action="update_attachement_document.php" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>"/>
 <div class="col-sm-6">
    		<label>Attachment</label>
   <input type="file" class="form-control" name="payment_attachment" required>
   </div>
   <button type="submit" class="btn btn-sm btn-success" NAME="addrecord"> Save</button>
 </form>