<?php
	require_once('dataAccess/dbConfiguration.php');

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
	
	$query = "UPDATE positions SET position="
		.$_GET['position']
		." WHERE shopId="
		.$_GET['shopid']
		." AND userId="
		.$_GET['userid']
		." AND categoryId="
		.$_GET['categoryid'];
		
	mysqli_query($db_link, $query);
	mysqli_close($db_link);
?>