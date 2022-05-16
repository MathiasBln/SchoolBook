<?php
    require_once 'configuration.php';

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

    <form method="post" class="form2">
        <div class="text-log">
        <h2>Reset password</h2>
        <p>An e-mail will be send to you with instructions on how to reset your password.</p>
        </div>

        <div class="inputs">
        <input type="email" class="form-input" placeholder=" |Enter your email..." name="email" required="required" autocomplete="off">
        
        </div>
        <button type="submit"  class="btn-login">Send me a random password</button>
    </form>
    </div>
    </body>
</html>

    <?php
   if (isset($_POST['email'])) {
       $password = uniqid();
       $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

       $message = "Bonjour, voici votre nouveau mot de passe : $password";
       $headers = 'content-type: text/plain; charset="utf-8"'." ";

       if (mail($_POST['email'], 'Mot de passe oublié', $message, $headers)) {
           $sql = "UPDATE users SET password = ? WHERE email = ?";
           $stmt = $pdo->prepare($sql);
           $stmt->execute([$hashedPassword, $_POST['email']]);
           echo "Mail envoyé";
       } else {
           echo "une erreur es survenue ...";
       }
    }

        



