<?php
	include_once 'dataAccess.php';
	
	function getShops($userid)
	{
		$db_link=getDbLink();
		$query="SELECT shops.name, shops.id FROM shops 
				INNER JOIN positions ON shops.id = positions.shopId
				WHERE positions.userId=".$userid."
				GROUP BY shops.id, shops.name
				ORDER BY shops.name";
		$result=mysqli_query($db_link, $query);		
		mysqli_close($db_link);
		return $result;
	}
	
	
	function getSelectedShop($userid)
	{
		$db_link=getDbLink();
		$query="SELECT users.selectedShop, shops.name 
				FROM shoppinglist.users 
				INNER JOIN shoppinglist.shops ON shops.id = users.selectedShop 
				WHERE users.id=".$userid;
		$selectedShop=mysqli_query($db_link,$query);
		mysqli_close($db_link);
		return mysqli_fetch_assoc($selectedShop);
	}
	
	
	function setSelectedShop($userid, $shopid)
	{
		$db_link=getDbLink();
		$query="UPDATE shoppinglist.users SET selectedShop=".$shopid." WHERE id=".$userid;
		mysqli_query($db_link, $query);
		mysqli_close($db_link);		
	}
	
	
	function deleteShop($userId, $shopId)
	{
		$db_link=getDbLink();
		$query="UPDATE shoppinglist.users SET selectedShop = NULL WHERE id=".$userId." AND selectedShop=".$shopId;
		mysqli_query($db_link, $query);
		$query="DELETE FROM shoppinglist.positions WHERE shopId=".$shopId." AND userId=".$userId;
		mysqli_query($db_link, $query);
		mysqli_close($db_link);	
	}
	
	
	function addShop($userId, $shopName)
	{
		$db_link=getDbLink();
		$id=getShopId($shopName);
		if($id==NULL)
		{
			$id=addNewShopToDb($shopName);
		}
		else
		{
			$query="SELECT position FROM shoppinglist.positions WHERE userId=".$userId." AND shopId=".$id;
			$result=mysqli_query($db_link,$query);
			if(mysqli_num_rows($result)>0)
			{
				mysqli_close($db_link);
				return getSelectedShop($userId)['selectedShop'];
			}
		}
		$query="UPDATE users SET selectedShop = ".$id." WHERE id =".$userId;
		mysqli_query($db_link,$query);
		$query="INSERT INTO shoppinglist.positions (userId,categoryId,shopId,position)
				VALUES (".$userId.",999,".$id.",1)";
		mysqli_query($db_link,$query);				
		mysqli_close($db_link);
		return getSelectedShop($userId)['selectedShop'];
	}
	
	
	function getShopId($name)
	{
		$db_link=getDbLink();
		$stmt=mysqli_stmt_init($db_link);
		if(mysqli_stmt_prepare($stmt, "SELECT id FROM shoppinglist.shops WHERE name = ?"))
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
	
	
	function addNewShopToDb($name)
	{
		$db_link=getDbLink();
		$stmt=mysqli_stmt_init($db_link);
		if(mysqli_stmt_prepare($stmt, "INSERT INTO shoppinglist.shops (name) VALUES (?)"))
		{		
			mysqli_stmt_bind_param($stmt,"s",$name);
			mysqli_stmt_execute($stmt);$result=NULL;
			mysqli_stmt_close($stmt);
		}
		mysqli_close($db_link);
		return getShopId($name);
	}
	
	
	function getCategoriesSelectedShop($userId, $selectedShopId)
	{
		$db_link=getDbLink();
		$query="SELECT categories.name, categoryId from positions"
			  ." INNER JOIN categories on (categories.id=positions.categoryId)"
			  ." WHERE userId="
			  .$userId
			  ." and shopId="
			  .$selectedShopId
			  ." and categories.id<>999"
			  ." ORDER BY position ASC";
		$result=mysqli_query($db_link, $query);
		mysqli_close($db_link);		
		return $result;
	}
	
	
//INSERT INTO `positions` (`userId`, `categoryId`, `shopId`, `position`) VALUES ('1', '1', '1', '1'),('1', '2', '1', '2'),('1', '3', '1', '3'),('1', '4', '1', '4'),('1', '5', '1', '5'),('1', '1', '2', '3'),('1', '2', '2', '2'),('1', '3', '2', '1');
?>

