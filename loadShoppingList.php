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

	$sql = "SELECT listentries.number, products.name, products.id FROM listentries INNER JOIN products ON products.id=listentries.productId";
	$result = mysqli_query($db_link, $sql);

	if($result != FALSE)
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			?>
				<li class="listelement">
					<div class="listtext"><?php echo $row['number']?></div>
					<div class="listtext"><?php echo $row['name']?></div>
					<div style="float:right">
						<a onClick="removeProduct(this)"><i class="material-icons md-24">&#xE928;</i></a>
						<a><i class="material-icons md-24">&#xE145;</i></a>
						<a><i class="material-icons md-24">&#xE15B;</i></a>
					</div>
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