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
	
	$userid=1;
	$shopid=1;
	
	print_r($_GET['position']." ".$shopid." ".$userid." ".$_GET['categoryid']);
	
	$query = "DELETE FROM positions WHERE position="
		.$_GET['position']
		." AND shopId="
		.$shopid
		." AND userId="
		.$userid
		." AND categoryId="
		.$_GET['categoryid'];
		
	mysqli_query($db_link, $query);
	
	$query = "UPDATE positions SET position = position - 1 WHERE userId="
	.$userid
	." AND shopId="
	.$shopid
	." and position>" 
	.$_GET['position'];
	
	mysqli_query($db_link, $query);
	mysqli_close($db_link);
?>