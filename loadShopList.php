<?php
	session_start();
	include 'dataAccess/dataAccessLogin.php';
	
	$result = getShops($_SESSION['userId']);

	if($result != FALSE)
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			?>
				<li onClick="setSelectedShop(this)">					
					<div><?php echo $row['name']?></div>
					<div style="float:right">
						<i class="material-icons md-24">&#xE8B8;</i>
					</div>
					<div class="hiddenField"><?php echo $row['id']?></div>
				</li>
			<?php
		}
	}
?>