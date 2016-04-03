<?php
session_start();

if(isset($_POST['email']))
{
	  //udana walidacja
	$all_ok=true;

	//sprawdź poprawność nickname'a
	$nick = $_POST['nick'];
	//sprawdzenie długości nicka
	if((strlen($nick)<3)||(strlen($nick)>20))
	{
		$all_ok=false;
		$_SESSION['e_nick']="Nickname has to be between 3 and 20 signs!";
	}

	if(ctype_alnum($nick)==false)
	{
		$all_ok=false;
		$_SESSION['e_nick']="Nickname has to contain letters and numbers (without Polish signs)!";
	}
	//sprawdź poprawność adresu email
	$email=$_POST['email'];
	$emailB=filter_var($email,FILTER_SANITIZE_EMAIL); 

	if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email))
	{
		$all_ok=false;
		$_SESSION['e_email']="Enter a valid email address!";
	}

	if($all_ok==true)
	{
		//hurra, wszystkie testy zaliczone, dodajemy konto do bazy
		echo "Thanks for sign in:)"; exit();
	}
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf8_decode"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>Serwis Design - create free account!</title>
<script src='https://www.google.com/recaptcha/api.js'></script>

<style>
.error
{
	color:red;
	margin-top: 10px;
	margin-bottom: 10px;
}
</style>
</head>
<body>

<form method="post">

	Nickname: <br /><input type="text" name="nick" /><br />

	<?php
	if(isset($_SESSION['e_nick']))
	{
		echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
		unset($_SESSION['e_nick']);
	}
	?>
	
	E-mail: <br /><input type="text" name="email" /><br />

	<?php
	if(isset($_SESSION['e_email']))
	{
		echo '<div class="error">'.$_SESSION['e_email'].'</div>';
		unset($_SESSION['e_email']);
	}
	?>

	Password: <br /><input type="password" name="pass1" /><br />
	
	Repeat password: <br /><input type="password" name="pass2" /><br />
	<label>
		<input type="checkbox" name="rules" /> <a href="rules.php">Accept the rules</a>
	</label>

	<div class="g-recaptcha" data-sitekey="6Lc4dBwTAAAAAF07SNB2OED6_Ro1_KpObxyz7tpj"></div>

	<br />

	<input type="submit" value="Sign in">
	
</form>

</body>
</html>