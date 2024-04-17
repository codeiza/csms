<?php
require('TCPDF/tcpdf.php');
require_once 'connection.php';
try{
	$pdo = new PDO( DSN, DB_USR, DB_PWD );
	$pdo->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare(
		"SELECT * FROM request_form
		Where id = '".$_REQUEST["id"]."'
		AND
		Event_type = 'Wedding'
		"
		);
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$dateevent = $row["start_datetime_event"];	  
		$timestamp = strtotime($dateevent);
		$formattedDate = date("j M Y", $timestamp);
		$formattedTime = date("g:i A", $timestamp);
		$year = date("Y", $timestamp);

		$wedding_province = $row["wedding_province"];	 	
		$wedding_municipality = $row["wedding_municipality"];	 	
		$wedding_husband_name = $row["wedding_husband_name"];	 	
		$wedding_wife_name = $row["wedding_wife_name"];	 	
		$wedding_husband_dob = $row["wedding_husband_dob"];	 	
		$wedding_wife_dob = $row["wedding_wife_dob"];
		$birthdate2 = DateTime::createFromFormat('Y-M-d', $wedding_husband_dob); ///database format 29-May-2023
		$birthdate = DateTime::createFromFormat('Y-M-d', $wedding_wife_dob);  ///database format 2018-June-20
		$currentDate = new DateTime();
		//$agew = $birthdate->diff($currentDate)->y;
		//$ageh = $birthdate2->diff($currentDate)->y;
		$agew = '25';
		$ageh = '30';
	 	
		$wedding_husband_pob = $row["wedding_husband_pob"];	 	
		$wedding_wife_pob = $row["wedding_wife_pob"];	 	
		$wedding_husband_citizenship = $row["wedding_husband_citizenship"];	 	
		$wedding_wife_citizenship = $row["wedding_wife_citizenship"];	 	
		$wedding_husband_sex = $row["wedding_husband_sex"];	 	
		$wedding_wife_sex = $row["wedding_wife_sex"];	 	
		$wedding_husband_residence = $row["wedding_husband_residence"];	 	
		$wedding_wife_residence = $row["wedding_wife_residence"];	 	
		$wedding_husband_religion = $row["wedding_husband_religion"];	 	
		$wedding_wife_religion = $row["wedding_wife_religion"];	 	
		$wedding_husband_civistatus = $row["wedding_husband_civistatus"];	 	
		$wedding_wife_civistatus = $row["wedding_wife_civistatus"];	 	
		$wedding_husband_name_father = $row["wedding_husband_name_father"];	 	
		$wedding_wife_name_father = $row["wedding_wife_name_father"];	 	
		$wedding_husband_citizenship_parent = $row["wedding_husband_citizenship_parent"];	 	
		$wedding_wife_citizenship_parent = $row["wedding_wife_citizenship_parent"];	 	
		$wedding_husband_name_mother = $row["wedding_husband_name_mother"];	 	
		$wedding_wife_name_mother = $row["wedding_wife_name_mother"];	 	
		$wedding_wife_citizenship_parents = $row["wedding_wife_citizenship_parents"];	 	
		$wedding_husband_citizenship_parents = $row["wedding_husband_citizenship_parents"];	 	
		$peroson_gave_consent = $row["peroson_gave_consent"];	 	
		$peroson_gave_consent_wife = $row["peroson_gave_consent_wife"];	 	
		$residence_wife_side = $row["residence_wife_side"];	 	
		$residence_husband_side = $row["residence_husband_side"];	 	
		$place_of_merriage = $row["place_of_merriage"];	 	
		$datetime_merriage = $row["datetime_merriage"];	 	
		$others_contact_no = $row["others_contact_no"];	 	
		$others_email = $row["others_email"];
		$others_reserve_by = $row["others_reserve_by"];
		$others_sched_type = $row["others_sched_type"];
		$start_datetime_event = $row["others_sched_type"];
		$concent_relation_wife = $row["concent_relation_wife"];
		$concent_relation_hus = $row["concent_relation_hus"];
      
		}
	}catch(PDOException $e){
	echo $e->getMessage();
  }

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Wedding Certificate');
$pdf->SetSubject('Wedding Certificate');
$pdf->SetKeywords('Wedding, Certificate');

$pdf->AddPage('P', array(8.5 * 25.4, 14 * 25.4));

$html = '
<table  style="border-collapse: collapse; border: 2px solid black;">
<thead>
	<tr>
	<th style="padding: 5px; font-size:6px;" colspan="2">Municipal form No.97(form No.13)<br>(Revise January 1993)</th>
	<th style="padding: 5px; font-size:6px;">(To be accomplishedin quadruplicate)</th>
	<th style="border: 1px solid black; padding: 5px; font-size:10px;" rowspan="6">REMARKS/ANNOTATION</th>
	</tr>
	<tr>
	<th style="font-size:8px; text-align:center" colspan="3">Republic of the philippines</th>
	</tr>
	
	<tr>
	<th style="font-size:9px; text-align:center" colspan="3">OFFICE OF THE CIVIL REGISTRAR GENERAL</th>
	</tr>
	
	<tr>
	<th style="font-size:12px; text-align:center" colspan="3">CERTIFICATE OF MARRIAGE</th>
	</tr>
	<tr>
	<th style="border: 1px solid black; padding: 5px; font-size:10px;">Province</th>
	<th style="border: 1px solid black; padding: 5px; font-size:10px;" colspan="1">'.$wedding_province.'</th>
	<th style="border: 1px solid black; padding: 5px; font-size:10px;" rowspan="2">Registry No</th>
	</tr>
	<tr>
	<th style="border: 1px solid black; padding: 5px; font-size:10px;">City/Municipality</th>
	<th style="border: 1px solid black; padding: 5px; font-size:10px;" colspan="1">'.$wedding_municipality.'</th>
	</tr>
</thead>
<tbody>
   <tr>
     <td style="border: 1px solid black; padding: 5px; font-size:10px;" rowspan="3">Name of Contracting Parties</td>
     <td style="border: 1px solid black; padding: 5px; font-size:10px;">(HUSBAND)</td>
     <td style="border: 1px solid black; padding: 5px; font-size:10px;">(WIFE)</td>
     <td style="border: 1px solid black; padding: 5px; font-size:10px;" rowspan="8">FOR OCRG USE ONLY: <br>Polution Reference No. 
	 <br> (HUSBAND)<br>
	 <img src="textbox.jpg" height="20" width="70" />
	 <br> (WIFE)<br>
	 <img src="textbox.jpg" height="20" width="70" />
	 </td>
   </tr>
   
   <tr>
     
     <td style="padding: 5px; font-size:7px;">(first)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(midle initial)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(last)</td>
     <td style="border-left: 1px solid black; padding: 5px; font-size:7px;">(first)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(midle initial)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(last)</td>
     
   </tr>
   
   <tr>
     <td style="padding: 5px; font-size:10px;">'.$wedding_husband_name.'</td>
     <td style="border-left: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_name.'</td>
   </tr>
   
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;" rowspan="2">Date of Birth / Age</td>
    <td style="border-left: 1px solid black; border-top: 1px solid black; padding: 5px; font-size:7px;">(day)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>(month)<span>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(year)<span>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(age)</td>
     <td style="border-left: 1px solid black; border-top: 1px solid black; padding: 5px; font-size:7px;">(day)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span>(month)<span>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(year)<span>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(age)</td>
   </tr>
   
    <tr>
    <td style=" padding: 5px; font-size:10px;">'.$wedding_husband_dob.'-'.$ageh.'</td>
    <td style="border-left: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_dob.'-'.$agew.'</td>
   </tr>
   
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">Place of Birth</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_husband_pob.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_pob.'</td>
   
   </tr>
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">Sex(Male or Female)</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_husband_sex.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_sex.'</td>
  
   </tr>
    <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">Citizenship</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_husband_citizenship.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_citizenship.'</td>
  
   </tr>
    <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">Residence</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_husband_residence.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_residence.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;" rowspan="6">TO BE FILLED UP AT THE <br> OFFICE OF THE CIVIL REGISTRAR</td>
   </tr>
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">Religion</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_husband_religion.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_religion.'</td>
  
   </tr>
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">Civil Status</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_husband_civistatus.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_civistatus.'</td>
   
   </tr>
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;" rowspan="2">Name of Father</td>
    <td style="padding: 5px; font-size:7px;">(first)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(midle initial)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(last)</td>
    <td style="border-left: 1px solid black; padding: 5px; font-size:7px;">(first)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(midle initial)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(last)</td>
    
   </tr>
   <tr>
    <td style="padding: 5px; font-size:10px;">'.$wedding_husband_name_father.'</td>
    <td style="border-left: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_name_father.'</td>
    
   </tr>
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">Citizenship</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_husband_citizenship_parent.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_citizenship_parent.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">15</td>
   </tr>
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;" rowspan="2">Name of Mother</td>
    <td style="border-top: 1px solid black; padding: 5px; font-size:7px;">(first)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(midle initial)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(last)</td>
    <td style="border-left: 1px solid black; border-top: 1px solid black; padding: 5px; font-size:7px;">(first)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(midle initial)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(last)</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;" rowspan="7">RECEIVED AT THE OFFICE OF CIVIL REGISTRAR</td>
   </tr>
   <tr>
    <td style="padding: 5px; font-size:10px;">'.$wedding_husband_name_mother.'</td>
    <td style="border-left: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_name_mother.'</td>
    
   </tr>
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">Citizenship</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_wife_citizenship_parents.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$wedding_husband_citizenship_parents.'</td>
    
   </tr>
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;" rowspan="2">Person who gave concent</td>
    <td style="border-top: 1px solid black; padding: 5px; font-size:7px;">(first)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(midle initial)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(last)</td>
    <td style="border-left: 1px solid black; border-top: 1px solid black; padding: 5px; font-size:7px;">(first)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(midle initial)<span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;</span>(last)</td>
    
   </tr>
   <tr>
    <td style="padding: 5px; font-size:10px;">'.$peroson_gave_consent.'</td>
    <td style="border-left: 1px solid black; padding: 5px; font-size:10px;">'.$peroson_gave_consent_wife.'</td>
 
   </tr>
   
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">Relationship</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$concent_relation_hus.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$concent_relation_wife.'</td>
   
   </tr>
   <tr>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">Residence</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$residence_husband_side.'</td>
    <td style="border: 1px solid black; padding: 5px; font-size:10px;">'.$residence_wife_side.'</td>
   
   </tr>
 
</tbody>
</table>
<br>
<br>
<br>
<span style="font-size: 10px; text-align: left;">Place of Marriage</span><span style="font-size: 10px; text-align: left; text-decoration: underline;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;IGLESIA FILIPINA INDEPENDIENTE </span><br>
<span style="font-size: 5px;"><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
(Office of the / House of/ Barangay of / Church of / Mosque of)<br>

<span style="font-size: 10px; text-align: left;"><span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></span><span style="font-size: 10px; text-align: left; text-decoration: underline;">Natividad Guagua Pampanga </span><br>
<span style="font-size: 5px;"><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
<span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>(Address)<br>

<span style="font-size: 10px; text-align: left;">Date</span><span style="font-size: 10px; text-align: left; text-decoration: underline;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'.$formattedDate.'</span> <span style="font-size: 10px; text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Time</span><span style="font-size: 10px; text-align: left; text-decoration: underline;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'.$formattedTime.'</span><br>
<span style="font-size: 5px;"><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
(day) (month) (year)<br>

 <span style="font-size: 13px;">THIS IS CERTIFY THAT I</span> <span style="font-size: 10px; text-align: left; text-decoration: underline;"><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>'.$wedding_husband_name.' <span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></span><br>
<span style="font-size: 10px;">and I,</span><span style="font-size: 10px; text-align: left; text-decoration: underline;"><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>'.$wedding_wife_name.' <span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>,</span>
<span style="font-size: 10px;">both of legal age, of our own free will</span><br>
<span style="font-size: 10px;">and accord, and in the presence of the person solemnizing this marriage and of the withnesses named below, take</span><br>
<span style="font-size: 10px;">each other as husband and wife and certifying further that we</span><br><br>
<img src="checkbox.png" height="10"/><span style="font-size: 10px;">&nbsp; &nbsp; have not entered into a marriage settlement</span><br>
<img src="box.png" height="10"/><span style="font-size: 10px;">&nbsp; &nbsp; have entered into a marriage settlement a copy of which is here to attached</span><br>
<span style="font-size: 10px;">IN WITNESS WHERE OF, with signed/marked with our finger print this certificatein quadruplicate his</span><br>
<span style="font-size: 10px; text-align: left; text-decoration: underline;">25th </span> day of <span style="font-size: 10px; text-align: left; text-decoration: underline;">Dec, 1994 </span>
<br>
<br><br>
<span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-size: 10px; text-align: left; text-decoration: underline;">'.$wedding_husband_name.'</span>
<span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-size: 10px; text-align: left; text-decoration: underline;">'.$wedding_wife_name.'</span>

<br>
<span style="font-size: 5px;"><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
(Signature of Husband)
<span style="font-size: 5px;"><span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
(Signature of Wife)
<br>
<br>
<br>
<span style="font-size: 10px;">&nbsp; &nbsp; &nbsp; THIS IS CERTIFYTHAT BEFORE ME, on the date and place above- written, personally appeared<br>
the above mentioned parties, with theirmutual concentlawfully joinedtogether in marriage which was solemnized<br>
by me in the presence of the witnesses named below, all of legal age. </span>
<br>
<br>
<span style="font-size: 10px;">&nbsp; &nbsp; &nbsp; I CERTIFY FURTHER THAT </span>
<br>
&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<img src="checkbox.png" height="10"/><span style="font-size: 10px;">&nbsp; &nbsp; Marriage Lincense No.<span style="font-size: 10px; text-align: left; text-decoration: underline;">0101583 </span>issued on</span>
<span style="font-size: 10px; text-align: left; text-decoration: underline;">Aug 11, 1994  </span><span style="font-size: 10px;">at </span> <span style="font-size: 10px; text-align: left; text-decoration: underline;">San Fedro., Pamp. </span>
<br>
<span style="font-size: 10px;">&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;in favor of said parties, was exhibited to me.</span>
<br>
&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<img src="box.png" height="10"/><span style="font-size: 10px;">&nbsp; &nbsp; no marriage licence was necessary</span><br>
&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<img src="box.png" height="10"/><span style="font-size: 10px;">&nbsp; &nbsp; the marriage was solemnized in accordance with the provision of Presidential Decree No. 1083</span><br>
</span>
<br>
<br>
<br>
<span style="font-size: 10px; text-align:center; text-decoration: underline;">Rev. Fr. Luisito F. Engnan</span><br>
<span style="font-size: 9px; text-align:center;"><sup>(Signature of Solemnazing Officer)</sup></span><br>
<span style="font-size: 10px; text-align:center; text-decoration: underline;">Parish Priest</span><br>
<span style="font-size: 9px; text-align:center;"><sup>(Position/Designation)</sup></span><br>

<span style="font-size: 10px; text-align:center; text-decoration: underline;">I.F.I.  93-3282-95   &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   December 31 1995</span><br>
<span style="font-size: 9px; text-align:center;"><sup>(Relegious Afiliation, Registry No. and Expiration Date Applicable)</sup></span><br>


<p style="font-size: 10px; text-align:center">WITNESSES</p>
<p style="font-size: 8px; text-align:center">Print Name and Sign</p>
<p style="font-size: 10px; text-align:center;"><span style="text-decoration: underline;">Rev. Fr. Luisito F. Engnan</span>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; <span style="text-decoration: underline;">Rev. Fr. Luisito F. Engnan</span></p>
<br>
<br>

<p style="font-size: 10px; text-align:center;"><span style="text-decoration: underline;">Rev. Fr. Luisito F. Engnan</span>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; <span style="text-decoration: underline;">Rev. Fr. Luisito F. Engnan</span></p>

';

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('wedding_certificate.pdf', 'I');


?>