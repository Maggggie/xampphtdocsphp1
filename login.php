<?php 
    
    session_start();

    if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
    {
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";
    
    //$connect= @new mysqli($host, $db_user, $db_password, $db_name);
    //if($connect->connect_errno!=0)

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
          $login = $_POST['login'];
          $password = $_POST['password'];
          
          $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        
          if ($result = $connect->query(
          sprintf("SELECT * FROM users WHERE user='%s'",
          mysqli_real_escape_string($connect,$login))))
          {
              $nr_users = $result->num_rows;
              if ($nr_users>0)
              {
                $row=$result->fetch_assoc();

                if(password_verify($password, $row['pass']))
                {
                   $_SESSION['loginto']=true;
                   $_SESSION['id']=$row['id'];
                   $_SESSION['user']=$row['user'];
                   $_SESSION['comments']=$row['comments'];
                   $_SESSION['likes']=$row['likes'];
                   $_SESSION['dislikes']=$row['dislikes'];
                   $_SESSION['email']=$row['email'];
                   $_SESSION['dnipremium']=$row['dnipremium'];
                  
                   unset($_SESSION['blad']);
                   $result->free_result();
                   header('Location: serwis.php');
                }
                else 
                {
                  $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                  header('Location: index.php');
                }
              }
              else 
              {
                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: index.php');
              }
            }
            else
            {
              throw new Exception($connect->error);
            }  
    
            $connect->close();
        }}
        catch(Exception $e)
        {
          echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o wizytę w innym terminie!</span>';
          echo '<br />Informacja developerska: '.$e;
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

  <div id="bigtitle">Hello</div>
</div>
<div class="footer">MaggggiaH</div>
</body>
</html>