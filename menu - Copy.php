<!DOCTYPE html>
<html>
<head>
	<title>menu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="asset/css/menu.css">
</head>
<body>

<div class="containerr">
	
<a class="toggleMenu" href="#">Menu</a>
<ul class="nav">
	<li  class="test">
		<a href="#">Invoice</a>
		<ul>
			<li>
				<a href="search-invoice.php">Search Invoice</a>
				
			</li>
			
			<li>
				<a href="Create-invoice.php">Create Invoice</a>
				
			</li>
		</ul>
	</li>
	<li>
		<a href="#">Purchase Order</a>
		<ul>
			<li>
				<a href="select_vendor.php">Create Medicine po</a>
				
			</li>
			
		</ul>
	</li>
	<li>
		<a href="#">GRN</a>
		<ul>
			<li>
				<a href="view_GRN.php">View GRN </a>
				
			</li>
			
		</ul>
	</li>
	<li>
		<a href="#">Stock Detais</a>
		<ul>
			<li>
				<a href="view_stock.php">View Current Stocks</a>
				
			</li>
			
			<li>
				<a href="view_reorder_stock.php">View Stock to be Re-order</a>
				
			</li>
			<li>
				<a href="#">Stock Adjustment</a>
				
			</li>
		</ul>
	</li>
	<li>
		<a href="#">Reports</a>
		<ul>
			<li>
				<a href="view_purchase_report.php">Purchase Reports</a>
			</li>
			<li>
				<a href="view_selles_report.php">Sales Reports</a>
				
			</li>
			
		</ul>
	</li>
	
	<li>
		<a href="logout.php">Log out</a>

	</li>
</ul>
</div>
	<script type="text/javascript" src="asset/js/jquery.min.js"></script>
    <script type="text/javascript" src="asset/js/menuscript.js"></script>


</body>
</html>