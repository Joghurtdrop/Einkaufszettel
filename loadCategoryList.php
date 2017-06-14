<?php
	require_once('dbConfiguration.php');

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

	$sql = "SELECT name FROM categories INNER JOIN positions ON positions.CategoryId=categories.id WHERE positions.UserId=1 ORDER BY positions.Position";
	$result = mysqli_query($db_link, $sql);

	if($result != FALSE)
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			?>
				<li>
					<div onClick="setCategory(this)"><?php echo $row['name']?></div>
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