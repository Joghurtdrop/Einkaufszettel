<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dbConfiguration.php');

	$db_link=mysqli_connect(
			MYSQL_HOST,
			MYSQL_USER,
			MYSQL_PASSWORD,
			MYSQL_DATABASE
			);
			
	if (!$db_link) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}

	$shopid = $_SESSION['selectedShopId'];
	$userid = $_SESSION['userId'];
	
	$query = "INSERT INTO positions (position, shopid, userid, categoryid) VALUES("
		.$_GET['position']
		.", "
		.$shopid
		.", "
		.$userid
		.", "
		.$_GET['categoryid']
		.")";
		
	mysqli_query($db_link, $query);
	mysqli_close($db_link);
?>