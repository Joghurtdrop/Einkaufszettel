<?php
	include 'dataAccess/dataAccessShoppingList.php';
	
	$db_link=getDbLink();
	
	$sql = "SELECT name, id FROM categories INNER JOIN positions ON positions.categoryId=categories.id WHERE positions.userId=1 ORDER BY positions.position";
	$result = mysqli_query($db_link, $sql);

	if($result != FALSE)
	{
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