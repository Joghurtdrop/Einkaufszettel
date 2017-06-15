<?php

	require_once('dbConfiguration.php');

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
		return $db_link;
	}
	
	
	function addProduct($name)
	{
		$db_link=getDbLink();
		$query="INSERT INTO shoppinglist.products (name) VALUES ('".$name."')";
		mysqli_query($db_link,$query);
		mysqli_close($db_link);
		return getProductUnsafe($name);
	}
	
	function getProductUnsafe($name)
	{
		$db_link=getDbLink();
		$query="SELECT id FROM shoppinglist.products WHERE name LIKE '".$name."'";
		$result = mysqli_query($db_link,$query);
		if($result != FALSE)
		{
			mysqli_close($db_link);
			return mysqli_fetch_assoc($result)['id'];
		}
		mysqli_close($db_link);
		return NULL;
	}
	
	
	function getProductSafe($name)
	{
		$db_link=getDbLink();
		$query="SELECT id FROM shoppinglist.products WHERE name = ?";
		if($sql=mysqli_prepare($db_link,$query))
		{		
			echo 'juhuu';
			mysqli_stmt_bind_param($sql,"s",$name);
			mysqli_stmt_execute($sql);
			mysqli_stmt_bind_result($sql,$result);
			if(mysqli_stmt_fetch($sql)==NULL)
			{
				$result=NULL;
			}	
			mysqli_stmt_close($sql);
		}
		mysqli_close($db_link);
		return $result;
	}
	
	function getEntry($productId, $userId)
	{
		$db_link=getDbLink();
		$query="SELECT userId, productId, categoryId, number FROM shoppinglist.listentries WHERE userId = '".$userId."' AND productId ='".$productId."'";
		$result = mysqli_query($db_link,$query);
		if(mysqli_num_rows($result)==1)
		{
			return mysqli_fetch_assoc($result);
		}
		return NULL;
	}
	
	function updateEntryNumber($productId, $userId, $number)
	{
		if($number < 1)
		{
			removeEntry($userId, $productId);
			return;
		}
		$db_link=getDbLink();
		$query="UPDATE shoppinglist.listentries SET number='".$number."' WHERE userId = '".$userId."' AND productId ='".$productId."'";
		mysqli_query($db_link,$query);
		mysqli_close($db_link);
	}
	
	function addEntry($userId, $name, $number , $categoryId)
	{
		$id=getProductUnsafe($name);
		if($id==NULL)
		{
			$id=addProduct($name);
		}
		else
		{
			$entry=getEntry($id,$userId);
			if($entry!=NULL)
			{
				updateEntryNumber($entry['productId'], $entry['userId'], $number+$entry['number']);
				return;
			}	
		}
		$db_link=getDbLink();
		$query="INSERT INTO shoppinglist.listentries (userId, productId, categoryId, number) VALUES (".$userId.",".$id.",".$categoryId.",".$number.")";
		mysqli_query($db_link,$query);
		mysqli_close($db_link);
	}
	
	function removeEntry($userId,$productId)
	{
		$db_link=getDbLink();
		$query="DELETE FROM shoppinglist.listentries WHERE userId = '".$userId."' AND productId ='".$productId."'";
		mysqli_query($db_link,$query);
		mysqli_close($db_link);
	}
	
?>