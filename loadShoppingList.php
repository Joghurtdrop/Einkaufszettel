<?php
	session_start();
	include 'dataAccess/dataAccessShoppingList.php';
	
	$result = loadList($_SESSION['userId'],$_SESSION['selectedShopId']);

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
?>