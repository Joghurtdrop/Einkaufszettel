<?php
	$db_link=mysqli_connect(
	if (!$db_link) 
	$code = mysqli_query($db_link, "SET NAMES utf8");
	if($result != FALSE)
		echo makelist($all, 0);
	mysqli_close($db_link);
	function makelist($array, $level) {