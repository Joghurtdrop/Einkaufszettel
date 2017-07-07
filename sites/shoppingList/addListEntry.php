<?php
	session_start();
	$productName = $_POST["productName"];
	$productNumber=$_POST["productNumber"];
	$categoryId=$_POST["categoryId"];
	
	include $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccessShoppingList.php';
	
	addEntry($_SESSION['userId'],$productName, $productNumber, $categoryId);	
?>
