<?php
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
	$code = mysqli_query($db_link, "SET NAMES utf8");
	$sql = "SELECT id, name, parentId FROM categories";
	$result = mysqli_query($db_link, $sql);

	if($result != FALSE)
	{
		$all = mysqli_fetch_all($result);
		//print_r($all);
		
		$level = 'NULL'; 
		echo makelist($all, 0);

		/*
		while($row = mysqli_fetch_assoc($result)) 
		{
			?>
				<li>
					<a onclick="newItem(this)"><?php echo $row['name']?></a>
				</li>
			<?php
		}
		*/
		
	}
	else
	{
		echo "Query failed";
	}
	mysqli_close($db_link);

	function makelist($array, $level) {
		$r = '';
		foreach( $array as $line) {
			if ($line[2] == $level) {
				$r = $r."<li><a id=\"".$line[0]."\" onclick=\"newItem(this)\">".$line[1]."</a>".makelist($array,$line[0])."</li>\n";
			}
		}
		//$r = $r."</ul>\n";
		return ($r==''?'':"<ul>".$r."</ul>");
	}
?>