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
</head>
<body>
<?php
echo"<p>Hello ".$_SESSION['user'].'![ <a href="logout.php">Log out!</a>]</p>';
echo "<p><b>Comments</b>: ".$_SESSION['comments'];
echo "| <b>Likes</b>: ".$_SESSION['likes'];
echo "| <b>Dislikes</b>: ".$_SESSION['dislikes']."</p>";

echo "<p><b>Email</b>: ".$_SESSION['email'];
echo "<br /><b>Dni premium</b>: ".$_SESSION['dnipremium']."</p>";

?>
</body>
</html>