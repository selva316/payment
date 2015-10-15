<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <title>Quotation List</title>
	<link rel="icon" type="image/png" href="../images/logo.png"/>
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Noto+Serif:400,700"> 
    <!-- Bootstrap core CSS -->
    <link href="asset/css/jquery-ui.min.css" rel="stylesheet">
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="datatables/css/jquery.dataTables.css" />
    <link href="asset/css/datepicker.css" rel="stylesheet">
    <link href="asset/css/font-awesome.min.css" rel="stylesheet">
    <link href="asset/css/style.css" rel="stylesheet">

    <script src="asset/js/ie.js"></script>
	

   	
  </head>
  <?php include('menu.php'); ?>
  <body>
	<form name="frminvoice" action="fr_invoicedb.php" method="post" onsubmit="return frmvalidation()">
    <div class="panel panel-success">
	<div class="panel-heading">
		<center><label><b>Quotation List</b></label></center></div>
	</div>		
	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div style="margin-left:30px;margin-bottom:10px;">
						<a href="index.php" class="btn btn-large btn-success">Add Quotation</a>
					</div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="panel panel-default">
				<div class="panel-heading">Quotation List</div>
				<div class="panel-body">
					<table id="example" class="display" cellspacing="0" width="100%">
						<thead>
							<tr>
								
								<th>QID</th>
								<th>Customer</th>
								<th>Total</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query = $dbh->query("select * from py_quotation");
								$result = $query->fetchAll();
								foreach($result as $row)
								{
									//$lq = $dbh->query("select * from py_items where qid='".$row['QID']."'");
									//$lq->fetchColumn(); 
									echo "<tr>";
									echo "<td>".$row['QID']."</td>";
									echo "<td>".ucfirst($row['NAME'])."</td>";
									echo "<td>".$row['NETAMOUNT']."</td>";
									echo "<td>".$row['STATUS']."</td>";
									echo "<td><a href=editquotation.php?qid=".$row['HASHQID'].">Edit</a>";
									echo "<a style='margin-left:20px;' target='_blank' href=urlpdf.php?qid=".$row['HASHQID'].">Pdf</a>";
									echo "<a style='margin-left:20px;' target='_blank' href=viewquotation.php?qid=".$row['HASHQID'].">View</a>";
									echo "</td>";
									echo "</tr>";
									
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
</form>
    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/jquery-ui.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
    <script src="asset/js/bootstrap-datepicker.js"></script>
    <script src="asset/js/auto.js"></script>
	<script src="datatables/js/jquery.dataTables.js"></script>
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