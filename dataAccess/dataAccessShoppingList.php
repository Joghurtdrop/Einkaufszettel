<?php
	include 'dataAccess.php';
	
	/* loads all listentries with the passed user and shop ID from the database in order as saved in table positions */
	function loadList($userid, $shopid)
	{
		$db_link=getDbLink();
		$query="SELECT listentries.number, products.name AS pName, products.id, categories.name AS cName FROM listentries 
				INNER JOIN products ON products.id=listentries.productId 
				INNER JOIN positions ON positions.categoryId=listentries.categoryId
				INNER JOIN categories ON categories.id = listentries.categoryId
				WHERE listentries.userId=".$userid." AND positions.shopId=".$shopid."
				ORDER BY positions.position, products.name";
		$result=mysqli_query($db_link, $query);		
		mysqli_close($db_link);
		return $result;
	}
	
	function loadLostListentries($userId, $shopId)
	{
		$db_link=getDbLink();
		$query="SELECT listentries.number, products.name, products.id FROM listentries
				INNER JOIN products ON products.id=listentries.productId
				WHERE listentries.userId = ".$userId."
				AND listentries.categoryId NOT IN (SELECT categoryId FROM positions WHERE shopId = ".$shopId.") 
				ORDER BY products.name";
		$result=mysqli_query($db_link, $query);		
		mysqli_close($db_link);
		if($result==FALSE||mysqli_num_rows($result)<1 )
		{
			return NULL;
		}
		return $result;	
	}
	
	
	/* adds a row with the passed name parameter to the table shoppinglist.products 
	   returns the assigned productId */
	function addProduct($name)
	{
		$db_link=getDbLink();
		$query="INSERT INTO shoppinglist.products (name) VALUES ('".$name."')";
		mysqli_query($db_link,$query);
		mysqli_close($db_link);
		return getProductUnsafe($name);
	}
	
	
	/* returns the productId of a product selected by name from the table shoppinglist.products 
	   if this exists else NULL*/	
	/* !!FIXME: safe parameter passing (sql injection) */
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
	
	
	/* returns the productId of a product selected by name from the table shoppinglist.products */
	function getProductSafe($name)
	{
		$db_link=getDbLink();
		$stmt=mysqli_stmt_init($db_link);
		if(mysqli_stmt_prepare($stmt, "SELECT id FROM shoppinglist.products WHERE name = ?"))
		{		
			mysqli_stmt_bind_param($stmt,"s",$name);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$result);
			if(mysqli_stmt_fetch($stmt)==NULL)
			{
				$result=NULL;
			}	
			mysqli_stmt_close($stmt);
		}
		mysqli_close($db_link);
		return $result;
	}
	
	/* returns row-array from the table shoppinglist.listentries selected by UserId and productId 
	   if it exists, else NULL */
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
	
	/* updates the number of a defined shoppinglist.listentries row with the passed value
		if the value is 0 or smaller the row will be deleted*/
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
	
	/* adds a row to the shoppinglist.listentries table; checks if the products exists yet in the 
	   shoppinglist.products table, if it does uses its productId; if the already product is in the 
	   shoppinglist.listentries table it increases the number by the passed number-value */
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
	
	/* removes a row defined by userId and prod from the shoppinglist.listentries table */
	function removeEntry($userId,$productId)
	{
		$db_link=getDbLink();
		$query="DELETE FROM shoppinglist.listentries WHERE userId = '".$userId."' AND productId ='".$productId."'";
		mysqli_query($db_link,$query);
		mysqli_close($db_link);
	}
?>