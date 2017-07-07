<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/sites/auth.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccessProfile.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/Einkaufszettel/css/general.css">
	<link rel="stylesheet" href="/Einkaufszettel/css/einkaufszettel.css">
	<link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="main">
  <h1>Dein Einkaufszettel</h1>
  <h3><?php echo date('m/d/Y H:i' ); ?></h3>
  <h4>Dein Laden: <?php echo getSelectedShop($_SESSION['userId'])['name']?> </h4>
  <div><i onClick="printDoc()"class="button material-icons">&#xE8AD;</i></div>
  <div class="card listcontainer">
	<ul id="list">	
	</ul>
  </div>
</div>
<script src="/Einkaufszettel/js/printversion.js"></script>
</body>
</html>