<?php
	session_start();
	include 'dataAccess/dataAccessProfile.php';
	$_SESSION['selectedShopId']=addShop($_SESSION['userId'], $_POST['name']);
	
?>