<?php

	session_start();
	$productId=$_POST['productId'];
	$number=$_POST['number'];

	include $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccessShoppingList.php';
	
	updateEntryNumber($productId, $_SESSION['userId'], $number)
?>