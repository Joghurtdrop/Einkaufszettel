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
	
	$newpos = $_POST['after'];
	$oldpos = $_POST['befor'];
	$id = $_POST['id'];
	
	if ($oldpos > $newpos)
	{
		$query = "UPDATE positions SET position="
		."position+1 "
		." WHERE shopId="
		.$_SESSION['selectedShopId']
		." AND userId="
		.$_SESSION['userId']
		." AND position>="
		.$newpos
		." AND position<"
		.$oldpos;
		
		mysqli_query($db_link, $query);
		
		$query="UPDATE positions SET position="
		.$newpos
		." WHERE shopId="
		.$_SESSION['selectedShopId']
		." AND userId="
		.$_SESSION['userId']
		." AND categoryId="
		.$id;
		
		mysqli_query($db_link, $query);
	} else if ($oldpos < $newpos)
	{
			$query = "UPDATE positions SET position="
			."position-1 "
			." WHERE shopId="
			.$_SESSION['selectedShopId']
			." AND userId="
			.$_SESSION['userId']
			." AND position>"
			.$oldpos
			." AND position<="
			.$newpos;
			
			mysqli_query($db_link, $query);
			
				
			$query="UPDATE positions SET position="
			.$newpos
			." WHERE shopId="
			.$_SESSION['selectedShopId']
			." AND userId="
			.$_SESSION['userId']
			." AND categoryId="
			.$id;
			
			mysqli_query($db_link, $query);
	}

	mysqli_close($db_link);
?>