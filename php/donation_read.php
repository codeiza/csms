<?php
session_start();
//print_r($_SESSION);
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
	 if(@$_SESSION["user"]["accountType"] == 'Admin'){
	if($_REQUEST["keyword"]){
		$where .="WHERE payors_name like '%".$_REQUEST["keyword"]."%' "; 
	 }else{
		$where .="WHERE amount_value is not null ";
	 }	 
	 }else{
	 if($_REQUEST["keyword"]){
		$where .="WHERE donated_by like '%".$_REQUEST["keyword"]."%' and user_id = '".$_SESSION["user"]["id"]."' "; 
	 }else{
		$where .="WHERE donated_by is not null and user_id = '".@$_SESSION["user"]["id"]."' ";
	 }
	}
	$limit = " limit ".(($_REQUEST["page"] - 1) * $_REQUEST["perpage"])."
	, ".$_REQUEST["perpage"];
		try{
		$pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
		"SELECT * FROM donation
		
		".$where
		);
		
		$stmt->execute();
		$total = $stmt->rowCount();
		
		/////
		$stmt = $pdo->prepare(
		"SELECT * FROM donation
		
		".$where.$limit
		);
		$stmt->execute();
		$cnt = $stmt->rowCount();
		$tbody = '';
		$sNum = 1;
		
	
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    $tbody .= '<tr>';
			$tbody .= '<td class="" >'.$row["donated_by"].'</td>';
			$tbody .= '<td class="" >'.$row["date_of_donation"].'</td>';
			$tbody .= '<td class="" >₱'.$row["amount_value"].'</td>';
			
			$tbody .= '<td>
			<a  href="receipt_donation/'.$row["receipt"].'" target="blank" class="btn btn-sm btn-info"><span class="fa fa-file-pdf-o fa-3x" ></span></a>
			</td>';
			
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
			<th class="head1">Donated By</th>
			<th class="head1">Date Donate</th>
			<th class="head1">Amount</th>
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



})
</script>