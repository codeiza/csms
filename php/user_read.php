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
		$where .="WHERE firstName like '%".$_REQUEST["keyword"]."%' and delete_date is null "; 
	 }else{
		$where .="WHERE firstName  is not null and delete_date is null";
	 }
	
	$limit = " limit ".(($_REQUEST["page"] - 1) * $_REQUEST["perpage"])."
	, ".$_REQUEST["perpage"];
		try{
		$pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
		"SELECT * FROM users
		
		".$where
		);
		
		$stmt->execute();
		$total = $stmt->rowCount();
		
		/////
		$stmt = $pdo->prepare(
		"SELECT * FROM users
		
		".$where.$limit
		);
		$stmt->execute();
		$cnt = $stmt->rowCount();
		$tbody = '';
		$sNum = 1;
		
	
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$picturePath = $row["picture_data"];
			if (!empty($picturePath)) {
				$avatarImage = '<a href="picture_data/' . $picturePath . '"><img src="picture_data/' . $picturePath . '" alt="Avatar" height="70px"></a>';
			} else {
				$avatarImage = '<img src="image/profile.png" alt="Avatar" height="70px">';
			}
		    $tbody .= '<tr>';
			$tbody .= '<td>' . $avatarImage . '</td>';
			$tbody .= '<td class="editable" style="background-color:#FFFFE0" id="accountType-'.$row["id"].'">'.$row["accountType"].'</td>';
			$tbody .= '<td>'.$row["firstName"].'</td>';
			$tbody .= '<td>'.$row["lastName"].'</td>';
			$tbody .= '<td>'.$row["userName"].'</td>';
			$tbody .= '<td>'.$row["email"].'</td>';
			$tbody .= '<td>'.$row["phoneNumber"].'</td>';
			$tbody .= '<td>'.$row["birthdate"].'</td>';
			$tbody .= '<td>'.$row["Age"].'</td>';
			$tbody .= '<td>'.$row["address"].'</td>';
			$tbody .= '<td>
			<i class="fa fa-edit fa-xl update" style="color:blue" id="'.$row["id"].'"
			firstName="'.$row["firstName"].'"
			lastName="'.$row["lastName"].'"
			userName="'.$row["userName"].'"
			email="'.$row["email"].'"
			phoneNumber="'.$row["phoneNumber"].'"
			birthdate="'.$row["birthdate"].'"
			Age="'.$row["Age"].'"
			address="'.$row["address"].'"
			> <i class="fa fa-trash-o fa-xl delete" style="color:red" id="'.$row["id"].'"></i> </i></td>';
			$tbody .= '</tr>';
			$sNum ++;
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
 
?>

<table class="table table-striped table-condensed table-hover table-bordered" id="table">
    <thead>
        <tr class="bg-success" id="fixed_headers">
            <th class="head1">Picture</th>
            <th class="head1">Account Type</th>
            <th class="head1">First Name</th>
            <th class="head1">Last Name</th>
            <th class="head1">User Name</th>
            <th class="head1">Email</th>
            <th class="head1">Phone Number</th>
            <th class="head1">Birth Date</th>
            <th class="head1">Age</th>
            <th class="head1">Address</th>
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
                text: "Deleted Successfully",
                type: type
            });
			location.href='./floor.php'
		})
 
	})
	
	$(document).on('click','.update',function(){

 
		$.ajax({
			type: 'post',
			url: 'php/update_user.php',
			data: {
				id: $(this).attr('id'),
				firstName: $(this).attr('firstName'),
				lastName: $(this).attr('lastName'),
				userName: $(this).attr('userName'),
				email: $(this).attr('email'),
				phoneNumber: $(this).attr('phoneNumber'),
				birthdate: $(this).attr('birthdate'),
				Age: $(this).attr('Age'),
				address: $(this).attr('address')
				
			}
		}).done(function(data){
			$(".modal-title").html('Update User')
			$(".modal-body-1").html(data)
			$(".modal").modal('show')
		})
 
	})


})
</script>
