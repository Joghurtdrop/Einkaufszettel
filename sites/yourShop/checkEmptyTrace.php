<?php
	session_start()
	include_once $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccessProfile.php';
	
	checkSelectedShop($_SESSION['userId'], $_SESSION['selecetedShopId']);
	echo 'bin da';
?>