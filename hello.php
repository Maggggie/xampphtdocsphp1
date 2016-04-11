<?php

	session_start();
	
	if (!isset($_SESSION['udanarejestracja']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}
	
	//Usuwanie zmiennych pamiętających wartości wpisane do formularza
	if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
	if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_pass1'])) unset($_SESSION['fr_pass1']);
	if (isset($_SESSION['fr_pass2'])) unset($_SESSION['fr_pass2']);
	if (isset($_SESSION['fr_rules'])) unset($_SESSION['fr_rules']);
	
	//Usuwanie błędów rejestracji
	if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if (isset($_SESSION['e_pass'])) unset($_SESSION['e_pass']);
	if (isset($_SESSION['e_rules'])) unset($_SESSION['e_rules']);
	if (isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Serwis Design</title>
</head>

<body>
	
	Thanks for sign in:)<br />
	You can log into your account!<br /><br />
	
	<a href="index.php">Log in!</a>
	<br /><br />

</body>
</html>