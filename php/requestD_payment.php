<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
 <script src="../js/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Documents Payment</title>
</head>
 


 <!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header  bg-success">
			<h4 class="modal-title">Modal title</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			<div class="modal-body-1"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
<?php
require_once 'connection.php';
try {
   $pdo = new PDO( DSN, DB_USR, DB_PWD );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM requested_document WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

		$tbody = '';
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
          //  echo "User ID: " . $user['id'] . "<br>";
          //  echo "price: " . $user['price'] . "<br>";
			$tbody .= '<tr>';
			$tbody .= '<td><center>'.$user["document_type"].'</center></td>';
			$tbody .= '<td><center>'.$user["requested_by"].'</center></td>';
			$tbody .= '<td><center>'.$user["request_status"].'</center></td>';
			$tbody .= '<td><center>'.$user["amount"].'</center></td>';
			$tbody .= '<td><center><button class="btn btn-info upload_fordocu" id="'.$user["id"].'">Click here to Pay</button></center></td>';
			$tbody .= '</tr>';
        } else {
            echo "User not found.";
        }
    } else {
        echo "ID parameter is missing.";
    }
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>
<center>
<table class="table table-striped table-condensed table-hover table-bordered">
<thead class="bg-success">
<th class="head1"><center>Document Type</center></th>
<th class="head1"><center>Requested By</center></th>
<th class="head1"><center>Requested Statusv</th>
<th class="head1"><center>Amount</center></th>
<th class="head1"><center>Action</center></th>
</thead>
<tbody>
		<?php echo $tbody?>
	</tbody>
</table>
<script>
$(document).ready(function(){
	$(document).on('click','.upload_fordocu',function(){
	//alert('');
	/*	$(".modal-title").html('Upload receipt')
		$(".modal-body-1").load('upload_receipt.php')
		$("#confirmModal").modal('show')
		*/
		 $.ajax({
					type:'post',
					url: 'upload_receipt_document.php',
					data:{
						id : $(this).attr('id'),
						
						
					}
				}).done(function(data){
			$(".modal-title").html('Upload Payment') 
			$(".modal-body-1").html(data)
			$(".modal").modal('show');
				})
		
	})
	});
</script>