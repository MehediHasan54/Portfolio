<?php
session_start([
    'cookie_lifetime'=>300
   
]);
// session_destroy();
$_SESSION['loggedin']=0;
// $_GET['logout']='';
$error=false;

$username=filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
$password=filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
$fp=fopen("e:\\xampp\\htdocs\\php\\crud\\data\\user.txt",'r');
if($username && $password){
    $_SESSION['loggedin']=false;
     $_SESSION['user']=false;
     $_SESSION['role']=false;
    while($data=fgetcsv($fp)){
        if($data[0]==$username && $data[1]==sha1($password)){
            $_SESSION['loggedin']=true;
            $_SESSION['user']=$username;
            $_SESSION['role']=$data[2];
            header('location:index.php');
        }
    }
        if(!$_SESSION['loggedin']){
            $error=true;
        }
    }
if(isset($_GET['logout'])){
$_SESSION['loggedin']=false;
$_SESSION['user']=false;
$_SESSION['role']=false;
session_destroy();
header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link rel="stylesheet" href="css/milligram.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="column column-60 column-offset-20">
            <h2>Simple Authentication Form</h2>
            </div>
        </div>
        <div class="row">
            <div class="column column-60 column-offset-20">
                <?php
                  
                if(true==$_SESSION['loggedin']){
                    echo "Hello Hasin, Welcome Home";
                }else{
                    echo "Hello Stranger, Login Below";
                }
                ?>
            </div>
        </div>
      
        <div class="row">
            <div class="column column-60 column-offset-20">
            <?php
        if($error){
       
            echo "<blockquote> UserName or Password Did'nt Match</blockquote>";
        }
        if($_SESSION['loggedin']==false):
            ?>
            <form method="POST">
                    <label for="username">UserName</label>
                    <input type="text" name="username" id="username">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <button type="submit"name="submit">Log in</button>
                </form>
                <?php
                else:
                    ?>
                    
                      <form action="auth.php" method="POST">
                    <input type="hidden" name="logout" value="1">
                    <button type="submit"name="submit">Log out</button>
                </form>
             
                <?php
                endif;
                ?>

            </div>
        </div>
    </div>
</body>
</html>