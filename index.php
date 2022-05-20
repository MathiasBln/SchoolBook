<?php
require 'includes/init.php';
// IF USER MAKING LOGIN REQUEST
if(isset($_POST['email']) && isset($_POST['password'])){
  $result = $user_obj->loginUser($_POST['email'],$_POST['password']);
}
// IF USER ALREADY LOGGED IN
if(isset($_SESSION['email'])){
  header('Location: home.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style-index.css">
    <title>SchoolBook</title>
</head>
<body>
    <div class="login-form">
    <?php 
                if(isset($_GET['login_err']))
                {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {
                        case 'password':
                        ?>
                            <div class="alert">
                                <p>Error Password incorrect <a href="index.php"> sign in again</a></p> 
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Error</strong> email incorrect
                            </div>
                        <?php
                        break;

                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Error</strong> this account does not exist
                            </div>
                        <?php
                        break;
                    }
                }
                ?> 




        <form action="register.php" class="form1">
            <h1>SchoolBook</h1>
            <img src="./images/booking-removebg-preview.png" alt="">
            <p>I guess you are new account here. You can start using the application after sign up !</p>
            <div class="btn-sign">
                <button type="submit" class="up">Register</button>
                <button class="in">Sign In</button>
            </div>
        </form>

        <form action="" method="post" class="form2">
            <div class="text-log">
            <h2>Hello again</h2>
            <p>I'm happy to see you again !</p>
            </div>
            
            <div class="inputs">
            <input type="email" class="form-input" id="email" placeholder="| Email" name="email" required="required" autocomplete="off">
            <input type="password" class="form-input" id="password" placeholder="| Password" name="password" required="required" autocomplete="off">
            <a href="forgot_password.php">forget password?</a>
            </div>
            <input type="submit" class="btn-login" value="Sign In"/>
        </form>
        

    </div>
    </body>
</html>

