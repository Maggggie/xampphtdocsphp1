<?php 
    session_start();

    if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
  {
    header('Location: index.php');
    exit();
  }
    require_once "connect.php";
    
    $connect= @new mysqli($host, $db_user, $db_password, $db_name);
    
    if($connect->connect_errno!=0)
{
    echo "Error: ".$connect->connect_errno;
}
else
{
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $password = htmlentities($password, ENT_QUOTES, "UTF-8");

    if ($result = @$connect->query(
    sprintf("SELECT * FROM users WHERE user='%s' AND pass='%s'",
    mysqli_real_escape_string($connect,$login),
    mysqli_real_escape_string($connect,$password))))
    {
        $nr_users = $result->num_rows;
        if ($nr_users>0)
        {
           $_SESSION['loginto']=true;
           
           $row=$result->fetch_assoc();
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
           
        }else {
            $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
            header('Location: index.php');
        }
    }
    
    $connect->close();
}    
    
    
    ?>