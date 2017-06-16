<?php

	$productId=$_POST['productId'];
	$number=$_POST['number'];

	include 'cataAccess/dataAccessShoppingList.php';
	
	updateEntryNumber($productId, 1, $number)
?>