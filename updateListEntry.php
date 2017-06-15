<?php

	$productId=$_POST['productId'];
	$number=$_POST['number'];
	echo $productId;
	echo $number;

	include 'dataAccess.php';
	
	updateEntryNumber($productId, 1, $number)
?>