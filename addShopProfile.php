<?php
	session_start();
	include 'dataAccess/dataAccessProfile.php';
	addShop($_SESSION['userId'], $_POST['name']);
?>