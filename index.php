<?php require('partials/header.php'); ?>

    <div class="login-form">


    <?php 
                if(isset($_GET['login_err']))
                {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {
                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Error</strong> Password incorrect
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
            <p>Discovery Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
            <div class="btn-sign">
                <button type="submit" class="up">Register</button>
                <button class="in">Sign In</button>
            </div>
        </form>

        <form action="login.php" method="post" class="form2">
            <div class="text-log">
            <h2>Hello again</h2>
            <p>Welcome Back you've been missed!</p>
            </div>
            
            <div class="inputs">
            <input type="email" class="form-input" placeholder="| Email" name="email" required="required" autocomplete="off">
            <input type="password" class="form-input" placeholder="| Password" name="password" required="required" autocomplete="off">
            <a href="">forget password?</a>
            </div>
            <button type="submit" class="btn-login">Sign In</button>
        </form>
        

    </div>
    <?php require('partials/footer.php'); ?>
