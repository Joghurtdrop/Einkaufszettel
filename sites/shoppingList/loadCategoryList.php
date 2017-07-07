<?php
	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccessShoppingList.php';
	
	$db_link=getDbLink();
	
	$sql = "SELECT name, id FROM categories 
		    INNER JOIN positions ON positions.categoryId=categories.id 
			WHERE positions.userId=".$_SESSION['userId']." 
			AND positions.shopId=".$_SESSION['selectedShopId']." 
			AND categoryId<>999 
			ORDER BY positions.position";
	$result = mysqli_query($db_link, $sql);

	if($result != FALSE)
	{
		?>
			<li>
				<div onClick="setCategory(this)">keine Kategorie</div>
				<div class="hiddenField">0</div>
			</li>
		<?php
		while($row = mysqli_fetch_assoc($result)) 
		{
			?>
				<li>
					<div onClick="setCategory(this)"><?php echo $row['name']?></div>
					<div class="hiddenField"><?php echo $row['id']?></div>
				</li>
			<?php
		}
	}
	else
	{
		echo "Query failed";
	}
	mysqli_close($db_link);
?>