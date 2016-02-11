<?php ini_set('display_errors', 1); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reports</title>
    <!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.min.css" />
	<!-- Bootstrap Responsive CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	
	<style>
		.clsalerttext{
			border-color: #a94442;
			box-shadow : 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			outline : 0 none;
		}
	</style>
</head>

<body>
	<?php
		if(isset($_GET))
		{
			$amznPmtsOrderIds = $_GET['amznPmtsOrderIds'];
			$amznPmtsReqId = $_GET['amznPmtsReqId'];
			$amznPageSource = $_GET['amznPageSource'];
			$merchName = $_GET['merchName'];
			$amznPmtsYALink = $_GET['amznPmtsYALink'];
			$amznPmtsPaymentStatus = $_GET['amznPmtsPaymentStatus'];
			$actionToken = $_GET['actionToken'];
			
		}
		else
		{
			echo "<H1>Payment Failed!!!</H1>";
		}
	?>
</body>

</html>