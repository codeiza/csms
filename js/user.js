$(function(){

	function load(keyword,perpage,page){
		$("#loading").html('<img src="img/loading.gif">');
		$.ajax({
			type: 'post',
			url: 'php/user_read.php',
			data:{
				keyword : keyword,
				perpage : perpage,
				page : page
			}
		}).done(function(data){
			$("#user").html(data)
			$("#loading").empty()

			
		})
	}
	
	
	load($("#keyword").val(),$("#perpage").val(),1)

	

	

 
	$(document).on('keyup','#keyword',function(){
		load($("#keyword").val(),$("#perpage").val(),1)
		
		
		
	})
 

 	$(document).on('click','.page',function(){
		load4($("#keyword").val(),$("#perpage").val(),1)
		
	})
 
 $(document).on('click','#next',function(){
		 var page = ($('ul.pagination li.active').text())
		// alert(parseInt(page) + 1)
		 load4($("#keyword").val(),$("#perpage").val(),(parseInt(page) + 1))
		 
	 })
	
	$(document).on('click','.noti',function(){
	//alert('');
		$(".modal-title").html('For Accept Reservation')
		$(".modal-body-1").load('php/reservation.php')
		$("#confirmModal").modal('show')
		
	})
	
	$(document).on('click','#profile',function(){
		$(".modal-title").html('Update Profile')
		$(".modal-body-1").load('php/edit_profile.php')
		$("#confirmModal").modal('show')
		
	})
	//view more
	$(document).on('click','#done',function(){
	$(".modal-title").html('List of Donation')
		$(".modal-body-1").load('php/view_more_donation.php')
		$("#confirmModal").modal('show')
	})
	$(document).on('click','#viewmass',function(){
	$(".modal-title").html('List of Donation Mass Offering')
		$(".modal-body-1").load('php/view_more_massoffering.php')
		$("#confirmModal").modal('show')
	})
	$(document).on('click','#viewwedding',function(){
	$(".modal-title").html('List of Wedding Donation')
		$(".modal-body-1").load('php/view_more_wedding.php')
		$("#confirmModal").modal('show')
	})
	$(document).on('click','#baptismv',function(){
	$(".modal-title").html('List of Baptism Donation')
		$(".modal-body-1").load('php/view_more_baptism.php')
		$("#confirmModal").modal('show')
	})
	$(document).on('click','#fune',function(){
	$(".modal-title").html('List of Funeral Donation')
		$(".modal-body-1").load('php/view_more_funeral.php')
		$("#confirmModal").modal('show')
	})
	$(document).on('click','#bless',function(){
	$(".modal-title").html('List of Blessing Donation')
		$(".modal-body-1").load('php/view_more_blessing.php')
		$("#confirmModal").modal('show')
	})

	$(document).on('click','#mss',function(){
	$(".modal-title").html('List of Mass Donation')
		$(".modal-body-1").load('php/view_more_mass.php')
		$("#confirmModal").modal('show')
	})
	$(document).on('click','#worship',function(){
	$(".modal-title").html('List of Worship Donation')
		$(".modal-body-1").load('php/view_more_worship.php')
		$("#confirmModal").modal('show')
	})
	$(document).on('click','#add',function(){
	//alert('');
		$(".modal-title").html('Add Your Donation')
		$(".modal-body-1").load('php/add_donation.php')
		$("#confirmModal").modal('show')
	})
	$(document).on('click','#add_document',function(){
	//alert('');
		$(".modal-title").html('You can find Event Schedule and Add Request Document here')
		$(".modal-body-1").load('php/add_document.php')
		$("#confirmModal").modal('show')
	})
	
	$(document).on('click','.showdata',function(){
	//alert('');show
	  $.ajax({
					type:'post',
					url: 'php/add_document.php',
					data:{
						id : $(this).attr('id'),
						document_owner : $(this).attr('document_owner'),
						document_type : $(this).attr('document_type'),
						email : $(this).attr('email'),
						requested_by : $(this).attr('requested_by')
					}
				}).done(function(data){
			$(".modal-title").html('Check Document Request')
			$(".modal-body").html(data)
			$(".modal").modal('show')
				})
	
	})
	$(document).on('click','#add_user',function(){
	//alert('');
		$(".modal-title").html('Add User')
		$(".modal-body-1").load('php/add_user.php')
		$("#confirmModal").modal('show')
		
	})
	
	$(document).on('click','#Add_minis',function(){
	//alert('');
		$(".modal-title").html('Add Ministry')
		$(".modal-body-1").load('php/add_ministry.php')
		$("#confirmModal").modal('show')
		
	})
	$(document).on('click','.delete',function(){
		if(!confirm('Are you sure you want to delete?')){
			return false;
		}
 
		$.ajax({
			type: 'post',
			url: 'php/delete_donation.php',
			data: {
				id: $(this).attr('id')
				
			}
		}).done(function(data){
			var type = $("#type").val();
            swal({
                title: "Message",
                text: "Deleted Successfully!",
                type: type
            });
			load3($("#keyword").val(),$("#perpage").val(),1)
		})
 
	})
	 $(document).on('click','.disapproved',function(){
 //alert($(this).attr('id'))

				if(!confirm('Are you sure you want to disapprove?')){
					alert('No Changes');
					return false;
				}else{				
				$(this).html('disapproved')
				var value = ('disapproved');
				var column = $(this).attr('id').split('-')[0]
				var id = $(this).attr('id').split('-')[1]
				$.ajax({
					type:'post',
					url: 'php/editable_disaproved.php',
					data:{
						value: value,
						id: id,
						column: column
					}
				}).done(function(data){
					alert('Already Approved')
					location.href='./'
				})
				}
				
		})

	
$(document).on('click', '.approved', function () {
    //alert($(this).attr('email'))

    if (!confirm('Are you sure you want to approve?')) {
        alert('No Changes');
        return false;
    } else {
        var value = 'Confirm';
        var column = $(this).attr('id').split('-')[0];
        var id = $(this).attr('id').split('-')[1];
        var event = $(this).attr('event');
        var start = $(this).attr('start');
        var email = $(this).attr('email');
        var amount_paid = $(this).attr('amount_paid');
        var reserve_by = $(this).attr('reserve_by');
        var date_paid = $(this).attr('date_paid');
        var request_form_id = $(this).attr('request_form_id');
        var payment_type = $(this).attr('payment_type');

        if (payment_type === '') {
            alert('Please input the type of payment');
        } else {
            $(this).html('Confirm');
            $.ajax({
                type: 'post',
                url: 'php/editable.php',
                data: {
                    value: value,
                    id: id,
                    column: column,
                    event: event,
                    start: start,
                    email: email,
                    amount_paid: amount_paid,
                    date_paid: date_paid,
                    reserve_by: reserve_by,
                    payment_type: payment_type,
                    request_form_id: request_form_id
                }
            }).done(function (data) {
                // alert('Already Approved')
                // location.href='./'
            });
        }
    }
});


	
	function CurrentTimestamp() {
		 var myDate = new Date()
		 //year
		 var yyyy = myDate.getFullYear()
		 //month
		 var mm = ( '0' + (myDate.getMonth() + 1)).slice(-2)
		 //Day
		 var dd = ('0' + myDate.getDate()).slice(-2)
		 //Hour
		 var hh = ('0' + myDate.getHours()).slice(-2)
		 //Minute
		 var ii = ('0' + myDate.getMinutes()).slice(-2)
		 //Second
		 var ss = ('0' + myDate.getSeconds()).slice(-2)
		 return yyyy + '-' + mm + '-' + dd + ' ' + hh + ':' + ii + ':' + ss 
		 
		}
  


 


	
 	
 
})