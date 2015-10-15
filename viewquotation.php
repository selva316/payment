<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <title>View Quotation </title>
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
	<div style="margin-left:25px;"><center><label><b>Quotation</b></label></center></div>
	
		<div style="margin-left:20%;margin-top:2%;float:left;">
			<B><u>Customer Details</u></B></br>
			Name: <?php echo $oquotation->name; ?></br>
			Contact No: <?php echo $oquotation->contact; ?></br>
			Address:<?php echo $oquotation->address; ?></br>
		</div>
		
		<div  style="margin-left:25%;margin-top:2%;float:left;">
			<B><u>Consolidated Premium Retailers</u></B></br>
			Name: <?php echo $oquotation->name; ?></br>
			Contact No: <?php echo $oquotation->retailcontact; ?></br>
			E-Mail:<?php echo $oquotation->mailid; ?></br>
			TIN:<?php echo $oquotation->tin; ?></br>
			CST:<?php echo $oquotation->cst; ?></br>
		</div>
		
		<div style="clear:both"></div>
		
		<div style="margin-left:20%;">
			<B><u>Quotation Details</u></B></br>
			REF No: <?php echo $oquotation->refnumber; ?></br>
			Date: <?php echo $oquotation->quotationdate; ?></br>
		</div>
		
		<div style="margin-left:10%; margin-top:2%; width:80%">
			<table class="table table-striped">
				<thead>
					<tr>
						<th width="2%">SL.No</th>
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
						
						<td><?php echo $i; ?></td>
						<td><?php echo $row['ITEMCODE'] ?></td>
						<td><?php echo $row['DESCRIPTION'] ?></td>
						<td><?php echo $row['QUANTITY'] ?></td>
						<td><?php echo $row['PRICE'] ?></td>
						<td><?php echo $row['taxpercent'] ?></td>
						<td><?php echo ($row['QUANTITY'] * $row['PRICE'] * $row['taxpercent']) / 100 ?></td>
						<td><?php echo ($row['QUANTITY']*$row['PRICE']) ?></td>
					</tr>
					<?php 
						$i++;
						} 
					?>
				</tbody>
			</table>
		</div>
		<div  style="margin-left:10%; margin-top:2%;"">
			<h4>Sales Person:<?php echo $oquotation->salesperson; ?></h4>
			<h4>Terms & Condition</h4>
			<?php echo $oquotation->term; ?>
		</div>
		
  
  
</div>
</div>

    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/jquery-ui.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
    <script src="asset/js/bootstrap-datepicker.js"></script>
    <script src="asset/js/auto.js"></script>
	
  </body>
</html>