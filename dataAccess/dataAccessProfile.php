<?php
	include 'dataAccess.php';
	
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
	
	
	function addShop($userId, $shopName)
	{
		
	}
?>