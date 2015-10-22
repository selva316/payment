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
			<center><label><b>Product List</b></label></center></div>
		</div>		
		<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<div style="margin-left:30px;margin-bottom:10px;">
							<a href="<?php echo site_url('admin/createproduct');?>" class="btn btn-large btn-success">Add Product</a>
						</div>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<div class="panel panel-default">
					<div class="panel-heading">Product List</div>
					<div class="panel-body">
						<table id="example" class="display" cellspacing="0" width="100%">
							<thead>
								<tr>
									
									<th>Item Code</th>
									<th>Description</th>
									<th>Price</th>
									<th>Discount</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if($result)
								{
									foreach($result as $row)
									{
										//$lq = $dbh->query("select * from py_items where qid='".$row['QID']."'");
										//$lq->fetchColumn(); 
										echo "<tr>";
										echo "<td>".$row['ITEMCODE']."</td>";
										echo "<td>".ucfirst($row['DESCRIPTION'])."</td>";
										echo "<td>".number_format(($row['PRICE']), 2, '.', ',')."</td>";
										echo "<td>".$row['DISCOUNT']."</td>";
										echo "<td><a href=".site_url('admin/editproduct')."?itemcode=".$row['HASHITEMCODE'].">Edit</a>";
										//echo "<a style='margin-left:20px;' target='_blank' href=viewquotation.php?qid=".$row['HASHQID'].">View</a>";
										echo "</td>";
										echo "</tr>";
										
									}
								}	
								?>
							</tbody>
						</table>
				</div>
				</div> 
			   
			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->
    </div>
    <!-- /#wrapper -->

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