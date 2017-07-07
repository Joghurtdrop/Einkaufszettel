<?php
	session_start();
	
	include $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccessProfile.php';
	
	setSelectedShop($_SESSION['userId'],$_POST['selectedShopId']);
	$_SESSION['selectedShopId']=$_POST['selectedShopId'];
	echo json_encode(getSelectedShop($_SESSION['userId']));	
?>