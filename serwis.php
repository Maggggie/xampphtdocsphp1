<?php

	session_start();

	if (!isset($_SESSION['loginto']))
	{
		header('Location: index.php');
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
	
<?php
echo"<p>Hello ".$_SESSION['user'].'![ <a href="logout.php">Log out!</a>]</p>';
echo "<p><b>Comments</b>: ".$_SESSION['comments'];
echo "| <b>Likes</b>: ".$_SESSION['likes'];
echo "| <b>Dislikes</b>: ".$_SESSION['dislikes']."</p>";

echo "<p><b>Email</b>: ".$_SESSION['email'];
echo "<br /><b>Dni premium</b>: ".$_SESSION['dnipremium']."</p>";

?>
<div class="footer">MaggggiaH</div>
</body>
</html>