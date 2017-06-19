<?php
	session_start();
	include 'dataAccess/dataAccessProfile.php';
	deleteShop($_SESSION['userId'], $_POST['shopId']);	
	$_SESSION['selectedShopId']=getSelectedShop($_SESSION['userId'])['selectedShop'];
?>