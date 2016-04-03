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
</head>
<body>
If you like awesome things.<br/><br/> 

<a href="registration.php">Registration - create free account!</a>
<br /><br />

    <form action="login.php" method="post">
        Login:      <br/><input type="text" name="login"/><br/>
        Password:   <br/><input type="password" name="password"/><br /><br />
        <input type="submit" value="Log in"/>
    </form>
    
<?php
    if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>
</body>
</html>