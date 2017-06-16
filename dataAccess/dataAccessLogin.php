<?php 
	include 'dataAccess.php';
	
	
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
	
	
	function getUsername($userid)
	{		
		$db_link=getDbLink();
		$query="SELECT name FROM shoppinglist.users WHERE id=".$userid;
		$name=mysqli_query($db_link,$query);
		mysqli_close($db_link);
		return mysqli_fetch_assoc($name)['name'];
	}
	
	
	function getSelectedShop($userid)
	{
		$db_link=getDbLink();
		$query="SELECT selectedShop FROM shoppinglist.users WHERE id=".$userid;
		$selectedShop=mysqli_query($db_link,$query);
		mysqli_close($db_link);
		return mysqli_fetch_assoc($selectedShop)['selectedShop'];
	}
	
	
	function setSelectedShop($userid, $shopid)
	{
		$db_link=getDbLink();
		$query="UPDATE shoppinglist.users SET selectedShop=".$shopid." WHERE id=".$userid;
		mysqli_query($db_link, $query);
		mysqli_close($db_link);		
	}
?>