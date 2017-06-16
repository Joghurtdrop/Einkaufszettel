<?php
	session_start();
	session_regenerate_id();
	
	include 'dataAccess/dataAccessLogin.php';
	
	if(empty($_SESSION['userid']))
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/Einkaufszettel/login.php');
	}
	else
	{
		$name=getUsername($_SESSION['userid']);
		$login_status="<div>Hallo ".$name.".<br />
							<a href=\"./logout.php\">Sitzung beenden</a>
					   </div>";		
	}
?>