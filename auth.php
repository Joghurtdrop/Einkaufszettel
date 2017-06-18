<?php
	session_start();
	session_regenerate_id();
	
	include 'dataAccess/dataAccessLogin.php';
	
	if(empty($_SESSION['userId']))
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/Einkaufszettel/login.php');
	}
	else
	{
		$name=getUsername($_SESSION['userId']);
		$login_status="<h3>Hallo ".$name."</h3>";		
	}
?>