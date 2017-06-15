<?php

	$productId=$_POST['productId'];
	$number=$_POST['number'];

	include 'dataAccess.php';
	
	updateEntryNumber($productId, 1, $number)
?>