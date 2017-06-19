<?php

	$productId=$_POST['productId'];
	$number=$_POST['number'];

	include 'dataAccess/dataAccessShoppingList.php';
	
	updateEntryNumber($productId, 1, $number)
?>