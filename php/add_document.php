<?php
//Print_r($_REQUEST);
?>
 <form method="post" action="php/update_forpayment.php" enctype="multipart/form-data">
  <div class="container">
	<div class="row">
	 <div class="col-sm-6">
    		<label>Document Type</label>
    		<select  class="form-control" name="event_type" id="docType" required > 
			<option><?php echo $_REQUEST["document_type"]; ?></option>
			</select>
     </div>
		<div class="col-sm-6">
		<label>Document Owner</label>
		<input type="text" name="payors_name" value="<?php echo $_REQUEST["document_owner"]; ?>" class="form-control" placeholder="Search Last Name or Firstname" id="searchkey" required/>
		</div>
	</div>
	<div class="row">
	<div class="col-sm-6">
		<label>Status</label>
		<select class="form-control" name="request_status">
		<option>For Payment</option>
		<option>For Donation</option>
		</select>
	</div>
	<div class="col-sm-6">
	<label>Amount</label>
		<input type="number" class="form-control" name="amount" required />
		<input type="hidden" class="form-control" name="id" value="<?php echo $_REQUEST["id"]; ?>" />
	</div>
	</div>
	<div class="row">
	<div class="col-sm-6">
	<label>Requestor</label>
		<input type="text" class="form-control" name="email" value="<?php echo $_REQUEST["requested_by"]; ?>" />
	</div>
	<div class="col-sm-6">
	<label>Email Address</label>
		<input type="email" class="form-control" name="email" value="<?php echo $_REQUEST["email"]; ?>" />
	</div>
	</div>

	
	<div>
	<br>
	<button type="submit" class="btn btn-sm btn-success" >Send To Requestor</button>
	</div>
	<br>
	</div>
	 </form>
	 <div id="docume_show">
	 </div>
	<script>
		$("#date_filter").datepicker({
    		format: 'yyyy-mm-dd',
    		startDate: '-3m',
    		autoclose: true
    		})
	function load(searchkey,perpage,page,docType){
		$("#loading").html('<img src="img/loading.gif">');
		$.ajax({
			type: 'post',
			url: 'php/read_document_sub.php',
			data:{
				searchkey : searchkey,
				perpage : perpage,
				page : page,
				docType : docType
			}
		}).done(function(data){
			$("#docume_show").html(data)
			$("#loading").empty()

			
		})
	}
	load($("#searchkey").val(),$("#perpage").val(),1,$("#docType").val())
/*	
	$(document).on('change','#docType',function(){
		load($("#searchkey").val(),$("#perpage").val(),1,$(this).val())
	})
	*/
	$(document).on('keyup','#searchkey',function(){
		load($("#searchkey").val(),$("#perpage").val(),1,$("#docType").val())
	})
	
	</script>
	 
	