$(function(){

$(document).on('click','.noti',function(){
	//alert('');
		$(".modal-title").html('For Accept Reservation')
		$(".modal-body-1").load('php/reservation.php')
		$("#confirmModal").modal('show')
		
	})
	
	$(document).on('click','.priest_noti',function(){
	//alert('');
		$(".modal-title").html('Upcoming events posted on your calendar')
		$(".modal-body-1").load('php/priest_schedule.php')
		$("#confirmModal").modal('show')
		
	})
	
	$(document).on('click','.noti_client',function(){
	//alert('');
		$(".modal-title").html('For Payment')
		$(".modal-body-1").load('php/for_payment.php')
		$("#confirmModal").modal('show')
		
	})
	
	$(document).on('click','.noti_client',function(){
	//alert('');
		$(".modal-title").html('Attention')
		$(".modal-body-1").load('php/client_notification.php')
		$("#confirmModal").modal('show')
		
	})
	
	
})