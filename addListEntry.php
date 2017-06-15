<?php

	echo $_POST['productName'];	$productName = $_POST["productName"];
	$productNumber=$_POST["productNumber"];
	$categoryId=$_POST["categoryId"];
	
	include 'dataAccess.php';
	
	addEntry(1,$productName, $productNumber, $categoryId);	
?>
