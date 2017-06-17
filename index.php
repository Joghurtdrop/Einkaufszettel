<?php require_once 'auth.php';?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/general.css">
	<link rel="stylesheet" href="css/profil.css">
	<link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="navbar">
	<ul>
		<li><a href="einkaufszettel.php">Einkaufszettel</a></li><!--
	 --><li><a href="deinmarkt.php">Dein Markt</a></li><!--
	 --><li class="rightAlign active"><a>Profil</a></li>
	</ul>
</div>

<div class="main">
	<h1>Dein Konto</h1>
	<?php echo $login_status;?>
	<h1>Dein ausgewählter Markt</h1>
	<div id="dd" class="wrapperDropdown" tabindex="1">
		<div id="selectedShop" class="dropbtn">Kein Markt</div>	
		<div id="selectedShopId" class="hiddenField">0</div>
		<ul id="shopList" class="dropdown"></ul>
	</div>
</div>

<script src="js/profil.js"></script>
</body>