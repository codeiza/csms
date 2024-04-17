<?php
 require_once 'php/connection.php';
try{
	   $pdo = new PDO( DSN, DB_USR, DB_PWD );
		$pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(
	   "SELECT * FROM schedule_list
		   WHERE
		   (Status = 'For Schedule' or Status = 'For Verification' or Status = 'For Reserve' or Status = 'For Document Verification')and confirm_priest is not null and cancel_delete is null
		   "
		   );
		 $stmt->execute();
	 $total = $stmt->rowCount();
	 } catch (PDOExeption $e) {
	   echo $e->getMessage();
   }

?>
<div class="top-bar">
	<div class="profile">
		<span>Manage Users</span>
		<div>
		<span class="fa fa-bell noti" style="color:red">
		<?php if (@$_SESSION["user"]["accountType"] == 'Admin' and $total > '0') { ?>
		<sup style="color:red;" class="flashited"><?php 
		echo $total; ?></sup></span>
		<?php }else{
		}    if(!isset($_SESSION['user'])){ ?>
		<img src="picture_data/profile.png" alt="Profile Image">
	<?php	}else{
		?>
		<img src="picture_data/<?php echo $_SESSION["user"]["picture_data"]; ?>" alt="Profile Image" id="profile" >
		<?php } ?>
		</div>
	</div>
</div>