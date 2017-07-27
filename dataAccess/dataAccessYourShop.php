<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccess.php';
	
	
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
?>