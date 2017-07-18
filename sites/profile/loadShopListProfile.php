
<?php
	session_start();
	set_include_path($_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel');
	
	include 'dataAccess/dataAccessProfile.php';
	
	$result = getShops($_SESSION['userId']);
	
	if($_SESSION['selectedShopId']!=NULL)
	{		
		$selectedShop = getSelectedShop($_SESSION['userId']);
		?>
		<div id="dd" class="wrapperDropdown" tabindex="1">
			<div style="display:inline-block" id="selectedShop" class="dropbtn"><?php echo $selectedShop['name']?></div>	
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
				<li>					
					<div onClick="setSelectedShop(this)" style="display:inline-block;width:80%;padding-left:20%"><?php echo $row['name']?></div>
					<div onClick="deleteShop(this)" style="float:right;width:20%;display:inline-block">
						<i class="material-icons md-24">&#xE92B;</i>
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
