<?php
	if($this->session->userdata('roleid')!=2){
		// echo site_url('login');
		print "<script>window.location.href='".site_url('login')."';</script>";
	}
?>
<?php $this->load->view('includes/storeconfiguration');?>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Manage Sale Tracking</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<div class="panel panel-default">
			<div class="panel-heading">List of Orders</div>
			<div class="panel-body">
				<a href="#">New Item to Track</a>
				<?php echo $output; ?>
			</div>
			
		</div> 
		<div class="panel-footer">
				<button id="submit" name="submit_button" class="btn btn-outline btn-primary" type="submit"><i class="fa fa-check"></i>Save</button>
			</div>
	   
	</div>
	<!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	<!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/metisMenu/dist/metisMenu.min.js"></script>
	
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>

</body>
</html>