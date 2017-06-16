<?php
	require_once('dbConfiguration.php');

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

	
	$query = "DELETE FROM positions WHERE position="
		.$_GET['position']
		." AND shopId="
		.$_GET['shopid']
		." AND userId="
		.$_GET['userid']
		." AND categoryId="
		.$_GET['categoryid'];
		
	mysqli_query($db_link, $query);
	mysqli_close($db_link);
?>