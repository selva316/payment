<?php
	//print_r($_POST);
	include('header.php');
	include('GenericTable.php');
	include('Quotation.php');
	if(isset($_POST))
	{
		$hashquotationid = $_POST['hashqid'];
		$name = $_POST['name'];
		$contactno = $_POST['contactno'];
		$address = $_POST['address'];
		$retail_contact = $_POST['retail_contact'];
		$mailid = $_POST['mailid'];
		$tin = $_POST['tin'];
		$cst = $_POST['cst'];
		$salesperson = $_POST['salesperson'];
		$term = $_POST['term'];
		$refnumber = $_POST['refnumber'];
		$quotationdate = $_POST['quotationdate'];
		$subtotal = $_POST['sub_total'];
		$taxtotal = $_POST['taxtotal'];
		$roundoff = $_POST['round_off'];
		$netamount = $_POST['netamount'];
			
		$itemcode = $_POST['itemCode'];
		$description = $_POST['itemName'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		$tax_percent = $_POST['taxP'];
		$tax = $_POST['tax'];
		//print 'count:'.count($_POST['itemName']);
		
		$otablepayment = new GenericTable($dbh,'py_quotation');
				
		$time = time();

		$list = Array(
			'NAME'=>$name,
			'CONTACT'=>$contactno,
			'ADDRESS'=>$address,
			'RETAILCONTACT'=>$retail_contact,
			'MAILDID'=>$mailid,
			'TIN'=>$tin,
			'CST'=>$cst,
			'SALESPERSON'=>$salesperson,
			'TERM'=>$term,
			'REFNUMBER'=>$refnumber,
			'QUOTATIONDATE'=>strtotime($quotationdate),
			'STATUS'=>'Pending',
			'TIMESTAMP'=>$time,
			'SUBTOTAL'=>$subtotal,
			'TAXTOTAL'=>$taxtotal,
			'ROUNDOFF'=>$roundoff,
			'NETAMOUNT'=>$netamount
		);
		
		$otablepayment->updateRow($list,"where HASHQID='$hashquotationid'");
		
		$oquotation = new Quotation($dbh,$hashquotationid);
		$qid =  $oquotation->qid;
		
		$otableauditpayment = new GenericTable($dbh,'py_audit_items');
		foreach($oquotation->itembreakup as $itemval){
			$listitem = array(
				'ITEMCODE'=>$itemval['ITEMCODE'],
				'DESCRIPTION'=>$itemval['DESCRIPTION'],
				'QUANTITY'=>$itemval['QUANTITY'],
				'PRICE'=>$itemval['PRICE'],
				'taxpercent'=>$itemval['taxpercent'],
				'qid'=>$itemval['qid'],
				'timestamp'=>time()
			);
			$id=$otableauditpayment->insertRow($listitem);
		}
		
		$dbh->exec("delete from py_items where qid='$qid'");
		
		$number_of_entries = count($_POST['itemName']);

		for($i=0; $i<=$number_of_entries; $i++) {
			$itemcode = $_POST['itemCode'];
			$description = $_POST['itemName'];
			$quantity = $_POST['quantity'];
			$price = $_POST['price'];
			$tax_percent = $_POST['taxP'];
			$tax = $_POST['tax'];
			
			if($quantity[$i] == "" || $quantity[$i] == 0)
				continue;
			$listitem = array(
				'ITEMCODE'=>$itemcode[$i],
				'DESCRIPTION'=>$description[$i],
				'QUANTITY'=>$quantity[$i],
				'PRICE'=>$price[$i],
				'taxpercent'=>$tax_percent[$i],
				'qid'=>$qid
			);
			
			$otablepaymentitems = new GenericTable($dbh,'py_items');
			$otablepaymentitems->insertRow($listitem);
		}
		echo "<script>window.location.href=\"homepage.php\"</script>";
	}
?>