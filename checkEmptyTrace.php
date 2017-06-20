<?php
	session_start()
	include_once 'dataAccess/dataAccessProfile.php';
	
	checkSelectedShop($_SESSION['userId'], $_SESSION['selecetedShopId']);
?>