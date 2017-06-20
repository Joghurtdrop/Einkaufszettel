<?php

	session_start();
	$productId=$_POST['productId'];
	$number=$_POST['number'];

	include 'dataAccess/dataAccessShoppingList.php';
	
	updateEntryNumber($productId, $_SESSION['userId'], $number)
?>