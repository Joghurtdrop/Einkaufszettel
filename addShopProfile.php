<?php
	session_start();
	include 'dataAccess/dataAccessProfile.php';
	
	echo $_SESSION['selectedShopId'];
	$id=addShop($_SESSION['userId'], $_POST['name']);	
	$_SESSION['selectedShopId']=$id;
	echo $_SESSION['selectedShopId'];
?>