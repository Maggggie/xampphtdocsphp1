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
        
          if ($result = @$connect->query(
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
                   header('Location:serwis.php');
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