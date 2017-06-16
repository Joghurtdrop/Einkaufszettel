<?php
	session_start();
	session_regenerate_id();
	
	if(empty($_SESSION['userid']))
	{
		header('Location: http://'.$_SERVER['HTTP_HOST'].'/Einkaufszettel/login.php');
	}
	else
	{
		$login_status='<div style="border: 1px solid black">Sie sind angemeldet.<br />
							<a href="./logout.php">Sitzung beenden</a>
					   </div>';		
	}
?>