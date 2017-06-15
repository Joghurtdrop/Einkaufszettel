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
	
	$code= mysqli_query($db_link, "SET NAMES utf8");
	$sql = "SELECT listentries.number, products.name, products.id FROM listentries INNER JOIN products ON products.id=listentries.productId";
	$result = mysqli_query($db_link, $sql);

	if($result != FALSE)
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			?>
				<li class="listelement">
					<div class="listnumber"><?php echo $row['number']?></div>
					<div class="listtext"><?php echo $row['name']?></div>
					<div style="float:right">
						<a onClick="removeEntry(this)"><i class="material-icons md-24">&#xE928;</i></a>
						<a onClick="incrementEntry(this)"><i class="material-icons md-24">&#xE145;</i></a>
						<a onClick="decrementEntry(this)"><i class="material-icons md-24">&#xE15B;</i></a>
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