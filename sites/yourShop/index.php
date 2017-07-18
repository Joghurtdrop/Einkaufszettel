<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/sites/auth.php';?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="/Einkaufszettel/icon/coolesIcon_64.ico"/>
	<link rel="stylesheet" href="/Einkaufszettel/css/general.css">
	<link rel="stylesheet" href="/Einkaufszettel/css/deinmarkt.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php
include 'sites/menubar.php';
?>
<div class="row">

    <div class="main col-10 vertinav">
        <h1>Dein Markt</h1>
        <h2>Trage hier deinen Einkaufsweg durch den Laden ein.</h2>


        <div id="trace" class="card middlerow">
        </div>
    </div>
	
    <nav id="verticallist" class="vertical col-2">
    </nav>

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
<!--script src="js/loadShopList.js"></script-->
<script src="/Einkaufszettel/js/tracecode.js"></script>
</body>
</html>
