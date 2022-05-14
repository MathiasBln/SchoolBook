<?php

 /*ecécuter cette ligne dans votre terminal pour intallez phpmailer composer require phpmailer/phpmailer */
  require_once 'configuration.php';
  if(isset($_POST['validate'])){
    if (!empty($_POST['email'])){
        $email = htmlspecialchars($_POST['email']);
        $password = uniqid();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
        // phpmailer qui va permettre d'envoie un mail au users
        function smtpmailer($to, $from, $from_name, $subject, $body){
            $email = htmlspecialchars($_POST['email']);
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true; 
    
            $mail->SMTPSecure = 'ssl'; 
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->Username = 'projetsidibe1@gmail.com';
            $mail->Password = 'Projetsidibe@';   
    
            //   $path = 'reseller.pdf';
            //   $mail->AddAttachment($path);
    
            $mail->IsHTML(true);
            $mail->From="projetsidibe1@gmail.com";
            $mail->FromName=$from_name;
            $mail->Sender=$from;
            $mail->AddReplyTo($from, $from_name);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($to);
        
            if ($mail->Send()) {
                $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
                $stmt->execute([$hashedPassword, $_POST['email']]);
                echo "E-mail envoyé";
            } else {
                echo "Une erreur est survenue";
                var_dump($email);
                
            } 
        
        }
            
        $to = $email;
        $from = 'projetsidibe1@gmail.com';
        $name = 'SchoolBook';
        $subj = 'Recover your password';
        $msg = "Bonjour, voici votre nouveau mot de passe : $password";
            
        $error=smtpmailer($to,$from, $name ,$subj, $msg);
    }
  }
   

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>forget pwd</title>
</head>

<body>
    <h2>Forgot password</h2>
    <form action="forgot_password" method="post">
        <div class="container">
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" required>
            <button type="submit" name="validate">Send me a random password</button>
        </div>
    </form>
</body>

</html>

<!--  $password = uniqid();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $subject = 'Mot de passe oublié';
        $message = "Bonjour, voici votre nouveau mot de passe : $password";
        $headers = 'Content-Type: text/plain; charset="UTF-8"';

        if (mail($_POST['email'], $subject, $message, $headers)) {
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmt->execute([$hashedPassword, $_POST['email']]);
            echo "E-mail envoyé";
        } else {
            echo "Une erreur est survenue";
        } 
    
     $recupUser = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $recupUser->execute(array($email));
        if($recupUser->rowCount()>0){
            $userInfos= $recupUser->fetch();
            $_SESSION['id'] = $userInfos['id'];
    
    
    -->