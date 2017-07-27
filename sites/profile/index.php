<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/sites/auth.php';?>

<!DOCTYPE html>
<html>
<head>
<title>Profil</title> 
  <link rel="shortcut icon" href="/Einkaufszettel/icon/coolesIcon_64.ico"/>
	<link rel="stylesheet" href="/Einkaufszettel/css/general.css">
	<link rel="stylesheet" href="/Einkaufszettel/css/profil.css">
	<link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php
include 'sites/menubar.php';
?>
<div class="main">
	<h1>Dein Konto</h1>
	<?php echo $login_status;?>
	<div class="row">
		<div class="col-12 row">
			<div class="col-4 label">Füge einen neuen Markt hinzu:</div>
			<input class="col-6" id="newShopName"/>
			<div onClick="addShop()" class="button col-2"/>Okay</div>          
		</div>      
	</div>
	<h1>Dein ausgewählter Markt</h1>
	<div id="listholder"></div>
	</div>
<script src="/Einkaufszettel/js/profil.js"></script>
</body>