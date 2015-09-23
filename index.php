<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <title>Invoice </title>
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

  <body>

    <div class="panel panel-success">
	<div class="panel-heading">
		<center><label><b>TAX Invoice</b></label></center></div></div>		
		<div class="container-fluid">
		
    <!-- Begin page content -->
    <div class="container content">
    		
      	<div class='row'>
      		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
			<B><u>Customer Details</u></B></br>
		  
		        <div class="form-group">
				 <label>Name: <input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"></label>
                 <label>Contact No: <input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"></label>				 
				</div>
      			<div class="form-group">
				<b><u>Invoice Details</u></b></br>	
				<label>Invoice No: <input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"></label>
				<label>Invoice Date : <input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"></label>
				<label>Other Ref: <input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"></label>
				</div>
				<div class="form-group">
					
				</div>
				
      		</div>
      		<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
			    <label>Consolidated Premium Retailers</label>
      			<div class="form-group">
					<label>Contact : <input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"></label>
					<label>E-Mail: <input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"> </label>
					<label>TIN : <input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"> </label>
					<label>CST : <input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"></label>
				</div>
				
      		</div>
      	</div>
      	<div class='row'>
      		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
      			<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="2%">SL NO</th>
							<th width="38%">Description of Goods</th>
							<th width="10%">QTY</th>
							<th width="15%">Price</th>
							<th width="10%">TAX%</th>
							<th width="10%">TAX</th>
							<th width="15%">NET</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input class="case" type="checkbox"/></td>
							<td><input type="text" data-type="productName" name="itemName[]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="number" name="quantity[]" id="quantity_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
							<td><input type="number" name="price[]" id="price_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
							
							<td><input type="text" data-type="productCode" name="taxP[]" id="taxP_1" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" data-type="productCode" name="tax[]" id="tax_1" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="number" name="total[]" id="total_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
						</tr>
					</tbody>
				</table>
      		</div>
      	</div>
		<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
      			<button class="btn btn-danger delete" type="button">- Delete</button>
      			<button class="btn btn-success addmore" type="button">+ Add More</button>
      		</div>
			
			     		
      	
		
	
  </br><hr>
  <B>Remarks</B> </br></br>
  <div class='row'>
   
      		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
			
      			<div class="form-group">
					
				<label>Sales Employee : <input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"></label>
				<label>Rupees Five Thousand Fore </label>
				
				</div>
				
				
      		</div>
      		<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
			    <label>Consolidated Premium Retailers</label>
      			<div class="form-group">
					<label>Sub Total : <input type="number" class="form-control" id="subTotal" name="sub_total" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></label></br>
					<label>Tax Total : <input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"></label></br>
					<label>Round Off :<input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"></label><br>
					<label>Net Amount :<input type="text" class="form-control" id="clientCompanyName"name="c_name" placeholder="Name"></label>
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
				<b>Term & Condition	</b></br>
				1. Goods once sold con not be taken back.</br>
				2. Goods once sold con not be taken back.</br>
				3. Goods once sold con not be taken back.</br>
				4. Goods once sold con not be taken back.
				
				
				</div>
				
				
      		</div>
      		<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
			   
      		</div>
      	</div>
		<div class='row'>
   
      		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
			
      			<div class="form-group">
				
				
				</div>
				<div class="form-group">
				
				
				</div>
				<div class="form-group">
				 Customer Signature</br>
				 (Goods Received in good condition)
				
				</div>
				
				
      		</div>
      		<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
			    <label>For Consolidated Premium Retailers</label>
      			<div class="form-group">
					Authorised Signature
				</div>
				<div class="form-group">
				  
				</div>
				<div class="form-group">
					
				</div>
      		</div>
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




