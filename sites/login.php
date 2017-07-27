<?php
	session_start();
	
	include $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccessLogin.php';
	include $_SERVER['DOCUMENT_ROOT'].'/Einkaufszettel/dataAccess/dataAccessProfile.php';
	
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
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/Einkaufszettel/sites/shoppingList');				
			}
			else
			{
				header('Location: http://'.$_SERVER['HTTP_HOST'].'/Einkaufszettel/sites/profile');								
			}
		}
		else 
		{
			$errorMessage = "Username oder Passwort ungültig";			 
		}		
	}
	else if(isset($_GET['login']) && $_GET['login']==2)
	{
		if(!checkUsername($_POST['name']))
		{
			$_SESSION['userId']=addUser($_POST['name'],$_POST['password'], $_POST['mail']);
			$_SESSION['selectedShopId']=getSelectedShop($_SESSION['userId'])['selectedShop'];
			header('Location: http://'.$_SERVER['HTTP_HOST'].'/Einkaufszettel/sites/profile');
		}
		else
		{
			$errorMessage="Username ist bereits vergeben";
		}
	} else if(isset($_GET['login']) && $_GET['login']==3)
	{
		if($password=getPassIfMailExists($_POST['mail'],$_POST['name']))
		{
			
			$nachricht = "Hallo ".$_POST['name'].",\n"
						."\n"
						."dein bei uns hinterlegtes Passwort ist: \""
						.$password."\".\n"
						."\n"
						."Mit freundlichen Grüßen\n"
						."Dein Einkaufszettel Team";

			$header = 'From: noreply@deinzettel.de'."\r\n" 
					 .'Reply-To: noreply@deinzettel.de'."\r\n"
					 .'X-Mailer: PHP/'.phpversion();
			// Falls eine Zeile der Nachricht mehr als 70 Zeichen enthälten könnte,
			// sollte wordwrap() benutzt werden
			$nachricht = wordwrap($nachricht, 70);

			// Send
			mail($_POST['mail'], 'Einkaufszettel: Password Recovery', $nachricht, $header);
			//header('Location: http://'.$_SERVER['HTTP_HOST'].'/Einkaufszettel/sites/login.php');
		} 
		else
		{
		  $errorMessage = "Kombination aus Username und E-Mail-Addresse nicht gefunden!";
		}
	}
	
	
?>

<!DOCTYPE html> 
<html> 
<head>
  <title>Login</title> 
  <link rel="shortcut icon" href="/Einkaufszettel/icon/coolesIcon_64.ico" />
  <link rel="stylesheet" href="/Einkaufszettel/css/login.css">
  <link rel="stylesheet" href="/Einkaufszettel/css/general.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
</head> 
<body>

<?php
	if(isset($errorMessage))
	{
		echo "<script type='text/javascript'>alert('".$errorMessage."');window.location='/Einkaufszettel/sites/login.php'</script>";
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
            <input type="name" name="name" placeholder="Username"/>
          </div>          
          <div class="field-wrap">
            <input type="password" placeholder="Passwort" name="password"/>
          </div>          
          <p class="forgot"><a href="#" onclick="openForgotPw()">Passwort vergessen?</a></p>
          <button class="button button-block" type="submit"/>Log In</button>          
          </form>
        </div>        
        <div id="signup">           
          <form action="?login=2" method="post">          
          <div class="field-wrap">
            <div class="field-wrap">
              <input type="text" name="name" placeholder="Username"/>
            </div>
          </div>
          <div class="field-wrap">
            <input type="text" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" name="mail" placeholder="E-Mail-Addresse"/>
          </div>          
          <div class="field-wrap">
            <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Passwort" title="Mindestens 8 Zeichen, die einen Groß- und Kleinbuchstaben und eine Zahl enthalten." name="password"/>
          </div>          
          <button type="submit" class="button button-block"/>Los geht's</button>          
          </form>
        </div>        
      </div>
	  
	  <div id="forgotpw" class="overlay hiddenField">
		<div class="popup card">
			<form action="?login=3" method="post"> 
			<div class="field-wrap">
				<input type="text" name="name" placeholder="Username"/>
            </div>  
			<div class="content field-wrap">
				<input type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="mail"placeholder="E-Mail-Addresse"/>
			</div>
			<button type="submit" class="button button-block">OK<button>
			<button type="button" class="button button-block" onclick="closeForgotPw()">NOPE<button>
		</div>
	</div>
</div>
<script src="/Einkaufszettel/js/login.js"></script>
</body>
</html>
