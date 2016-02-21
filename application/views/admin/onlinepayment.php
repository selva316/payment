<?php
	error_reporting(0);
	$data = json_decode($data,true);
	//print_r($data);
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Online Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!-- Le styles -->
    <link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap/css/bootstrap-theme.css.map" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">
	
	<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
    /*    background-color: #f5f5f5; */
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
		
		 .bs-example{
    	margin-left: 60px;
		margin-right: 60px;
    }
    </style>
  </head>
<body>
	<div class="container">
		<div class="row">
			<div class="span2">
			</div>
			<div class="span4">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<label>
						Customer Details
						</label>
					</div>
					<div class="panel-body">
						<table class="table table-hover">
							<tbody>
								<tr>
									<td>Quotation ID:</td>
									<td><?php echo $data['qid']; ?></td>
								</tr>
								<tr>
									<td>Quotation Date:</td>
									<td><?php echo date("d M Y",$data['quotationdate']); ?></td>
								</tr>
								<tr>
									<td>Name:</td>
									<td><?php echo ucfirst($data['name']); ?></td>
								</tr>
								<tr>
									<td>Contact:</td>
									<td><?php echo $data['contact']; ?></td>
								</tr>
								<tr>
									<td>Address:</td>
									<td><?php echo $data['address']; ?></td>
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
			<div class="span4"   style="margin-top:125px;">
				<legend>Payment Gateway</legend>
				<?php echo $cartHtml; ?>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

					<!-- Identify your business so that you can collect the payments. -->
					<input type="hidden" name="business" value="selvalingam@yahoo.com">

					<!-- cmd, upload are REQUIRED, and are always values of "_cart" and "1", respectively -->
					<input type ="hidden" name ="cmd" value ="_ext-enter">
					<input type ="hidden" name ="redirect_cmd" value ="_cart">
					<input type="hidden" name="upload" value= "1" >

					<!-- Specify details about the item that buyers will purchase. -->
					<?php
		
						
						$i = 0;
						foreach($data['itemdetails'] as $k=>$v)
						{
							$i++;
							
							$itemname = "item_name_".$i;
							$amount = "amount_".$i;
							$quantity = "quantity_".$i;
							$itemnumber = "item_number_".$i;
							$tax = "tax_".$i;
														
							$actualprice = ($v['price'] * 1);
							$disvalue = ((1 * $v['price'] * $v['dis']) / 100);
							$taxvalue = ((($actualprice - $disvalue) * $v['taxpercent']) / 100);
							//$rowtotal = $actualprice - ($disvalue + $taxvalue);
							$rowtotal = $actualprice - ($disvalue + $taxvalue);
							
							//$actualtotal = ($actualprice + $taxvalue)- $disvalue;
							$actualtotal = $actualprice - ($disvalue + $taxvalue);
							
							echo '<input type="hidden" name="'.$itemname.'" value="'.$v['description'].'">';
							echo '<input type="hidden" name="'.$amount.'" value="'.$actualtotal.'">';
							echo '<input type="hidden" name="'.$quantity.'" value="'.intval($v['quantity']).'">';
							echo '<input type="hidden" name="'.$itemnumber.'" value="'.$v['itemcode'].'">';
							echo '<input type="hidden" name="'.$tax.'" value="'.$taxvalue.'">';
							
						}
					?>
					
					<input type="hidden" name="currency_code" value="USD">
					<!-- Prompt buyers to enter their desired quantities. -->
					<input type="hidden" name="undefined_quantity" value="<?php echo $i; ?>">
		
					<input type="hidden" name="return" value="http://52.74.245.165/payment/onlinepayment/success" />
					<input type="hidden" name="cancel_return" value="http://52.74.245.165/payment/onlinepayment/cancel" />
								
					<!-- Display the payment button. -->
					<input width="200"  height="50" type="image" name="submit" border="0"
					src="<?php echo base_url();?>img/paypal.jpg"
					alt="PayPal - The safer, easier way to pay online">
					<img alt="" border="0" width="1" height="1"
					src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

				</form>
			</div>
		</div>
		<div class="row">
			<div class="span2">
			</div>
			<div class="span10">
				<div class="panel panel-success">
					<div class="panel-heading">
						<label>
						Order Summary
						</label>
					</div>
					<div class="panel-body">
						<table class="table table-hover">
							<thead>
								
								<tr>
									<th width="15%">Item Code</th>
									<th width="35%">Description of Goods</th>
									<th width="5%">QTY</th>
									<th width="10%">Price</th>
									<th width="5%">DIS%</th>
									<th width="8%">TAX%</th>
									<th width="10%">TAX</th>
									<th width="10%">TOTAL</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$nettoal = 0;
							$subtoal = 0;
							$taxtotal = 0;
							foreach($data['itemdetails'] as $k=>$v)
							{
								//$tot = $tot + ($v['price'] * $v['quantity']) + (($v['quantity'] * $v['price'] * $v['taxpercent']) / 100) ;
							
								$actualprice = ($v['price'] * $v['quantity']);
								$disvalue = (($v['quantity'] * $v['price'] * $v['dis']) / 100);
								$taxvalue = ((($actualprice - $disvalue) * $v['taxpercent']) / 100);
								//$rowtotal = $actualprice - ($disvalue + $taxvalue);
								$rowtotal = $actualprice - ($disvalue + $taxvalue);
								
								$actualtotal = ($actualprice + $taxvalue)- $disvalue;
								
								$taxtotal = $taxtotal +  $taxvalue;
								$subtoal = $subtoal + $rowtotal;
								$nettoal = $nettoal + $actualtotal;
								echo '<tr>';
									echo '<td>'.$v['itemcode'].'</td>';
									
									echo '<td>'.$v['description'].'</td>';
									echo '<td>'.$v['quantity'].'</td>';
									echo '<td>'.$v['price'].'</td>';
									echo '<td>'.$v['dis'].'</td>';
									echo '<td>'.number_format(($v['taxpercent']), 2, '.', ',').'</td>';
									echo '<td>';
									echo number_format(($taxvalue), 2, '.', ',');
									echo '</td>';
									echo '<td style="text-align:right;">';
										echo number_format(($rowtotal), 2, '.', ',');
										//echo ($v['price'] * $v['quantity'] + (($v['quantity'] * $v['price'] * $v['taxpercent']) / 100));
									echo '</td>';
								echo '</tr>';
								/*echo '<tr>';
									echo '<td style="border-top: #fff;">Item Code: '.$v['itemcode'].'</td>';
									echo '<td style="border-top: #fff;"></td>';
								echo '</tr>';
								echo '<tr>';
									echo '<td style="border-top: #fff;">Item price: '.$v['price'].'</td>';
									echo '<td style="border-top: #fff;"></td>';
								echo '</tr>';
								echo '<tr>';
									echo '<td style="border-top: #fff;">Quantity: '.$v['quantity'].'</td>';
									echo '<td style="border-top: #fff;"></td>';
								echo '</tr>';
								echo '<tr>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
								echo '</tr>';
								echo '<tr>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
								echo '</tr>';*/
								
							}
							echo '<tr>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="font-weight:bold;">Sub Total</td>';
									echo '<td style="font-weight:bold; text-align:right">'.number_format(($subtoal), 2, '.', ',').'</td>';
							echo '</tr>';
							echo '<tr>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="font-weight:bold;">Tax Total</td>';
									echo '<td style="font-weight:bold; text-align:right">'.number_format(($taxtotal), 2, '.', ',').'</td>';
							echo '</tr>';
							echo '<tr>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="border-top: #fff;"></td>';
									echo '<td style="font-weight:bold;">Round Off</td>';
									echo '<td style="font-weight:bold; text-align:right">'.number_format(($data['roundoff']), 2, '.', ',').'</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td style="border-top: #fff;"></td>';
								echo '<td style="border-top: #fff;"></td>';
								echo '<td style="border-top: #fff;"></td>';
								echo '<td style="border-top: #fff;"></td>';
								echo '<td style="border-top: #fff;"></td>';
								echo '<td style="border-top: #fff;"></td>';
								echo '<td style="font-weight:bold;">Net Amount</td>';
								echo '<td style="font-weight:bold; text-align:right">'.number_format(($data['netamount']), 2, '.', ',').'</td>';
							echo '</tr>';
							
							?>
							</tbody>
						</table>
					<!--	<legend><?php echo "Rupees " .ucfirst($data['amtinwords'])." only/-"; ?></legend>-->
					</div>
				</div>
			</div>
		</div>
    </div> <!-- /container -->
</body>
</html>
