<?php

include('header.php');

if(!empty($_POST['type'])){
	$type = $_POST['type'];
	$name = $_POST['name_startsWith'];
		
	$query = "select ITEMCODE,DESCRIPTION,PRICE from py_product_details where (UPPER($type) LIKE '".strtoupper($name)."%')";
	
	$qr = $dbh->query($query);
	$result = $qr->fetchAll();
	$data = array();
	
	foreach($result as $row)
	{
		$name = $row['ITEMCODE'].'|'.$row['DESCRIPTION'].'|'.$row['PRICE'];//i am not want item code i,eeeeeeeeeeee
		array_push($data, $name);
	}	
	echo json_encode($data);exit;
}


