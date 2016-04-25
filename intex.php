<?php

	session_start();

	if((isset($_SESSION['loginto']))&&($_SESSION['loginto']==true))
	{
	    header('Location: serwis.php');
	    exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf8_decode"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>Serwis Design</title>
<link rel="stylesheet" href="style.css" type="text/css"/>
</head>

<body>

<div id="container">

	<div id="logo">
		<img src="eikopeiko3.png"/>
	</div>
	<div id="topbarmenu">
		<div class="option">Home</div>
		<div class="option">Your adds</div>
		<div class="option">Your likes</div>
		<div class="option">Task To Do</div>
		<div class="option">About me</div>
		<div style="clear:both"></div>
	</div>
		
	<div id="topbarmenu">
</div>

<div id="bigtitle">If you like awesome things.</div><br/><br/> 

<a href="registration.php">Registration - create free account!</a>
<br /><br />

<form action="login.php" method="post">
	Login:      <br/><input type="text" name="login" /><br/>
	Password:   <br/><input type="password" name="password" /><br /><br />
	<input type="submit" value="Log in" />
</form>
    
<?php
    if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>
<div class="footer">MaggggiaH</div>
</body>
</html>