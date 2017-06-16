<?php
	session_start();
	
	include 'dataAccess/dataAccessLogin.php';
	
	if(isset($_GET['login']))
	{
		$name=$_POST['name'];
		$password=$_POST['password'];		
		
		if(checkUsername($name) && $user=checkRegistration($name, $password))
		{
			$_SESSION['userid'] = $user;
			die('Login erfolgreich. Weiter zu <a href="index.php">internen Bereich</a>');
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
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/general.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
</head> 
<body>

<?php
	if(isset($errorMessage))
	{
		echo $errorMessage;
	}	
?>

<div class="form card">      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for Free</h1>          
          <form action="/" method="post">          
          <div class="field-wrap">
            <div class="field-wrap">
              <label>Username</label>
              <input type="text"/>
            </div>
          </div>
          <div class="field-wrap">
            <label>Email Address</label>
            <input type="email"/>
          </div>          
          <div class="field-wrap">
            <label>Set A Password</label>
            <input type="password"/>
          </div>          
          <button type="submit" class="button button-block"/>Get Started</button>          
          </form>
        </div>        
        <div id="login">   
          <h1>Welcome Back!</h1>          
          <form action="?login=1" method="post">          
            <div class="field-wrap">
            <label>Username</label>
            <input type="name" name="name"/>
          </div>          
          <div class="field-wrap">
            <label>Password</label>
            <input type="password" name="password"/>
          </div>          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          <button class="button button-block" type="submit"/>Log In</button>          
          </form>
        </div>        
      </div>
</div>
<script src="js/login.js"></script>
</body>
</html>