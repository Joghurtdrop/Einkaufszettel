<?php
	session_start();
	
	include 'dataAccess/dataAccessLogin.php';
	
	setSelectedShop($_SESSION['userId'],$_POST['selectedShopId']);
	echo json_encode(getSelectedShop($_SESSION['userId']));	
?>