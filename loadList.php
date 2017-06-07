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

	$sql = "SELECT Product, Category, Number FROM listentries WHERE UserID=1";
	$result = mysqli_query($db_link, $sql);

	if($result != FALSE)
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			?>
				<li class="listelement">
					<div class="listtext"><?php echo $row['Number']?></div>
					<div class="listtext"><?php echo $row['Product']?></div>
					<div style="float:right">
						<a href="removeElement.js"><i class="material-icons md-24">&#xE928;</i></a>
						<a href="numberPlus.js"><i class="material-icons md-24">&#xE145;</i></a>
						<a href="numberMinus.js"><i class="material-icons md-24">&#xE15B;</i></a>
					</div>
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