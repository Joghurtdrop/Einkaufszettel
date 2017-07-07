<?php
	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccessProfile.php';
	deleteShop($_SESSION['userId'], $_POST['shopId']);	
	$_SESSION['selectedShopId']=getSelectedShop($_SESSION['userId'])['selectedShop'];
?>