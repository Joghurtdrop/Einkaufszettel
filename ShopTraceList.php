<?php
	session_start();
	require_once('dataAccess/dbConfiguration.php');

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
	
	mysqli_query($db_link, "SET NAMES utf8");

	$sql = "SELECT categories.name, categoryId from positions"
		." INNER JOIN categories on (categories.id=positions.categoryId)"
		." WHERE userId="
		.$_SESSION['userId']
		." and shopId="
		.$_SESSION['selectedShopId']
		." and categories.id<>999"
		." ORDER BY position ASC";
	$result = mysqli_query($db_link, $sql);
	
	
	if($result != FALSE)
	{
		$all = mysqli_fetch_all($result);
		//print_r($all);

		foreach ($all as $row)
		{
			?>
				<div class="column" draggable="true" id="<?php echo $row[1]?>"> <?php echo $row[0]?>
					<div onclick="removeItem(this)" class="icon">	
						<i class="material-icons md-18">&#xE92B;			
						</i>			
					</div>
				</div>
			<?php
		}
	}
	mysqli_close($db_link);
?>