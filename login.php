<?php
	session_start();
	
	include 'dataAccess.php';
	
	if(isset($_GET['login']))
	{
		$name=$_POST['name'];
		$password=$_POST['password'];		
		
		if(checkUsername($name) && checkRegistration($name, $password))
		{
			$_SESSION['userid'] = $user['id'];
			die('Login erfolgreich. Weiter zu <a href="profil.html">internen Bereich</a>');
		}
		else 
		{
			$errorMessage = "Username oder Passwort war ungültig<br>";			 
		}		
	}
	
	
?>

<!DOCTYPE html> 
<html> 
<head>
  <title>Login</title> 
</head> 
<body>

<?php
	if(isset($errorMessage))
	{
		echo $errorMessage;
	}	
?>

<form action="?login=1" method="post">User name:<br>
	<input type="name" size="40" maxlength="250" name="name"><br><br>Dein Passwort:<br>
	<input type="password" size="40"  maxlength="250" name="password"><br>
	<input type="submit" value="Abschicken">
</form> 
</body>
</html>