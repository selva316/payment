<?php
	include('header.php');
	include('asset/tcpdf/config/lang/eng.php');
	include('asset/tcpdf/tcpdf.php');
	include('Quotation.php');
	include('word.php');
	$hashqid = $_GET['qid'];
	$oquotation = new Quotation($dbh, $hashqid);
		
	// Extend the TCPDF class to create custom Header and Footer
	class MYPDF extends TCPDF {

		// Page footer
		public function Footer() {
		
			// Position at 15 mm from bottom
			$this->SetY(-12);
			// Set font
			$this->SetFont('helvetica', '', 8);
			// Page number
								
			$this->SetLineStyle(array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

			$this->Cell(185, 0, '', 'T', 0, 'C');
			//$this->Cell(0, 10, '', 'T', 0, 'C');
			
			$this->Ln();
			//$this->Cell(15, 2, "Patient ID: ", 0, false, 'L', 0, '', 0, false, 'T', 'M');
			//$pdf->SetXY(15, 28);
			$this->Cell(0, 2, '', 0, false, 'C', 0, '', 0, false, 'T', 'M');
			$this->Cell(12, 2, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
		}
	}
	
	// create new PDF document
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	//set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	//set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	// set document information
	$pdf->SetCreator('Gizmoland');

	$pdf->SetTitle("Quotation");
	
	// set default header data
	//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
	
	//$pdf->setFooterData($tc=array(0,64,0), $lc=array(0,64,128));
	
	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	//set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	//set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	//set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	//set some language-dependent strings
	$pdf->setLanguageArray($l);

	// ---------------------------------------------------------

	// set default font subsetting mode
	$pdf->setFontSubsetting(true);

	// Set font
	// dejavusans is a UTF-8 Unicode font, if you only need to
	// print standard ASCII chars, you can use core fonts like
	// helvetica or helvetica to reduce file size.
	$pdf->SetFont('helvetica', '', 14, '', true);

	// Add a page
	// This method has several options, check the source code documentation for more information.
	$pdf->AddPage();
	
	$pdf->SetXY(15, 8);
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->SetTextColor(0, 0, 0, 100);
	$pdf->Cell(0, 0,'Quotation', 0, 1, 'C', 0, '', 0);
	$pdf->SetXY(5, 5);
	
			$pdf->SetXY(0, 28);
			
			$pdf->SetFont('helvetica', 'B', 12);
			
			$pdf->Cell(65, 5,'Customer Details', 0, 1, 'C', 0, '', 0);
			$pdf->SetXY(0, 28);
			$pdf->Cell(325, 5,'Consolidated Premium Retailers', 0, 1, 'C', 0, '', 0);
			$pdf->Ln(2);
			
			$pdf->SetFont('helvetica', '', 10);
			$pdf->SetTextColor(0, 0, 0, 100);
			$pdf->SetXY(15, 35);
			//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
			$pdf->Cell(25, 5, 'Customer Name :', 0, 1, 'L', 0, '', 0);
			$pdf->Cell(25, 5, 'Contact :', 0, 1, 'L', 0, '', 0);
			$pdf->Cell(25, 5, 'Address :', 0, 1, 'L', 0, '', 0);
			
			$pdf->SetFont('helvetica', 'B', 10);
			$pdf->SetXY(45, 35);
			$pdf->Cell(25, 5, ucfirst($oquotation->name), 0, 1, 'L', 0, '', 0);
			$pdf->SetXY(30, 40);
			$pdf->Cell(25, 5, $oquotation->contact, 0, 1, 'L', 0, '', 0);
			
			$pdf->SetXY(30, 45);
			$pdf->Cell(25, 5, $oquotation->address, 0, 1, 'L', 0, '', 0);
			//$pdf->SetXY(40, 50);
			
			
$style4 = array('L' => 0,
                'T' => array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => '20,10', 'phase' => 10, 'color' => array(100, 100, 255)),
                'R' => array('width' => 0.50, 'cap' => 'round', 'join' => 'miter', 'dash' => 0, 'color' => array(50, 50, 127)),
                'B' => array('width' => 0.75, 'cap' => 'square', 'join' => 'miter', 'dash' => '30,10,5,10'));

			//$style = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

			//$pdf->Line(5, 10, 80, 30, $style);			

			$pdf->SetFont('helvetica', '', 10);
			$pdf->SetXY(131, 35);
			$pdf->Cell(25, 5, 'Contact :', 0, 1, 'L', 0, '', 0);
			$pdf->SetXY(131, 40);
			$pdf->Cell(25, 5, 'Email :', 0, 1, 'L', 0, '', 0);
			$pdf->SetXY(131, 45);
			$pdf->Cell(25, 5, 'TIN :', 0, 1, 'L', 0, '', 0);
			$pdf->SetXY(131, 50);
			$pdf->Cell(25, 5, 'CST :', 0, 1, 'L', 0, '', 0);
			
			$pdf->SetFont('helvetica', '', 10);
			$pdf->SetXY(147, 35);
			$pdf->Cell(25, 5, $oquotation->retailcontact, 0, 1, 'L', 0, '', 0);
			$pdf->SetXY(143, 40);
			$pdf->Cell(25, 5, $oquotation->mailid, 0, 1, 'L', 0, '', 0);
			$pdf->SetXY(140, 45);
			$pdf->Cell(25, 5, $oquotation->tin, 0, 1, 'L', 0, '', 0);
			$pdf->SetXY(140, 50);
			$pdf->Cell(25, 5, $oquotation->cst, 0, 1, 'L', 0, '', 0);
			
			$invoicedetails = '<table><thead><tr><th  style="font-weight:bold;" width="15%">Invoice Details</th><th></th></tr></thead><tbody>';
			$invoicedetails .= '<tr><td  width="15%">Invoice Number:</td><td>'.$oquotation->qid.'</td></tr>';
			$invoicedetails .= '<tr><td  width="15%">Invoice Date:</td><td>'.$oquotation->quotationdate.'</td></tr>';
			$invoicedetails .= '<tr><td  width="15%">Other Ref:</td><td>'.$oquotation->refnumber.'</td></tr>';
			
			$pdf->Ln(15);
			$pdf->writeHTMLCell($w=0, $h=0, $x=15, $y='',$invoicedetails, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
			
	$pdf->Line(15, 95, 195, 95, $style4);
	$pdf->Line(15, 105, 195, 105, $style4);
	$pos = 105;
	$pdf->SetFont('helvetica', '', 10);
	$itemdetails='<table  cellpadding="5" cellspacing="10"><thead><tr style="font-weight:bold;"><th width="15%">Item Code</th><th width="27%">Description of Goods</th><th width="7%">QTY</th><th width="10%">Price</th><th width="9%">TAX%</th><th width="10%">TAX</th><th width="14%">Net</th></tr></thead><tbody>';
	foreach($oquotation->itembreakup as $row){ 
		$itemdetails .= '<tr><td width="15%">'.$row['ITEMCODE'].'</td><td  width="27%">'.$row['DESCRIPTION'] .'</td><td width="7%">'.$row['QUANTITY'] .'</td><td width="10%">'.$row['PRICE'] .'</td><td width="9%" style="text-align:right;">'.$row['taxpercent'] .'</td><td  width="10%" style="text-align:right;">'.($row['QUANTITY'] * $row['PRICE'] * $row['taxpercent']) / 100 .'</td><td width="14%" style="text-align:right;">'.number_format(($row['QUANTITY']*$row['PRICE']), 2, '.', ',') .'</td></tr>';
		$pos = $pos + 10;
	}
	$itemdetails .= '</tbody></table>';
	$pdf->Ln(5);
	$pdf->writeHTMLCell($w=0, $h=0, $x=15, $y='',$itemdetails, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
	$pdf->Ln(2);
	$pdf->Line(15, $pos, 195, $pos, $style4);
	$subdetails = '<table><thead><tr><th  style="font-weight:bold;" width="50%"></th><th></th></tr></thead><tbody>';
	$subdetails .= '<tr><td  width="50%" style="font-weight:bold;">Subtotal  :</td><td  style="text-align:right;">'. number_format(($oquotation->subtotal), 2, '.', ',').'</td></tr>';
	$subdetails .= '<tr><td  width="50%" style="font-weight:bold;">Tax Total :</td><td  style="text-align:right;">'.number_format(($oquotation->taxtotal), 2, '.', ',').'</td></tr>';
	$subdetails .= '<tr><td  width="50%" style="font-weight:bold;">Round Off :</td><td  style="text-align:right;">'.number_format(($oquotation->roundoff), 2, '.', ',').'</td></tr>';
	$subdetails .= '<tr><td  width="50%" style="font-weight:bold;">Net Amount:</td><td style="text-align:right;">'.number_format(($oquotation->netamount), 2, '.', ',').'</td></tr>';
	$subdetails .= '</tbody></table>';
	//$pdf->Ln(5);
	$pdf->SetXY(140, $pos+10);
	$pdf->writeHTMLCell($w=52, $h=0, $x=125, $y='',$subdetails, $border=0, $ln=1, $fill=0, $reseth=true, $align='right', $autopadding=true);
	
	$remarksdetails = '<table><thead><tr><th  style="font-weight:bold;" width="50%">Remarks :</th><th></th></tr></thead><tbody>';
	$remarksdetails .= '<tr><td  width="50%">Sales Employee:'. $oquotation->salesperson.'</td><td  style="text-align:right;"></td></tr>';
	$remarksdetails .= '<tr><td  width="50%"></td><td  style="text-align:right;"></td></tr>';
	$remarksdetails .= '<tr><td  width="95%">'.ucfirst(no_to_words($oquotation->netamount)." Only").'</td><td   width="5%"></td></tr>';
	$remarksdetails .= '<tr><td  width="50%"></td><td  style="text-align:right;"></td></tr>';
	$remarksdetails .= '<tr><td  width="50%" style="font-weight:bold;">Term&Condition</td><td style="text-align:right;"></td></tr>';
	$remarksdetails .= '<tr><td  width="90%" style="text-align:Justify;">'.$oquotation->term.'</td><td width="10%"></td></tr>';
	$remarksdetails .= '</tbody></table>';
	
	$pdf->SetXY(140, $pos+10);
	//$pdf->Ln(5);
	$pdf->writeHTMLCell($w=180, $h=0, $x=15, $y='',$remarksdetails, $border=0, $ln=1, $fill=0, $reseth=false, $align='right', $autopadding=true);
	
	$footerdetails = '<table><thead><tr><th></th><th  style="font-weight:bold;" width="75%">For CONSOLIDATED PREMIUM RETAILERS</th></tr></thead><tbody>';
	$footerdetails .= '<tr><td  width="50%"></td><td></td></tr>';
	$footerdetails .= '<tr><td  width="50%"></td><td></td></tr>';
	$footerdetails .= '<tr><td  width="50%"></td><td></td></tr>';
	$footerdetails .= '<tr><td  style="text-align:right; width:80%;">Authorised Signatory</td><td></td></tr>';
	$footerdetails .= '<tr><td  style="text-align:center;" width="30%">Customer Signature</td><td></td></tr>';
	$footerdetails .= '<tr><td style="text-align:left;" width="50%">(Goods Received in Good Condition)</td><td></td></tr>';
	$footerdetails .= '</tbody></table>';
	
	//$pdf->SetXY(160, 150);
	$pdf->Ln(5);
	$pdf->writeHTMLCell($w=180, $h=0, $x=15, $y='',$footerdetails, $border=0, $ln=1, $fill=0, $reseth=false, $align='right', $autopadding=true);
	
	
	$pdf->Output('selva.pdf', 'I');
?>