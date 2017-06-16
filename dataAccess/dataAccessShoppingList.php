<?php
	include 'dataAccess.php';
	
	/* loads all listentries with the passed user and shop ID from the database in order as saved in table positions */
	function loadList($userid, $shopid)
	{
		$db_link=getDbLink();
		$query="SELECT listentries.number, products.name, products.id FROM listentries 
				INNER JOIN products ON products.id=listentries.productId 
				INNER JOIN positions ON positions.categoryId=listentries.categoryId
				WHERE listentries.userId=".$userid." AND positions.shopId=".$shopid."
				ORDER BY positions.position";
		$result=mysqli_query($db_link, $query);		
		mysqli_close($db_link);
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
	/* !!FIXME: ERORR: mysqli_prepare excepts mysqli object parameter ??? WTF?? */
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
	   shoppinglist.listentries table it increases the number by the passes number-value */
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
	
	
	/* checks if a username password combination is valid returns TRUE if username is registered*/
	function checkUsername($username)
	{
		$valid=FALSE;
		$db_link=getDbLink();
		$stmt=mysqli_stmt_init($db_link);
		if(mysqli_stmt_prepare($stmt, "SELECT name, id FROM shoppinglist.users WHERE name = ?"))
		{		
			mysqli_stmt_bind_param($stmt,"s",$username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$name,$id);
			if(mysqli_stmt_fetch($stmt)!=NULL)
			{				
				$valid=TRUE;
			}				
			mysqli_stmt_close($stmt);
			return $valid;
		}
	}
	
	
	/* returns TRUE if username password combination is valid, else FALSE */
	function checkRegistration($username, $password)
	{
		$valid=FALSE;
		$db_link=getDbLink();
		$stmt=mysqli_stmt_init($db_link);
		if(mysqli_stmt_prepare($stmt, "SELECT id FROM shoppinglist.users WHERE name = ? AND password = ?"))
		{		
			mysqli_stmt_bind_param($stmt,"ss",$username, $password);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$result);
			if(mysqli_stmt_fetch($stmt)!=NULL)
			{
				$valid=$result;
			}				
			mysqli_stmt_close($stmt);
			return $valid;
		}
	}

?>