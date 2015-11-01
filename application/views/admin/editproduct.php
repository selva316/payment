<?php
	if($this->session->userdata('roleid')!=1){
		// echo site_url('login');
		print "<script>window.location.href='".site_url('login')."';</script>";
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

    <title>Product</title>
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
	<form name="frminvoice" action="editproduct/datainsert" method="post">
    <div id="wrapper">
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<ul class="nav">
				<li  class="test">
					<a href="<?php echo site_url('admin/homepage');?>">Home</a>
				</li>
				<li  class="test">
					<a href="<?php echo site_url('admin/product');?>">Product</a>
				</li>
			</ul>
		</nav>
		<div class="panel panel-success">
	<div class="panel-heading">
		<center><label><b>Edit Product</b></label></center></div></div>		
		<div class="container-fluid">
		
    <!-- Begin page content -->
    <div class="container content">
    	
      	<div class='row'>
      		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
      			<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="15%">UPC</th>
							<th width="10%">MPN</th>
							<th width="35%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Brand</th>
							<th width="10%">MRP</th>
									
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" data-type="upc" name="upc" id="upc" value="<?php echo $upc; ?>" class="form-control autocomplete_txt" autocomplete="off">
								<input type="hidden" id="itemcode" name="itemcode" value="<?php echo $itemcode; ?>" />
								<input type="hidden" id="hashitemcode" name="hashitemcode" value="<?php echo $hashitemcode; ?>" />
							</td>
							<td><input type="text" data-type="mpn" name="mpn" id="mpn" value="<?php echo $mpn; ?>" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" data-type="description" name="description" id="description" value="<?php echo $description; ?>" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" data-type="category" name="category" id="category" value="<?php echo $category; ?>" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" name="brand" id="brand" class="form-control changesNo" value="<?php echo $brand; ?>" autocomplete="off" ondrop="return false;" onpaste="return false;"></td>
							<td><input type="text" name="mrp" id="mrp" class="form-control changesNo autocomplete_txt" value="<?php echo $mrp; ?>" autocomplete="off"></td>
						</tr>
					</tbody>
				</table>
      		</div>
      	</div>
		<!--<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
      			<button class="btn btn-danger delete" type="button">- Delete</button>
      			<button class="btn btn-success addmore" type="button">+ Add More</button>
      		</div>-->
			
			     		
      	
		
	
  </br><hr>
  
		
		<div class='row'>
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