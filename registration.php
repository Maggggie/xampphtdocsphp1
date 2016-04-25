<?php

	session_start();

	if(isset($_POST['email']))
	{
		  //udana walidacja
		$all_ok=true;

		//sprawdź poprawność nickname'a
		$nick = $_POST['nick'];
		//sprawdzenie długości nicka, pionowe kreski=lub
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
		//Sprawdź poproawność hasła
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];

		if((strlen($pass1)<8)||(strlen($pass1)>20))
		{
			$all_ok=false;
			$_SESSION['e_pass']="Password has to be between 8 and 20 signs!";
		}

		if($pass1!=$pass2)
		{
			$all_ok=false;
			$_SESSION['e_pass']="Passwords you have given, aren't identical!";
		}

		$pass_hash=password_hash($pass1, PASSWORD_DEFAULT);
		//echo $pass_hash; exit();

		//Czy zaakceptowano regulamin?
		if(!isset($_POST['rules']))
		{
			$all_ok=false;
			$_SESSION['e_rules']="Confirm acceptance of the Rules!";
		}
	//Bot or not? Oto jest pytanie!
		$secret="6Lc4dBwTAAAAALEbfJY3P2WSId9rq2V_rJgYNaI2";

		$check=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);

		$reply=json_decode($check);

		if($reply->success==false)
		{
			$all_ok=false;
			$_SESSION['e_bot']="Confirm that you aren't a BOT!";
		}

		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_nick'] = $nick;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_pass1'] = $pass1;
		$_SESSION['fr_pass2'] = $pass2;
		if (isset($_POST['rules'])) $_SESSION['fr_rules'] = true;

		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);

		try
		{
			$connect= new mysqli($host, $db_user, $db_password, $db_name);
			if($connect->connect_errno!=0)
	  		{
	    		throw new Exception(mysqli_connect_errno());
	    	}
	    	else
	    	{
	    		//Czy email już istnieje?
	    		$result=$connect->query("SELECT id FROM users WHERE email='$email'");

	    		if(!$result) throw new Exception($connect->error);

	    		$nr_mail=$result->num_rows;
	    		if($nr_mail>0)
	    		{
	    			$all_ok=false;
					$_SESSION['e_email']="This email address already has an account!";
	    		}
	    		//Czy nick jest już zarezerwowany?
	    		$result=$connect->query("SELECT id FROM users WHERE user='$nick'");

	    		if(!$result) throw new Exception($connect->error);

	    		$nr_nick=$result->num_rows;
	    		if($nr_nick>0)
	    		{
	    			$all_ok=false;
					$_SESSION['e_nick']="This nick already has an account!";
	    		}

				if($all_ok==true)
					{
						//hurra, wszystkie testy zaliczone, dodajemy konto do bazy
						//echo "Thanks for sign in:)"; exit();
						if ($connect->query("INSERT INTO users VALUES (NULL, '$nick', '$pass_hash', '$email', 0, 0, 0, 14)"))
						{
							$_SESSION['udanarejestracja']=true;
							header('Location: hello.php');
						}
						else
						{
							throw new Exception($connect->error);
						}
					}

	    			$connect->close();
	    		}
	  		}
	  		
		catch(Exception $e)
		{
			echo '<span style="color:red">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br /> Informacja developerska:'.$e;
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
</div>

<div id="registr">
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

	<?php
	if(isset($_SESSION['e_pass']))
	{
		echo '<div class="error">'.$_SESSION['e_pass'].'</div>';
		unset($_SESSION['e_pass']);
	}
	?>
	
	Repeat password: <br /><input type="password" name="pass2" /><br />
	
	<label>
		<input type="checkbox" name="rules" /> <a href="rules.php">Accept the rules</a>
	</label>
	
	<?php
	if(isset($_SESSION['e_rules']))
	{
		echo '<div class="error">'.$_SESSION['e_rules'].'</div>';
		unset($_SESSION['e_rules']);
	}
	?>

	<div class="g-recaptcha" data-sitekey="6Lc4dBwTAAAAAF07SNB2OED6_Ro1_KpObxyz7tpj"></div>
	
	<?php
	if(isset($_SESSION['e_bot']))
	{
		echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
		unset($_SESSION['e_bot']);
	}
	?>
	<br />

	<input type="submit" value="Sign in"/>
	
</form>
</div>

<div class="footer">MaggggiaH</div>
</body>
</html>