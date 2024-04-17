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
		$where .="WHERE reserve_by like '%".$_REQUEST["keyword"]."%' and Status = 'For payment' and cancel_delete is null "; 
	 }else{
		$where .="WHERE reserve_by  is not null and Status = 'For payment' and cancel_delete is null";
	 }
	
	$limit = " limit ".(($_REQUEST["page"] - 1) * $_REQUEST["perpage"])."
	, ".$_REQUEST["perpage"];
		try{
		$pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
		"SELECT * FROM schedule_list
		
		".$where
		);
		
		$stmt->execute();
		$total = $stmt->rowCount();
		
		/////
		$stmt = $pdo->prepare(
		"SELECT * FROM schedule_list
		
		".$where.$limit
		);
		$stmt->execute();
		$cnt = $stmt->rowCount();
		$tbody = '';
		$sNum = 1;
		
	
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    $tbody .= '<tr>';
			$tbody .= '<td class="" id="event_type-'.$row["id"].'">'.$row["event_type"].'</td>';
			$tbody .= '<td class="editable" style="background-color:#FFFFE0" id="Status-'.$row["id"].'">'.$row["Status"].'</td>';
			$tbody .= '<td class="" >'.$row["start_datetime"].'</td>';
			$tbody .= '<td class="" >'.$row["end_datetime"].'</td>';
			$tbody .= '<td class="" >'.$row["reserve_by"].'</td>';
			$tbody .= '<td class="" >'.$row["payment_type"].'</td>';
			$tbody .= '<td class="" >'.$row["contact_no"].'</td>';;
			$tbody .= '<td>
			<button  class="btn btn-danger delete" id="'.$row["id"].'"><span class="fa fa-trash-o" ></span></button></td>';
			$tbody .= '</tr>';
			$sNum ++;
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
 
?>

<table class="table table-striped table-condensed table-hover table-bordered">
	<thead>
		<tr class="bg-success">
			
			<th class="head1">event_type</th>
			<th class="head1">Status</th>
			<th class="head1">start_datetime</th>
			<th class="head1">end_datetimee</th>
			<th class="head1">reserve_by</th>
			<th class="head1">payment_type</th>
			<th class="head1">contact_no</th>
			<th class="head1">Action</th>
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