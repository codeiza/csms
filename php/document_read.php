

<?php
session_start();
//print_r($_REQUEST);
function days($rec,$fin,$today){
		if($fin){
			$days = ($fin - $rec) / 60 / 60 / 24;
		}else{
			$days = ($today - $rec) / 60 / 60 / 24;
		}
		return ceil($days);
	}
	//print_r($_SESSION); 
	require_once 'pagination.class.php';
	require_once 'connection.php';
	 $where = "";
	 if($_REQUEST["keyword"]){
		$where .="WHERE document_owner like '".$_REQUEST["keyword"]."%'  ";  
	 }else{
		$where .="WHERE document_owner  is not null And (request_status = 'For Received' or request_status='For Verification')";
	 }
	
	$limit = " limit ".(($_REQUEST["page"] - 1) * $_REQUEST["perpage"])."
	, ".$_REQUEST["perpage"];
		try{
		$pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
		"SELECT * FROM requested_document
		
		".$where
		);
		
		$stmt->execute();
		$total = $stmt->rowCount();
		
		/////
		$stmt = $pdo->prepare(
		"SELECT * FROM requested_document 
		
		".$where.$limit
		);
		$stmt->execute();
		$cnt = $stmt->rowCount();
		$tbody = '';
		$sNum = 1;
		
	
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    $tbody .= '<tr>';
			$tbody .= '<td >'.$row["document_owner"].'</td>';
			$tbody .= '<td >'.$row["document_type"].'</td>';
			$tbody .= '<td class="" >'.$row["requested_by"].'</td>';
			$tbody .= '<td class="" >'.$row["relation_to_owner"].'</td>';
			$tbody .= '<td class="" >'.$row["purpose"].'</td>';
			if($row["request_status"] == 'For Verification'){
			$tbody .= '<td class="" ><a href="resibo/'.$row["payment_attachment"].'" target="blank">'.$row["request_status"].'</a></td>';	
			}else{
			$tbody .= '<td class="" >'.$row["request_status"].'</td>';	
			}
			
			$tbody .= '<td class="" >'.$row["date_request"].'</td>';
			//$tbody .= '<td class="" >'.$row["mode_of_payment"].'</td>';
			//$tbody .= '<td class="" >'.$row["amount"].'</td>';
			$tbody .= '<td class="" ><a href="supporting_docs/'.$row["supporting_docs"].'" target="blank" class="btn btn-sm btn-info"><span class="fa fa-file-pdf-o fa-3x"></span></a></td>';
			if($row["request_status"] == 'For Verification'){
				$tbody .= '<td  ><button class="btn btn-success senddocument" requested_by="'.$row["requested_by"].'" email="'.$row["email_add"].'" id="'.$row["id"].'">Send</button></td>';
				}else{
			$tbody .= '<td class="" ><button class="btn btn-success showdata" requested_by="'.$row["requested_by"].'" email="'.$row["email_add"].'" id="'.$row["id"].'" document_owner="'.$row["document_owner"].'" document_type="'.$row["document_type"].'"><span class="fa fa-eye"></span></button></td>';
			}
			$sNum ++;
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
 
?>

<div class="container">
  <table class="table table-striped table-condensed table-hover table-bordered" id="table">
    <thead id="fixed_header">
      <tr class="bg-success">
        <th style="width:300px" class="text-center">Document Owner</th>
        <th style="width:300px" class="text-center">Document Type</th>
        <th style="width:300px" class="text-center">Requested By</th>
        <th style="width:300px" class="text-center">Relation To The Owner</th>
        <th style="width:300px" class="text-center">Purpose</th>
        <th style="width:300px" class="text-center">Request Status</th>
        <th style="width:300px" class="text-center">Date Request</th>
        <th style="width:300px" class="text-center">Supporting Document</th>
        <th style="width:300px" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $tbody ?>
    </tbody>
  </table>
  <p><span id="cnt"><?php echo $cnt?></span> Record(s) Found.<p>
</div>

<script>
$(document).ready(function(){
$(document).on('click','.senddocument',function(){
	$.ajax({
					type:'post',
					url: 'php/send_document.php',
					data:{
						id : $(this).attr('id'),
						requested_by : $(this).attr('requested_by'),
						email : $(this).attr('email')
						
						
					}
				}).done(function(data){
			$(".modal-title").html('Upload and send document to requestor') 
			$(".modal-body").html(data)
			$(".modal").modal('show');
				})
})	
$(document).on('dblclick','.editable',editable())
	 	function editable(){
			//alert('f')
		var edit_flag = false;
		return function(){
			if(edit_flag) return
			var column = $(this).attr('id').split('-')[0]
			var id = $(this).attr('id').split('-')[1]
		if(column == 'accountType'){
				var input =
			'<select id="myselect">'+
				'<option value="'+$(this).text()+'"></option>'+
				'<option>Client</option>'+
				'<option>Admin</option>'+
				'<option>Priest</option>'+
				'<option>Parishioner</option>'
			'</select>';
        }else{
			var input =
			'<input type="text" value="'+$(this).text()+'">'
		}
			
			$(this).html(input)
			$("input,select",this).focus().blur(function(){
				saveEditable($(this).val(),id,column)
				$(this).after($(this).val()).unbind().remove()
				edit_flag = false
			})
			edit_flag = true
		}
	}
	
	function saveEditable(value,id,column){
		$.ajax({
			type: 'post',
			url: 'php/editable.php',
			data:{
				value : value,
				id : id,
				column : column
			}
		}).done(function(data){
			//alert('already updated')
		})
	}
	$(document).on('click','.delete',function(){
		if(!confirm('Are you sure you want to delete?')){
			return false;
		}
 
		$.ajax({
			type: 'post',
			url: 'php/delete_user.php',
			data: {
				id: $(this).attr('id')
				
			}
		}).done(function(data){
			//alert(data);
			//location.href='./'
			var type = $("#type").val();
            swal({
                title: "Message",
                text: "Deleted Successfully!",
                type: type
            });
			location.href='./floor.php'
		})
 
	})


})
</script>