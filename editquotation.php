<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <title>Edit Quotation </title>
	<link rel="icon" type="image/png" href="../images/logo.png"/>
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Noto+Serif:400,700"> 
    <!-- Bootstrap core CSS -->
    <link href="asset/css/jquery-ui.min.css" rel="stylesheet">
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/datepicker.css" rel="stylesheet">
    <link href="asset/css/font-awesome.min.css" rel="stylesheet">
    <link href="asset/css/style.css" rel="stylesheet">

    <script src="asset/js/ie.js"></script>
	

   	
  </head>
  <?php 
	include('menu.php'); 
	include('header.php');
	include('Quotation.php');
  ?>
  <body>
	<?php
		$hashqid = $_GET['qid'];
		$oquotation = new Quotation($dbh, $hashqid);
		//print_r($oquotation);
	?>
	<form name="frminvoice" action="fr_editinvoicedb.php" method="post" onsubmit="return frmvalidation()">
    <div class="panel panel-success">
	<div class="panel-heading">
		<center><label><b>Quotation</b></label></center></div></div>		
		<div class="container-fluid">
		
    <!-- Begin page content -->
    <div class="container content">
    		
      	<div class='row'>
      		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
			<B><u>Customer Details</u></B></br>
				<input type="hidden" id="hashqid" name="hashqid" value="<?php echo $hashqid; ?>"/>
		        <div class="form-group">
					<label>Name: <input type="text" class="form-control" id="name"name="name" placeholder="Name" value="<?php echo $oquotation->name; ?>"></label>
					<label>Contact No: <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact Number" value="<?php echo $oquotation->contact; ?>"></label>
					<br/>
					<label>Address:</label>
					<br/>
					 <textarea  class="form-control" rows="3"  style="width:210px" id="address"name="address" placeholder="Address"><?php echo $oquotation->address; ?></textarea>
				</div>
      			<div class="form-group">
				<b><u>Quotation Details</u></b></br>	
				<label>REF No: <input type="text" class="form-control" id="refnumber"name="refnumber" placeholder="REF Number" value="<?php echo $oquotation->refnumber; ?>"></label>
				<label>Date : <input type="text" class="form-control" id="quotationdate" name="quotationdate" placeholder="Date" value="<?php echo $oquotation->quotationdate; ?>"></label>
				
				</div>
				<div class="form-group">
					
				</div>
				
      		</div>
      		<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
			    <label>Consolidated Premium Retailers</label>
      			<div class="form-group">
					<label>Contact : <input type="text" class="form-control" id="retail_contact" name="retail_contact" placeholder="Contact Number" value="<?php echo $oquotation->retailcontact; ?>"></label>
					<label>E-Mail: <input type="text" class="form-control" id="mailid" name="mailid" placeholder="Mail ID" value="<?php echo $oquotation->mailid; ?>"> </label>
					<label>TIN : <input type="text" class="form-control" id="tin" name="tin" placeholder="TIN" value="<?php echo $oquotation->tin; ?>"> </label>
					<label>CST : <input type="text" class="form-control" id="cst" name="cst" placeholder="CST" value="<?php echo $oquotation->cst; ?>"></label>
				</div>
				
      		</div>
      	</div>
      	<div class='row'>
      		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
      			<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="2%"></th>
							<th width="15%">Item Code</th>
							<th width="25%">Description of Goods</th>
							<th width="10%">QTY</th>
							<th width="10%">Price</th>
							<th width="10%">TAX%</th>
							<th width="10%">TAX</th>
							<th width="20%">TOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1; 
							foreach($oquotation->itembreakup as $row){ 
						?>
						<tr>
							
							<td><input class="case" type="checkbox"/></td>
							<td><input type="text" data-type="itemcode" name="itemCode[]" id="itemCode_<?php echo $i ?>" value="<?php echo $row['ITEMCODE'] ?>" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" data-type="description" name="itemName[]" id="itemName_<?php echo $i ?>" value="<?php echo $row['DESCRIPTION'] ?>" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" name="quantity[]" id="quantity_<?php echo $i ?>" value="<?php echo $row['QUANTITY'] ?>" class="form-control changesNo" autocomplete="off" ondrop="return false;" onpaste="return false;"></td>
							<td><input type="text" name="price[]" id="price_<?php echo $i ?>" readonly value="<?php echo $row['PRICE'] ?>" class="form-control changesNo" autocomplete="off" ondrop="return false;" onpaste="return false;"></td>
							
							<td><input type="text" data-type="productCode" name="taxP[]" id="taxP_<?php echo $i ?>" value="<?php echo $row['taxpercent'] ?>" class="form-control changesNo autocomplete_txt" value="0" autocomplete="off"></td>
							<td><input type="text" data-type="productCode" name="tax[]" value="<?php echo ($row['QUANTITY'] * $row['PRICE'] * $row['taxpercent']) / 100 ?>" readonly id="tax_<?php echo $i ?>" class="form-control totaltaxprice autocomplete_txt" value="0" autocomplete="off"></td>
							<td><input type="number" name="total[]" id="total_<?php echo $i ?>" value="<?php echo ($row['QUANTITY']*$row['PRICE']) ?>" readonly class="form-control totalLinePrice" autocomplete="off" ondrop="return false;" onpaste="return false;"></td>
						</tr>
						<?php 
							$i++;
							} 
						?>
					</tbody>
				</table>
      		</div>
      	</div>
		<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
      			<button class="btn btn-danger delete" type="button">- Delete</button>
      			<button class="btn btn-success addmore" type="button">+ Add More</button>
      		</div>
			
			     		
      	
		
	
  </br><hr>
  <B>Remarks:</B> </br></br>
  <div class='row'>
   
      		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
			
      			<div class="form-group">
					<label>Sales Person : <input type="text" class="form-control" id="salesperson" name="salesperson" placeholder="Sales Person" value="<?php echo $oquotation->salesperson; ?>"></label>
					<div id="rupeeinwords"></div>
				</div>
				<div class="form-group">
					<b>Term & Condition	</b></br>
					<textarea class="form-control" rows='5' id="term" name="term" placeholder="Term & Condition"><?php echo $oquotation->term; ?></textarea>				
				</div>
				
      		</div>
      		<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
			    <div class="form-group">
						<label>Subtotal: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="number" class="form-control" id="subTotal" readonly name="sub_total" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"  style="text-align:right;" value="<?php echo $oquotation->subtotal; ?>">
						</div>
					</div>
					<div class="form-group">
						<label>Tax Total: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="number" class="form-control" id="taxtotal" readonly  name="taxtotal" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"   style="text-align:right;" value="<?php echo $oquotation->taxtotal; ?>">
						</div>
					</div>
					<div class="form-group">
						<label>Round Off : &nbsp;</label>
						
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="number" class="form-control" id="round_off" readonly  name="round_off" placeholder="Round Off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"  style="text-align:right;" value="<?php echo $oquotation->roundoff; ?>">
						</div>
					</div>
					<div class="form-group">
						<label>Net Amount: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="number" class="form-control" id="netamount" readonly name="netamount" placeholder="Net Amount" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"  style="text-align:right;" value="<?php echo $oquotation->netamount; ?>">
						</div>
					</div>
					
				<div class="form-group">
				  
				</div>
				<div class="form-group">
					
				</div>
      		</div>
      	</div>
		
		<div class='row'>
   
      		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
			
      			<div class="form-group">
				
				
				</div>
				<div class="form-group">
				
				
				</div>
				<!--<div class="form-group">
				 Customer Signature</br>
				 (Goods Received in good condition)
				
				</div>-->
				
				
      		</div>
      		<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
			    <label>For Consolidated Premium Retailers</label>
      			<div class="form-group">
				  
				</div>
				
				<div class="form-group" style="margin-top:75px">
					Authorised Signature
				</div>
				
      		</div>
			<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
				<div class="form-group">
					<input  class="btn btn-default btn-block" type="submit" value="Save" />
				</div>
			</div>
      	</div>
      	
  
  
</div>
</div>
</form>
    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/jquery-ui.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
    <script src="asset/js/bootstrap-datepicker.js"></script>
    <script src="asset/js/auto.js"></script>
	
  </body>
</html>