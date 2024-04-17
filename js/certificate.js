$(function(){

	function load(keyword,perpage,page,event_case){
		$("#loading").html('<img src="img/loading.gif">');
		$.ajax({
			type: 'post',
			url: 'php/certificate_read.php',
			data:{
				keyword : keyword,
				perpage : perpage,
				page : page,
				event_case : event_case
			}
		}).done(function(data){
			$("#cert").html(data)
			$("#loading").empty()

			
		})
	}
	

	
	load($("#keyword").val(),$("#perpage").val(),1,$("#event_case").val())
	

	

 
	$(document).on('keyup','#keyword',function(){
		load($("#keyword").val(),$("#perpage").val(),1,$("#event_case").val())
		
		
	})
 
 $(document).on('change','#perpage',function(){
	 load($("#keyword").val(),$(this).val(),1)
	// load5($("#datefrom").val(),$(this).val(),1,$("#dateto").val())
	
 })
 	$(document).on('click','.page',function(){
		load($("#keyword").val(),$("#perpage").val(),1,$("#event_case").val())
		
	})
	$(document).on('change','#event_case',function(){
		load($("#keyword").val(),$("#perpage").val(),1,$(this).val())
		
	})
 
 $(document).on('click','#next',function(){
		 var page = ($('ul.pagination li.active').text())
		// alert(parseInt(page) + 1)
		 load($("#keyword").val(),$("#perpage").val(),(parseInt(page) + 1))
		 
	 })
	
	$(document).on('click','.certifi',function(){
	location.href='php/baptismal_pdf.php?id='+$(this).attr('id');

	})
	$(document).on('click','.wedding_cert',function(){
	location.href='php/weeding_pdf.php?id='+$(this).attr('id');
//alert('wdd');
	})
	//view more
	
	
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
	$(document).on('click','#add_mass_off',function(){
	//alert('');
		$(".modal-title").html('Add Mass Offering')
		$(".modal-body-1").load('php/add_mass_offering.php')
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

	
 $(document).on('click','.approved',function(){
 //alert($(this).attr('email'))

				if(!confirm('Are you sure you want to approve?')){
					alert('No Changes');
					return false;
				}else{	
			
				
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
				if(date_paid == '' || amount_paid == ''){
				alert('Please input amount_paid and date_paid')
				}else{
				$(this).html('Confirm')
				$.ajax({
					type:'post',
					url: 'php/editable.php',
					data:{
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
				//	alert('Already Approved')
				//	location.href='./'
				})
				
				}
				}
				
		})

	
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