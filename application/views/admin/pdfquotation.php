<?php
	if($this->session->userdata('roleid')!=1){
		// echo site_url('login');
		print "<script>window.location.href='".site_url('login')."';</script>";
	}
	
	include(base_url().'asset/tcpdf/config/lang/eng.php');
	include(base_url().'asset/tcpdf/tcpdf.php');
	
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
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Quotation</title>
    <!-- jQuery UI CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/jquery/css/jquery-ui.min.css" />
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.min.css" />
	<!-- Bootstrap Responsive CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/jquery/css/datepicker.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/css/jquery.dataTables.css" />
	
	<!-- MetisMenu CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/metisMenu/dist/metisMenu.min.css" />
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/menu/css/menu.css" />
	
    <!-- Timeline CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>dist/css/timeline.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/css/sb-admin-2.css" />
	<!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" />
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	
	<style>
		
		.navbar{
			border:none;
		}
		
		.nav {
			font-size:14px;
			padding-left:40%;
		}
	</style>
</head>

<body>
	<form name="frminvoice" action="createquotation/dataedit" method="post" onsubmit="return frmvalidation()">
    <div id="wrapper">
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<ul class="nav">
				<li  class="test">
					<a href="<?php echo site_url('admin/homepage');?>">Home</a>
				</li>
			</ul>
		</nav>
		<div class="panel panel-success">
	<div class="panel-heading">
		<center><label><b>Quotation</b></label></center></div></div>		
		<div class="container-fluid">
		
    <!-- Begin page content -->
    <div class="container content">
    		
      	<div class='row'>
      		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
			<B><u>Customer Details</u></B></br>
		  
		        <div class="form-group">
					<input type="hidden" id="hashqid" name="hashqid" value="<?php echo $hashqid; ?>" />
					<input type="hidden" id="qid" name="qid" value="<?php echo $qid; ?>" />
					<label>Name: <input type="text" class="form-control" id="name"name="name" placeholder="Name" value="<?php echo $name;?>"></label>
					<label>Contact No: <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact Number"  value="<?php echo $contact;?>"></label>
					<br/>
					<label>Address:</label>
					<br/>
					 <textarea  class="form-control" rows="3"  style="width:210px" id="address"name="address" placeholder="Address" > <?php echo $address;?></textarea>
				</div>
      			<div class="form-group">
				<b><u>Quotation Details</u></b></br>	
				<label>REF No: <input type="text" class="form-control" id="refnumber"name="refnumber" placeholder="REF Number"  value="<?php echo $refnumber;?>"></label>
				<label>Date : <input type="text" class="form-control" id="quotationdate" name="quotationdate" placeholder="Date"  value="<?php echo $quotationdate;?>"></label>
				
				</div>
				<div class="form-group">
					
				</div>
				
      		</div>
      		<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
			    <label>Consolidated Premium Retailers</label>
      			<div class="form-group">
					<label>Contact : <input type="text" class="form-control" id="retail_contact" name="retail_contact" placeholder="Contact Number"  value="<?php echo $retailcontact;?>"></label>
					<label>E-Mail: <input type="text" class="form-control" id="mailid" name="mailid" placeholder="Mail ID"  value="<?php echo $maildid;?>"> </label>
					<label>TIN : <input type="text" class="form-control" id="tin" name="tin" placeholder="TIN"  value="<?php echo $tin;?>"> </label>
					<label>CST : <input type="text" class="form-control" id="cst" name="cst" placeholder="CST"  value="<?php echo $cst;?>"></label>
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
						<?php $i=1;
						foreach($itemdetails as $row)
						{
						?>
						<tr>
							<td><input class="case" type="checkbox"/></td>
							<td><input type="text" data-type="itemcode" name="itemCode[]" id="itemCode_<?php echo $i ?>" value="<?php echo $row['itemcode'];?>" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" data-type="description" name="itemName[]" id="itemName_<?php echo $i ?>" value="<?php echo $row['description'];?>" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" name="quantity[]" id="quantity_<?php echo $i ?>" value="<?php echo $row['quantity'];?>" class="form-control changesNo" autocomplete="off" ondrop="return false;" onpaste="return false;"></td>
							<td><input type="text" name="price[]" id="price_<?php echo $i ?>" value="<?php echo $row['price'];?>" readonly class="form-control changesNo" autocomplete="off" ondrop="return false;" onpaste="return false;"></td>
							
							<td><input type="text" name="taxP[]" id="taxP_<?php echo $i ?>" value="<?php echo $row['taxpercent'];?>" class="form-control changesNo autocomplete_txt" value="0" autocomplete="off"></td>
							<td><input type="text" name="tax[]" readonly id="tax_<?php echo $i ?>" value="<?php echo ($row['quantity'] * $row['price'] * $row['taxpercent']) / 100; ?>" class="form-control totaltaxprice autocomplete_txt" value="0" autocomplete="off"></td>
							<td><input type="number" name="total[]" id="total_<?php echo $i ?>" value="<?php echo (($row['quantity'] * $row['price'] * $row['taxpercent']) / 100) + ($row['quantity']*$row['price']); ?>" readonly class="form-control totalLinePrice" autocomplete="off" ondrop="return false;" onpaste="return false;"></td>
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
					<label>Sales Person : <input type="text" class="form-control" id="salesperson" name="salesperson" placeholder="Sales Person"  value="<?php echo $salesperson;?>"></label>
					<div id="rupeeinwords"></div>
				</div>
				<div class="form-group">
					<b>Term & Condition	</b></br>
					<textarea class="form-control" rows='5' id="term" name="term" placeholder="Term & Condition"> <?php echo $term;?></textarea>				
				</div>
				
      		</div>
      		<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
			    <div class="form-group">
						<label>Subtotal: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="number" class="form-control" id="subTotal" readonly name="sub_total" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"  style="text-align:right;"  value="<?php echo $subtotal;?>">
						</div>
					</div>
					<div class="form-group">
						<label>Tax Total: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="number" class="form-control" id="taxtotal" readonly  name="taxtotal" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"   style="text-align:right;"  value="<?php echo $taxtotal;?>">
						</div>
					</div>
					<div class="form-group">
						<label>Round Off : &nbsp;</label>
						
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="number" class="form-control" id="round_off" readonly  name="round_off" placeholder="Round Off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"  style="text-align:right;"  value="<?php echo $roundoff;?>">
						</div>
					</div>
					<div class="form-group">
						<label>Net Amount: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="number" class="form-control" id="netamount" readonly name="netamount" placeholder="Net Amount" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"  style="text-align:right;"  value="<?php echo $netamount;?>">
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
      		<!--<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
			    <label>For Consolidated Premium Retailers</label>
      			<div class="form-group">
				  
				</div>
				
				<div class="form-group" style="margin-top:75px">
					Authorised Signature
				</div>
				
      		</div>-->
			<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
				<div class="form-group">
					<input  class="btn btn-default btn-block" type="submit" value="Update" />
				</div>
			</div>
      	</div>
      	
  
		  
		</div>
		</div>
    </div>
    <!-- /#wrapper -->
	</form>
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/jquery/jquery.js"></script>
	<script src="<?php echo base_url();?>assets/jquery/jquery-ui.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/jquery/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url();?>assets/menu/js/menuscript.js"></script>
	
	<script src="<?php echo base_url();?>assets/calc/auto.js"></script>
	<script src="<?php echo base_url();?>assets/datatables/js/jquery.dataTables.js"></script>
	
	<!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/metisMenu/dist/metisMenu.min.js"></script>
	
	
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>
	<script>
	$(document).ready(function() {
		$('#example').DataTable( {
			columnDefs: [ {
				targets: [ 0 ],
				orderData: [ 0, 1 ]
			}, {
				targets: [ 1 ],
				orderData: [ 1, 0 ]
			}, {
				targets: [ 3 ],
				orderData: [ 3, 0 ]
			}]
		});
	});
	</script>
</body>

</html>