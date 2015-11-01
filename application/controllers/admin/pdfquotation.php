<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PdfQuotation extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		
	}
	
	public function index()
	{
		
		$this->load->library('Pdf');
		
		$hashqid = $_GET['qid'];
		$this->load->model('quotationmodel');
		$data = $this->quotationmodel->fetchQuotationDetails($hashqid);
		
		//$this->load->view('admin/pdfquotation',$data);
		
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		ob_clean();
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
		//$pdf->setLanguageArray($l);

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
		$pdf->Cell(25, 5, ucfirst($data['name']), 0, 1, 'L', 0, '', 0);
		$pdf->SetXY(30, 40);
		$pdf->Cell(25, 5, $data['contact'], 0, 1, 'L', 0, '', 0);
		
		$pdf->SetXY(30, 45);
		//$pdf->Cell(25, 5, $data['address'], 0, 1, 'L', 0, '', 0);
		$pdf->Cell(25, 5,'', 0, 1, 'L', 0, '', 0);
		$pdf->writeHTMLCell($w=80, $h=0, $x=15, $y='',$data['address'], $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
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
		$pdf->SetXY(131, 55);
		$pdf->Cell(25, 5, 'Sales Person :', 0, 1, 'L', 0, '', 0);
		
		$pdf->SetFont('helvetica', '', 10);
		$pdf->SetXY(147, 35);
		$pdf->Cell(25, 5, $data['retailcontact'], 0, 1, 'L', 0, '', 0);
		$pdf->SetXY(143, 40);
		$pdf->Cell(25, 5, $data['maildid'], 0, 1, 'L', 0, '', 0);
		$pdf->SetXY(140, 45);
		$pdf->Cell(25, 5, $data['tin'], 0, 1, 'L', 0, '', 0);
		$pdf->SetXY(140, 50);
		$pdf->Cell(25, 5, $data['cst'], 0, 1, 'L', 0, '', 0);
		$pdf->SetXY(155, 55);
		$pdf->Cell(25, 5, $data['salesperson'], 0, 1, 'L', 0, '', 0);
		
		$invoicedetails = '<table><thead><tr><th  style="font-weight:bold;" width="35%">Quotation Details</th><th></th></tr></thead><tbody>';
		$invoicedetails .= '<tr><td  width="25%">Quotation Number:</td><td>'.$data['qid'].'</td></tr>';
		$invoicedetails .= '<tr><td  width="25%">Quotation Date:</td><td>'. date("m/d/y",$data['quotationdate']).'</td></tr>';
		
		
		$pdf->Ln(20);
		$pdf->writeHTMLCell($w=0, $h=0, $x=15, $y='',$invoicedetails, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
			
		$pdf->Line(15, 100, 195, 100, $style4);
		$pdf->Line(15, 110, 195, 110, $style4);
		$pos = 105;
		$pdf->SetFont('helvetica', '', 10);
		$itemdetails='<table  cellpadding="5" cellspacing="10"><thead><tr style="font-weight:bold;"><th width="15%" style="text-align:center;">Item Code</th><th width="27%" style="text-align:center;">Description of Goods</th><th width="7%">QTY</th><th width="13%" style="text-align:center;">Price</th><th width="9%"  style="text-align:center;">TAX%</th><th width="15%"  style="text-align:center;">DIS%</th><th width="14%" style="text-align:center;">Net</th></tr></thead><tbody>';
		foreach($data['itemdetails'] as $row){ 
			
			$actualprice = ($row['price'] * $row['quantity']);
			$disvalue = (($row['quantity'] * $row['price'] * $row['dis']) / 100);
			
			$taxvalue = ((($actualprice - $disvalue) * $row['taxpercent']) / 100);
			$rowtotal = $actualprice - ($disvalue);
								
			$itemdetails .= '<tr><td width="15%">'.$row['itemcode'].'</td><td  width="27%">'.$row['description'] .'</td><td width="7%">'.$row['quantity'] .'</td><td width="13%"  style="text-align:right;">'.number_format(($row['price']), 2, '.', ',') .'</td><td width="9%" style="text-align:right;">'.number_format(($row['taxpercent']), 2, '.', ',') .'</td><td  width="15%" style="text-align:right;">'.number_format(($row['dis']), 2, '.', ',') .'</td><td width="14%" style="text-align:right;">'.number_format(($rowtotal), 2, '.', ',') .'</td></tr>';
			$pos = $pos + 10;
		}
		$itemdetails .= '</tbody></table>';
		$pos = $pos + 50;
		$pdf->Ln(5);
		$pdf->writeHTMLCell($w=0, $h=0, $x=15, $y='',$itemdetails, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
		$pdf->Ln(2);
		$pdf->Line(15, $pos, 195, $pos, $style4);
		$subdetails = '<table><thead><tr><th  style="font-weight:bold;" width="50%"></th><th></th></tr></thead><tbody>';
		$subdetails .= '<tr><td  width="50%" style="font-weight:bold;">Subtotal  :</td><td  style="text-align:right;">'. number_format(($data['subtotal']), 2, '.', ',').'</td></tr>';
		$subdetails .= '<tr><td  width="50%" style="font-weight:bold;">Tax Total :</td><td  style="text-align:right;">'.number_format(($data['taxtotal']), 2, '.', ',').'</td></tr>';
		$subdetails .= '<tr><td  width="50%" style="font-weight:bold;">Round Off :</td><td  style="text-align:right;">'.number_format(($data['roundoff']), 2, '.', ',').'</td></tr>';
		$subdetails .= '<tr><td  width="50%" style="font-weight:bold;">Net Amount:</td><td style="text-align:right;">'.number_format(($data['netamount']), 2, '.', ',').'</td></tr>';
		$subdetails .= '</tbody></table>';
		//$pdf->Ln(5);
		$pdf->SetXY(140, $pos);
		$pdf->writeHTMLCell($w=52, $h=0, $x=125, $y='',$subdetails, $border=0, $ln=1, $fill=0, $reseth=true, $align='right', $autopadding=true);
		
		$remarksdetails = '<table><thead><tr><th  style="font-weight:bold;" width="50%"></th><th></th></tr></thead><tbody>';
		$remarksdetails .= '<tr><td  width="50%"></td><td  style="text-align:right;"></td></tr>';
		$remarksdetails .= '<tr><td  width="50%"></td><td  style="text-align:right;"></td></tr>';
		$remarksdetails .= '<tr><td  width="95%">Rupees '.ucfirst($this->no_to_words($data['netamount']).' only /-').'</td><td   width="5%"></td></tr>';
		$remarksdetails .= '<tr><td  width="50%"></td><td  style="text-align:right;"></td></tr>';
		$remarksdetails .= '<tr><td  width="50%" style="font-weight:bold;">Term&Condition</td><td style="text-align:right;"></td></tr>';
		$remarksdetails .= '<tr><td  width="90%" style="text-align:Justify;">'.$data['term'].'</td><td width="10%"></td></tr>';
		$remarksdetails .= '<tr><td  width="50%"></td><td></td></tr>';
		$remarksdetails .= '<tr><th  style="font-weight:bold;text-align:right;" width="95%">For CONSOLIDATED PREMIUM RETAILERS</th></tr>';
		$remarksdetails .= '<tr><td  width="50%"></td><td></td></tr>';
		$remarksdetails .= '<tr><td  width="50%"></td><td></td></tr>';
		$remarksdetails .= '<tr><td  width="50%"></td><td></td></tr>';
		$remarksdetails .= '<tr><td  style="text-align:right; width:80%;">Authorised Signatory</td><td></td></tr>';
		$remarksdetails .= '</tbody></table>';
		
		$pdf->SetXY(140, $pos);
		//$pdf->Ln(5);
		$pdf->writeHTMLCell($w=180, $h=0, $x=15, $y='',$remarksdetails, $border=0, $ln=1, $fill=0, $reseth=false, $align='right', $autopadding=true);
		/*
		$footerdetails = '<table><thead><tr><th></th><th  style="font-weight:bold;" width="75%">For CONSOLIDATED PREMIUM RETAILERS</th></tr></thead><tbody>';
		$footerdetails .= '<tr><td  width="50%"></td><td></td></tr>';
		$footerdetails .= '<tr><td  width="50%"></td><td></td></tr>';
		$footerdetails .= '<tr><td  width="50%"></td><td></td></tr>';
		$footerdetails .= '<tr><td  style="text-align:right; width:80%;">Authorised Signatory</td><td></td></tr>';
		$footerdetails .= '<tr><td  style="text-align:center;" width="30%"></td><td></td></tr>';
		$footerdetails .= '<tr><td style="text-align:left;" width="50%"></td><td></td></tr>';
		$footerdetails .= '</tbody></table>';
		
		//$pdf->SetXY(160, 150);
		$pdf->Ln(5);
		//$pdf->writeHTMLCell($w=180, $h=0, $x=15, $y='',$footerdetails, $border=1, $ln=1, $fill=0, $reseth=false, $align='right', $autopadding=true);
		*/
			
		$pdf->Output($data['qid'].'.pdf', 'I');
		
	}

	public function no_to_words($no)
	{   
		$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred ','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
		if($no == 0)
			return ' ';
		else {
			$novalue='';
			$highno=$no;
			$remainno=0;
			$value=100;
			$value1=1000;       
			while($no>=100)    {
				if(($value <= $no) &&($no  < $value1))    
				{
					$novalue=$words["$value"];
					$highno = (int)($no/$value);
					$remainno = $no % $value;
					break;
				}
				$value= $value1;
				$value1 = $value * 100;
			}       
			if(array_key_exists("$highno",$words))
				return $words["$highno"]." ".$novalue." ".$this->no_to_words($remainno);
			else {
				$unit=$highno%10;
				$ten =(int)($highno/10)*10;            
				return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".$this->no_to_words($remainno);
			}
		}
	}
	
}

/* End of file homepage.php */
/* Location: ./application/controllers/admin/homepage.php */