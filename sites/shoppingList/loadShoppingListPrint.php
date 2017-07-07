<?php
	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccessShoppingList.php';
	
	$result = loadList($_SESSION['userId'],$_SESSION['selectedShopId']);

	if($result != FALSE)
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			?>
				<li class="listelement">
					<div class="listnumber"><?php echo $row['number']?></div>
					<div class="listtext"><?php echo $row['pName']?></div>
				</li>
			<?php
		}
	}
	$lostEntries=loadLostListentries($_SESSION['userId'], $_SESSION['selectedShopId']);	
	if($lostEntries!=NULL)
	{
		?>
			<li class="listelement">
				<div class="listtext" style="text-transform:uppercase; font-size: 15px"><?php echo "Fehlende Kategorien:"?></div>
			</li>
		<?php
		while($row = mysqli_fetch_assoc($lostEntries)) 
		{
			?>
				<li class="listelement">
					<div class="listnumber"><?php echo $row['number']?></div>
					<div class="listtext"><?php echo $row['name']?></div>
				</li>
			<?php
		}
	}	
?>