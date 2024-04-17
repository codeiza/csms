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
		//$where .="WHERE firstName like '%".$_REQUEST["keyword"]."%' and delete_date is null "; 
		$where .="WHERE (wedding_husband_name like '".$_REQUEST["keyword"]."%' or wedding_wife_name like '".$_REQUEST["keyword"]."%' or bap_fullname like '".$_REQUEST["keyword"]."%') and (Event_type = 'Wedding' or Event_type = 'Baptismal')  "; 
	 }else if($_REQUEST["event_case"] != ''){
		$where .="WHERE Event_type = '".$_REQUEST["event_case"]."'";
	 }else{
		$where .="WHERE Event_type = 'Wedding' or Event_type = 'Baptismal' and (datetime_merriage <= '".date('Y-m-d')."%' or bap_baptismDateTime <= '".date('Y-m-d')."%')";
	 }
	$limit = " limit ".(($_REQUEST["page"] - 1) * $_REQUEST["perpage"])."
	, ".$_REQUEST["perpage"];
		try{
		$pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
		"SELECT * FROM request_form
		
		".$where
		);
		
		$stmt->execute();
		$total = $stmt->rowCount();
		
		/////
		$stmt = $pdo->prepare(
		"SELECT * FROM request_form
		
		".$where.$limit
		);
		$stmt->execute();
		$cnt = $stmt->rowCount();
		$tbody = '';
		$sNum = 1;
		
	
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    $tbody .= '<tr>';
			$tbody .= '<td class="" id="Event_type-'.$row["id"].'">'.$row["Event_type"].'</td>';
			if($row["Event_type"]== 'wedding'){
			$tbody .= '<td class="" >'.$row["wedding_husband_name"].'</td>';
			$tbody .= '<td class="" >'.$row["wedding_wife_name"].'</td>';
			}else if($row["Event_type"]== 'Baptismal'){
			$tbody .= '<td class="" >'.$row["bap_fullname"].'</td>';
			$tbody .= '<td class="" >-</td>';
			}
			if($row["Event_type"] == 'wedding'){
			$tbody .= '<td><button  class="btn btn-success wedding_cert" id="'.$row["id"].'"><span class="fa fa-print" ></span>Print</button></td>';	
			}else{
			$tbody .= '<td><button  class="btn btn-success certifi" id="'.$row["id"].'"><span class="fa fa-print" ></span>Print</button></td>';
			}
			$tbody .= '</tr>';
			$sNum ++;
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
 
?>

<table class="table table-striped table-condensed table-hover table-bordered" id="table">
	<thead id="fixed_header">
		<tr class="bg-success">
			
			<th style="width:600px" class="text-center">Event Type</th>
			<th style="width:600px" class="text-center">Document Owner</th>
			<th style="width:600px" class="text-center">Document Owner</th>
			<th style="width:100px" class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tbody?>
	</tbody>
</table>

<p><span id="cnt"><?php echo $cnt?></span> Record(s) Found.<p>
<?php

$li = '';

$pages= new Paginator($total,3)
?>
<!--
<ul class="pagination">
      <?php// echo $pages->display_pages();?>
      </ul>--->
<script>
$(document).ready(function(){

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
		if(!confirm('Are you sure you want to delete ???')){
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
                title: "Title",
                text: "Success fully Deleted",
                type: type
            });
			location.href='./floor.php'
		})
 
	})


})
</script>