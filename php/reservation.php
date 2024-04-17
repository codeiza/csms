<?php 
require_once 'option_price.php';
?>
<div id="refresh">

</div>
<script>
$(document).ready(function(){
function load(){
		//$("#loading").html('<img src="img/loading.gif">');
		$.ajax({
			type: 'post',
			url: 'php/reservation_read.php',
			
		}).done(function(data){
			$("#refresh").html(data)
			$("#loading").empty()

			
		})
	}
load()	
$(document).on('click','.verify',function(){
	
		if(!confirm('Are you sure you want to approve the payment?')){
			return false;
		}
		var value = ('Confirm');
		var column = $(this).attr('id').split('-')[0]
		var id = $(this).attr('id').split('-')[1]
		var event = $(this).attr('event')
		var start = $(this).attr('start')
		var email = $(this).attr('email')
		var amount_paid = $(this).attr('amount_paid')
		var reserve_by = $(this).attr('reserve_by')
		var date_paid = $(this).attr('date_paid')
		var request_form_id = $(this).attr('request_form_id')
		var payment_type = $(this).attr('payment_type')
		$.ajax({
			type: 'post',
			url: 'php/editable.php',
			data: {
				col: $(this).attr('col'),
				value: value,
				id: id,
			    column: column,
			    event: event,
			    start: start,
			    email: email,
			    amount_paid : amount_paid,
			    date_paid :date_paid,
			    reserve_by : reserve_by,
			    payment_type : payment_type,
			   request_form_id : request_form_id
			   }
		}).done(function(data){
			//alert(data);
			//location.href='./'
			load()
 
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
        }else if(column == 'payment_type'){
				var input =
			'<select id="myselect">'+
				'<option value="'+$(this).text()+'"></option>'+
				'<option>For Donation</option>'+
				'<option>For Payment</option>'
			'</select>';
        }else if(column == 'amount_paid'){
				var input =
			'<select id="myselect">'+
				'<option value="'+$(this).text()+'"></option>'+
				
				
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
			load()
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
