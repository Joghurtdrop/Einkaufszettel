<?php require_once 'auth.php';?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/general.css">
</head>
<body>

<div class="navbar">
	<ul>
		<li><a href="einkaufszettel.html">Einkaufszettel</a></li><!--
	 --><li><a href="deinmarkt.html">Dein Markt</a></li><!--
	 --><li class="rightAlign active"><a>Profil</a></li>
	</ul>
</div>

<div class="main">
  <h1>Überschrift</h1>
  <?php echo $login_status;?>
 
</div>

</body>