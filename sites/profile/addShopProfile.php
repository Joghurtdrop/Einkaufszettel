<?php
	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccessProfile.php';
	
	echo $_SESSION['selectedShopId'];
	$id=addShop($_SESSION['userId'], $_POST['name']);	
	$_SESSION['selectedShopId']=$id;
	echo $_SESSION['selectedShopId'];
?>