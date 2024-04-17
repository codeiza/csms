<?php
session_start();

require_once 'connection.php';
if($_SESSION["user"]["accountType"] == 'Parishioner'){
	echo 'You are not autorize to show this content';
}else{
try{
	   $pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
	   "SELECT * FROM schedule_list
	   WHERE
	   id = '".$_REQUEST["id"]."'
	   "
	   );
	 $stmt->execute();
	 $tbody ='';
	 $sNum = 1;
	 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		 $tbody .= '<tr>';
		   $tbody .= '<td>'.$row["title"].'</td>';	
		   $tbody .= '<td><b>Start:</b>'.$row["start_datetime"].'</td>';		
		   $tbody .= '<td><b>Name:</b> '.$row["reserve_by"].'<br><b>Phone Number:</b> <b>'.$row["contact_no"].'</b><br><b>Email:</b> '.$row["email"].'</td>';
		   $tbody .= '</tr>';
		
	 }
	 } catch (PDOExeption $e) {
	   echo $e->getMessage();
   }
   //echo $sample2;
   $pdo = null; 
?>

<table class="table table-striped table-condensed table-hover table-bordered">
	<thead class="btn-info">
		<tr>
		<th class="tsugtsug">Event Type</th>
		<th>Date & Time of Event</th>
		<th>Contact Info</th>
		

		</tr>
		
	</thead>
	<tbody>
		<?php echo $tbody?>
	</tbody>
</table>
<?php
}
?>
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
	$(document).on('dblclick', '.editable_date', function() {
    var edit_flag = false;
    var $this = $(this); // Define $this correctly

    if (edit_flag) return;

    var column = $this.attr('id').split('-')[0];
    var id = $this.attr('id').split('-')[1];

    var input = '<input type="text" class="editabled" value="' + $this.text() + '">';

    $this.html(input);

    var $editabledInput = $("input.editabled", $this);

    $editabledInput.datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3m',
        autoclose: true
    });

    $editabledInput.on('changeDate', function(e) {
        // Update the input value with the selected date
        $editabledInput.val(e.format('yyyy-mm-dd'));
        $editabledInput.datepicker('hide'); // Hide the datepicker after selection
    });

    $editabledInput.on('hide', function() {
        saveEditable($editabledInput.val(), id, column);
        $this.text($editabledInput.val());
        $editabledInput.unbind().remove();
        edit_flag = false;
    });

    // Show the datepicker when focusing on the input
    $editabledInput.datepicker('show');

    edit_flag = true;
});
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


})
</script>