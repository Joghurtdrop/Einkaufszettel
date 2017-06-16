<?php

	require_once('dataAccess/dbConfiguration.php');

	
	/* returns a mysqli-object which represents a connection to the database 
		based on the data in dbConfiguration.php */
	function getDbLink()
	{
		$db_link=mysqli_connect(
				MYSQL_HOST,
				MYSQL_USER,
				MYSQL_PASSWORD,
				MYSQL_DATABASE
				);
				
		if (!$db_link) 
		{
			die("Connection failed: " . mysqli_connect_error());
			return NULL;
		}
		mysqli_query($db_link, "SET NAMES utf8");
		return $db_link;
	}
	
	
	/* processes the passed query 
	   FIXME: handle return values*/
	function processDbQuery($query)
	{
		$db_link=getDbLink();
		mysqli_query($db_link,$query);
		mysqli_close($db_link);
	}
	
	
?>