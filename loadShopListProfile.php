
<?php
	session_start();
	include 'dataAccess/dataAccessProfile.php';
	
	$result = getShops($_SESSION['userId']);
	$selectedShop = getSelectedShop($_SESSION['userId']);
	
	if($selectedShop['selectedShop']!=NULL)
	{
		?>
		<div id="dd" class="wrapperDropdown" tabindex="1">
			<div id="selectedShop" class="dropbtn"><?php echo $selectedShop['name']?></div>	
			<div id="selectedShopId" class="hiddenField"><?php echo $selectedShop['selectedShop']?></div>
			<ul id="shopList" class="dropdown">
		<?php
	}
	
	else
	{
		?>
		<div id="dd" class="wrapperDropdown" tabindex="1">
			<div id="selectedShop" class="dropbtn">Kein Markt</div>	
			<div id="selectedShopId" class="hiddenField">0</div>
			<ul id="shopList" class="dropdown">
		<?php
	}

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
	
	?></ul>
	</div>
	<?php
?>