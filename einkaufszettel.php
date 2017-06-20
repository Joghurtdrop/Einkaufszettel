<?php 
	require_once 'auth.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/general.css">
	<link rel="stylesheet" href="css/einkaufszettel.css">
	<link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<div class="navbar">
	<ul>
		<li><a class="active">Einkaufszettel</a></li><!--
	 --><li><a href="deinmarkt.php">Dein Markt</a></li><!--
	 --><li class="rightAlign"><a href="index.php">Profil</a></li>
	</ul>
</div>


<div class="main mainWithBaseboard">
  <h1>Dein Einkaufszettel</h1>
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
			<input class="articleInput" id="numberInput" type="number" min="1"></input>
			<input class="articleInput" id="productNameInput" type="text"></input>
		</div>	
		<div class="col-5 categoryList">
			<ul>
				<li><div id="selectedCategory">Katergorie:</div> 
					<div class="hiddenField" id="selectedCategoryId">0</div>
					<ul class="dropup" id="categories">
					</ul>
				</li>
			</ul>
		</div>
		<div class="col-1 baseboardElement">
			<a onClick="addEntry()" color="white"><i class="material-icons md-30">&#xE854;</i></a>
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
			<a class="close" href="index.php">Laden auswählen</a>
		</div>
	</div>
	<?php
}
?>
<script src="js/shoppinglist.js"></script>
</body>
</html>