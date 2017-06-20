<?php require_once 'auth.php';?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/general.css">
<link rel="stylesheet" href="css/deinmarkt.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body onbeforeunload="return checkOnLeave()">

<div class="navbar">
    <ul>
        <li><a href="einkaufszettel.php">Einkaufszettel</a></li><!--
        --><li><a class="active">Dein Markt</a></li><!--
        --><li class="rightAlign"><a href="index.php">Profil</a></li>
    </ul>
</div>
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
			<a class="close" href="index.php">Laden auswählen</a>
		</div>
	</div>
	<?php
}
?>
<!--script src="js/loadShopList.js"></script-->
<script src="js/tracecode.js"></script>
</body>
</html>