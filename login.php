<?php
	session_start();
	
	include 'dataAccess/dataAccessLogin.php';
	include 'dataAccess/dataAccessProfile.php';
	
	if(isset($_GET['login']) && $_GET['login']==1)
	{
		$name=$_POST['name'];
		$password=$_POST['password'];		
		
		if(checkUsername($name) && $userId=checkRegistration($name, $password))
		{
			$_SESSION['userId'] = $userId;
			$_SESSION['selectedShopId']=getSelectedShop($userId)['selectedShop'];
			if($_SESSION['selectedShopId']!=NULL)
			{
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/Einkaufszettel/einkaufszettel.php');				
			}
			else
			{
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/Einkaufszettel');								
			}
		}
		else 
		{
			$errorMessage = "Username oder Passwort ungültig<br>";			 
		}		
	}
	else if(isset($_GET['login']) && $_GET['login']==2)
	{
		if(!checkUsername($_POST['name']))
		{
			$_SESSION['userId']=addUser($_POST['name'],$_POST['password'], $_POST['mail']);
			$_SESSION['selectedShopId']=getSelectedShop($_SESSION['userId'])['selectedShop'];
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/Einkaufszettel');
		}
		else
		{
			$errorMessage="Username ist bereits vergeben";
		}
	}
	
	
?>

<!DOCTYPE html> 
<html> 
<head>
  <title>Login</title> 
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/general.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
</head> 
<body>

<?php
	if(isset($errorMessage))
	{
		echo "<div class=\"field-wrap\">".$errorMessage."</div>";
	}	
?>

<div class="form card">      
      <ul class="tab-group">
        <li class="tab active"><a href="#login">Log In</a></li>
        <li class="tab"><a href="#signup">Sign Up</a></li>
      </ul>      
      <div class="tab-content">
        <div id="login">            
          <form action="?login=1" method="post">          
            <div class="field-wrap">
            <label>Username</label>
            <input type="name" name="name"/>
          </div>          
          <div class="field-wrap">
            <label>Passwort</label>
            <input type="password" name="password"/>
          </div>          
          <p class="forgot"><a href="#">Passwort vergessen?</a></p>
          <button class="button button-block" type="submit"/>Log In</button>          
          </form>
        </div>        
        <div id="signup">           
          <form action="?login=2" method="post">          
          <div class="field-wrap">
            <div class="field-wrap">
              <label>Username</label>
              <input type="text" name="name"/>
            </div>
          </div>
          <div class="field-wrap">
            <label>E-Mail Addresse</label>
            <input type="email" name="mail"/>
          </div>          
          <div class="field-wrap">
            <label>Passwort</label>
            <input type="password" name="password"/>
          </div>          
          <button type="submit" class="button button-block"/>Los geht's</button>          
          </form>
        </div>        
      </div>
</div>
<script src="js/login.js"></script>
</body>
</html>