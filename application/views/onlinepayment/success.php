<?php ini_set('display_errors', 1); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Payment Page</title>
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
	<div>
		<div class="row" style="margin-top: 50px;">

			<div class="col-md-1">
				
			</div>
			<div class="col-md-5">
				<img src="<?php echo base_url();?>img/gizmoland.png" alt="gizmoland" />
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-3">
				<img src="<?php echo base_url();?>img/gizmoland.png" alt="gizmoland" />
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-2">
			</div>
			<?php if($amznPmtsPaymentStatus == 'APPROVED') { ?>
			<div class="col-md-8" style="background-color: #b5edf9; padding: 50px 88px; text-align: center; margin-top: 50px;">
				<span style="color:#4e971a;font-size:28px;font-weight:bold;">			
					THANK YOU! YOUR PAYMENT HAS BEEN
				</span>
				<span style="color:#4e971a;font-size:28px;font-weight:bold;">			
					SUCCESSFULLY COMPLETED.
				</span>
			</div>
			<?php } else { ?>
			<div class="col-md-8" style="background-color: #b5edf9; padding: 50px 115px; text-align: center; margin-top: 50px;">
				<span style="color:#de3939;font-size:28px;font-weight:bold;">			
					SORRY! YOUR PAYMENT HAS BEEN FAILED
				</span>
				<span style="color:#de3939;font-size:28px;font-weight:bold;">			
					CONTACT ADMINISTRATOR!!!.
				</span>
			</div>
			<?php } ?>
			<div class="col-md-2">
			</div>
		</div>
	</div>
</body>

</html>