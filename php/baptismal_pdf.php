<?php
require('TCPDF/tcpdf.php');
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"SELECT * FROM request_form
		Where id = '".$_REQUEST["id"]."'
		"
		);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$dateevent = $row["bap_baptismDateTime"];	  
		$timestamp = strtotime($dateevent);
		$year = date("Y", $timestamp);          
        $month = date("M", $timestamp); 
        $day = date("jS", $timestamp); 
		///today
		$todayyear = date("y");
		$todaymonth = date("M");
		$today = date("jS");
		
		$bap_fullname = $row["bap_fullname"];	
		$midlename = $row["midlename"];		
		$lastname = $row["lastname"];	
		$bap_municipality = $row["bap_municipality"];	
		$bap_province = $row["bap_province"];	
		$bap_location = $row["bap_location"];	
		$bap_date_of_birth = date("F j, Y", strtotime($row["bap_date_of_birth"]));
		$bap_placeOB = $row["bap_placeOB"];	
		$bap_filiation = $row["bap_filiation"];	
		$bap_nationality = $row["bap_nationality"];	
		$fatherFirstName = $row["fatherFirstName"];	
		$fatherMiddleName = $row["fatherMiddleName"];	
		$fatherLastName = $row["fatherLastName"];	
		$bap_father_place_birth = $row["bap_father_place_birth"];	
		$motherFirstName = $row["motherFirstName"];	
		$motherMiddleName = $row["motherMiddleName"];	
		$motherLastName = $row["motherLastName"];	
		$bap_mother_place_birth = $row["bap_mother_place_birth"];
		if($row["bap_recidence"] == ''){
		$bap_recidence = $row["residence_father"];	
		}else{			
		$bap_recidence = $row["bap_recidence"];	
		}	
		$bap_paternal_gp = $row["bap_paternal_gp"];	
		$bap_maternal_gp = $row["bap_maternal_gp"];	
		$bap_sponsors = $row["bap_sponsors"];	
		$sponsors2 = $row["sponsors2"];	
		$sponsors3 = $row["sponsors3"];	
		$sponsors4 = $row["sponsors4"];	
		$sponsors5 = $row["sponsors5"];	
		$sponsors6 = $row["sponsors6"];	
		$sponsors7 = $row["sponsors7"];	
		$sponsors8 = $row["sponsors8"];	
		$bap_civil_status = $row["bap_civil_status"];	
		$bap_recidence2 = $row["bap_recidence2"];	
		$bap_oficiating_priest = $row["bap_oficiating_priest"];	
		}
	}catch(PDOException $e){
	echo $e->getMessage();
  }

// Create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Background Image PDF');
$pdf->SetSubject('Background Image with Text');
$pdf->SetKeywords('TCPDF, background image, text');

// Set default header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set margins
$pdf->SetMargins(0, 0, 0);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// Remove default header/footer
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

// Add a page
$pdf->AddPage();

// Set background image
$pdf->Image('trial.jpg', 5, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

// Set font
$pdf->SetFont('helvetica', '', 14);

///Name of Church
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(31);
$pdf->SetX(80);
$pdf->MultiCell(0, 10, 'Mission of St. Mary The Virgin', 0, 'L');
///Church Address
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(42);
$pdf->SetX(80);
$pdf->MultiCell(0, 10, 'Natividad Guagua, Pampanga', 0, 'L');
///Name of Child
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetY(87);
$pdf->SetX(85);
$pdf->MultiCell(0, 10, $bap_fullname . ' ' . $midlename . ' ' . $lastname, 0, 'L');

$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(109);
$pdf->SetX(85);
$pdf->MultiCell(0, 10, $day, 0, 'C');

$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(115);
$pdf->SetX(60);
$pdf->MultiCell(0, 10, $month, 0, 'L');

$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(115);
$pdf->SetX(35);
$pdf->MultiCell(0, 10, $year, 0, 'C');
///Date of Birth of Child
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(125);
$pdf->SetX(55);
$pdf->MultiCell(0, 10, $bap_date_of_birth, 0, 'L');
///Place of Birth
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(132);
$pdf->SetX(55);
$pdf->MultiCell(0, 10, $bap_placeOB, 0, 'L');
///Fathers Name
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(139);
$pdf->SetX(55);
$pdf->MultiCell(0, 10, $fatherFirstName. ' ' . $fatherMiddleName . ' ' . $fatherLastName, 0, 'L');
///Mothers Name
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(146);
$pdf->SetX(55);
$pdf->MultiCell(0, 10, $motherFirstName. ' ' . $motherMiddleName . ' ' . $motherLastName, 0, 'L');
///Address
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(153);
$pdf->SetX(55);
$pdf->MultiCell(0, 10, $bap_recidence, 0, 'L');
///Sponsor 1 Row1
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(166);
$pdf->SetX(60);
$pdf->MultiCell(0, 10, $bap_sponsors, 0, 'L');
///Sponsor 2 Row2
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(173);
$pdf->SetX(60);
$pdf->MultiCell(0, 10, $sponsors2, 0, 'L');
///Sponsor 3 Row3
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(180);
$pdf->SetX(60);
$pdf->MultiCell(0, 10, $sponsors3, 0, 'L');
///Sponsor 4 Row4
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(187);
$pdf->SetX(60);
$pdf->MultiCell(0, 10, $sponsors4, 0, 'L');
///Sponsor 1 Row1
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(166);
$pdf->SetX(122);
$pdf->MultiCell(0, 10, $sponsors5, 0, 'L');
///Sponsor 2 Row2
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(173);
$pdf->SetX(122);
$pdf->MultiCell(0, 10, $sponsors6, 0, 'L');
///Sponsor 3 Row3
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(180);
$pdf->SetX(122);
$pdf->MultiCell(0, 10, $sponsors7, 0, 'L');
///Sponsor 4 Row4
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(187);
$pdf->SetX(122);
$pdf->MultiCell(0, 10, $sponsors8, 0, 'L');
///Name of father
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(199);
$pdf->SetX(60);
$pdf->MultiCell(0, 10, 'Fr. Rex Angeles N. Lugtu', 0, 'L');

$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(211);
$pdf->SetX(106);
$pdf->MultiCell(0, 10, $today, 0, 'L');

$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(211);
$pdf->SetX(130);
$pdf->MultiCell(0, 10, $todaymonth, 0, 'L');

$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(211);
$pdf->SetX(161);
$pdf->MultiCell(0, 10, $todayyear, 0, 'L');
///Name of father
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(239);
$pdf->SetX(128);
$pdf->MultiCell(0, 10, 'Fr. Rex Angeles N. Lugtu', 0, 'L');
///for father sign
$pdf->SetFont('helvetica', 'i', 9);
$pdf->SetY(230);
$pdf->SetX(132);
$imagePath = 'signature.png';
$pdf->Image($imagePath, 132, 226, 30); 

$pdf->Output('baptismal_certificate.pdf', 'I');


?>