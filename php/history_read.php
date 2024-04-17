<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
        body {
       
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h6 {
            color: #333;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .bg-success {
            background-color: #5cb85c;
            color: #fff;
        }

        .head1 {
            width: 150px; /* Adjust the width as needed */
        }

        p {
            margin-bottom: 15px;
        }
		body {
    font-family: Arial, sans-serif;
}
    </style>
</head>
<?php
session_start();
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
		$where .="WHERE reference_num like '%".$_REQUEST["keyword"]."%'"; 
	 }else if($_REQUEST["payment"] == 'All'){
		 $where .="WHERE payment_type != 'For Payment'";
	 }else{
		$where .="WHERE payment_type != 'For Payment' and title = '".$_REQUEST["payment"]."'";
	 }
	}else{
		if($_REQUEST["keyword"]){
		$where .="WHERE reference_num like '%".$_REQUEST["keyword"]."%' and user_id = '".@$_SESSION["user"]["id"]."' "; 
	 }else if($_REQUEST["payment"] == 'All'){
		 $where .="WHERE payment_type != 'For Payment' and user_id = '".@$_SESSION["user"]["id"]."'";
	 }else{
		$where .="WHERE payment_type != 'For Payment' and title = '".$_REQUEST["payment"]."' and user_id = '".@$_SESSION["user"]["id"]."'";
	 }
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
			$date_enter = $row["date_paid"];
			$date = new DateTime($date_enter);
			$formattedDate = $date->format('Y-m-d h:i:s A');
		    $tbody .= '<tr>';
			//if($row["mode_of_payment"] == 'For Payment'){
			//$tbody .= '<td class="" ><b style="color:red">'.$row["mode_of_payment"].'</b><br><span style="font-size:13px">'.$formattedDate.'</span></td>';	
			//}else{
			$tbody .= '<td class="" ><b>Send Money->'.$row["payment_type"].'</b><br><span style="font-size:13px">'.$formattedDate.'</span></td>';	
			//}
			$tbody .= '<td class="" ><b><a href="resibo/'.$row["payment_attachment"].'" target="blank">₱'.$row["amount_paid"].'.00</a></b></td>';
			$tbody .= '<td class="" >'.$row["reference_num"].'</b></td>';
			if (@$_SESSION["user"]["accountType"] == 'Admin'){
			$tbody .= '<td>
			<button  class="btn btn-danger delete" id="'.$row["id"].'"><span class="fa fa-trash-o" ></span></button></td>';
			}else{
			$tbody .= '<td>
			<button  class="btn btn-danger delete" id="'.$row["id"].'" disabled><span class="fa fa-trash-o" ></span></button></td>';	
			}
			$tbody .= '</tr>';
			$sNum ++;
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
 
?>

        <h6><b>Total Amount</b></h6>
        <table class="table table-striped table-condensed table-hover table-bordered">
    <thead>
        <tr class="bg-success text-black">
            <th style="width:500px" class="text-center">Detail</th>
            <th style="width:300px" class="text-center">Amount</th>
            <th style="width:400px" class="text-center">Reference No.</th>
            <th style="width:400px" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php echo $tbody ?>
    </tbody>
</table>


        <p><span id="cnt"><?php echo $cnt ?></span> Record(s) Found.</p>
        <?php

        $li = '';

        $pages = new Paginator($total, 3)
        ?>
        <!--
        <ul class="pagination">
            <?php // echo $pages->display_pages();?>
        </ul>
        --->
 
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