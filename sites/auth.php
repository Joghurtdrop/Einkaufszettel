<?php
	session_start();
	session_regenerate_id();
	
	set_include_path($_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel');
	include 'dataAccess/dataAccessLogin.php';
	
	if(empty($_SESSION['userId']))
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/Einkaufszettel/sites/login.php');
	}
	else
	{
		$name=getUsername($_SESSION['userId']);
		$login_status="<h3>Hallo ".$name."</h3>";		
	}
?>
