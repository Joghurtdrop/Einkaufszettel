<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/sites/auth.php';
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="/Einkaufszettel/icon/coolesIcon_64.ico"/>
	<meta http-equiv="Content-Type" content="text/html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/Einkaufszettel/css/general.css">
	<link rel="stylesheet" href="/Einkaufszettel/css/einkaufszettel.css">
	<link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php
include '/sites/menubar.php';
?>
<div class="main mainWithBaseboard">
  <h1>Dein Einkaufszettel</h1>
  <div><i onClick="openPrint()" class="button material-icons">&#xE8AD;</i></div>
  <div class="card listcontainer">
	<ul id="list">	
	</ul>
  </div>
</div>
<div class="baseboard">
	<div class="contentDesktop">
		<div class="col-1 mobileInvisible baseboardElement">
		</div>
		<div class="col-5 baseboardElement">
			<div class="tooltip numberInput">
				<div class="tooltiptext">Anzahl</div>
				<input class="Input" id="numberInput" type="text" maxlength="4" oninput="this.value=this.value.replace(/([^0-9]+)/,'');"></input>
			</div>
			<div class="tooltip productNameInput">
				<div class="tooltiptext">Artikel</div>	
				<input class="Input" id="productNameInput" oninput="this.value=this.value.replace(/[<]|[>]/,'')" title="test"></input>
			</div>	
		</div>
		<div class="col-5 categoryList">
			<ul>
				<li><div id="selectedCategory">keine Kategorie</div> 
					<div class="hiddenField" id="selectedCategoryId">0</div>
					<ul class="dropup" id="categories">
					</ul>
				</li>
			</ul>
		</div>
		<div class="tooltip baseboardElement col-1">
			<div id="tooltipAddButton">Ungültige Eingabe</div>
			<div id="addButton" class="not-active" onClick="addEntry()" color="white">
				<i class="material-icons md-30">&#xE854;</i>
			</div>
		</div>
	</div>
</div>
<?php
if($_SESSION['selectedShopId']==NULL)
{
	?>
	<div class="overlay">
		<div class="popup card">
			<h2>Achtung!</h2>
			<div class="content">Du hast noch keinen Laden ausgewählt</div>
			<a class="close" href="/Einkaufszettel/sites/profile">Laden auswählen</a>
		</div>
	</div>
	<?php
}
?>
<script src="/Einkaufszettel/js/shoppinglist.js"></script>
</body>
</html>
