<?php 
//session_start();
//print_r($_REQUEST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="description" content="maria.com" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="https://cdn.gtranslate.net/widgets/latest/fn.js" defer></script>
	<link rel="stylesheet" href="css/style_chapter.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400&display=swap">
    <title>The Magical World of Mark and Maria</title>
	<?php
	$selected_language = 'en'; // Default to English if the language is not set

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        if ($name === 'googtrans') {
            $selected_language = substr($parts[1], 3, 2);
            break; // Exit loop once the language is found
        }
    }
}

	?>
    <style>
    body{
    font-family: 'EB Garamond', serif;
    font-size: 12px;
    font-weight: bold;
  }
  .nav-link{
    font-family: 'EB Garamond', serif;
    font-size: 20px;
    font-weight: bold;
  }
  h4{
    font-family: 'EB Garamond', serif;
    font-size: 30px;
    font-weight: bold;
  }
  h5{
    font-family: 'EB Garamond', serif;
    font-size: 20px;
    font-weight: bold;
  }
  .book-item {
    flex: 0 0 calc(33.33% - 20px); /* Adjust the width according to your design */
    margin: 5px; /* Adjust the margin according to your design */
    text-align: center; 
}
.book-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    max-width: 900px; /* Adjust this value according to your design */
    margin: 0 auto; /* Centers the container horizontally */
    font-weight: bold;
}
.custom-margin-top {
        margin-top: 30px; /* Adjust this value as needed */
		position:obsolute;
    }

   </style>
</head>
<body>
 
<div class="website_title" style=" text-align:center">
    <h1 >The Magical World of Mark and Maria</h1>
</div>
 <!-- Navigation Bar -->
 <?php require_once 'design/navigation2.php'; ?>
  <!-- Navigation Bar -->
<?php 
require_once 'php/connection.php';
try {
    $pdo = new PDO(DSN, DB_USR, DB_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_GET['id'];
	$stmt = $pdo->prepare(
		"SELECT * FROM book_table where id != '10'
		"
		);
	$stmt->execute();
    $stmt2 = $pdo->prepare(
		"SELECT * FROM book_table where id = :id
		"
		);
    $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt2->execute();
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $id2 = $row2["id"];
		if($selected_language == 'en' || $row2["book_title_tagalog"] == ''){
        $book_title2 = $row2["book_title"];
		}else{
		$book_title2 = $row2["book_title_tagalog"];	
		}
        if($selected_language == 'en' || $row2["description_tagalog"] == ''){
        $description2x = $row2["description"];
        $description2 = nl2br($description2x);
		}else{
		$description2x = $row2["description_tagalog"];	
		$description2 = nl2br($description2x);	
		}
        
        $books_path2 = $row2["books_path"];  
    }

	?>    
<div class="container custom-margin-top">
<div class="row ">
        <div class="col-sm-4 mb-0" >
            <img id="selectedItemImage"  alt="" src="book_cover/<?php echo $books_path2 ?>" style="border: 1px solid black; height: 480px; width:350px" class="img-fluid imgphone">
        </div>
        <div class="col-sm-4 ">
            <h2 id="selectedItemDisplay" class="titlephone"><?php echo $book_title2; ?></h2>
            <h5 id="selected_des" style="font-size:20px" class="textphone"><?php  echo $description2; ?></h5>
        </div>
		<div class="col-sm-4">
		<?php
		 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row["id"];
					if($selected_language == 'en' || $row["book_title_tagalog"] == ''){
                    $book_title = $row["book_title"];
					}else{
					$book_title = $row["book_title_tagalog"];	
					}
					if($selected_language == 'en' || $row["description_tagalog"] == ''){
                    $descriptionx = $row["description"];
                    $description = nl2br($descriptionx);
					}else{
					$descriptionx = $row["description_tagalog"];	
					$description = nl2br($descriptionx);	
					}	
                    $books_path = $row["books_path"];
                    $date_entry = $row["date_entry"];
                    $chapter = $row["chapter"];
                    $price = $row["price"];
                    $content_pdf_php = $row["content_pdf"];

				?>
				<span class="picture" >
					<img  src="book_cover/<?php echo $books_path ?>" id="<?php echo $row["id"] ?>" style="border: 1px solid black; margin-top:10px; margin-right:10px; margin-right:0px" height="150px" width="110px" >
					<div class="title" style="display:none"><?php echo $book_title ?></div>
                    <div class="descrip" style="display:none; font-size:20px"><?php  echo $description ?></div>
				</span>
		 <?php 
		   }
					
				?>
        </div>
	<?php
			} catch (PDOException $e) {
					echo $e->getMessage();
				}
	?>
           

	
 </div>
 </div>


 
<script src="js/chapter_script.js"></script>
<script>

$(document).ready(function(){
    $(document).on('click','.picture',function(){
        var selectedItemImageSrc = $(this).find('img').attr('src');
        var selectedItemTitle = $(this).find('.title').text();
        var selectedItemdes = $(this).find('.descrip').text();
        $('#selectedItemImage').attr('src', selectedItemImageSrc);
        $('#selectedItemDisplay').html('<h2>' + selectedItemTitle +'</h2>');
		selectedItemdes = selectedItemdes.replace(/\n/g, '<br>');
        $('#selected_des').html( selectedItemdes);
		
    })

})


</script>
</body>