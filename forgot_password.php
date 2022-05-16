 <?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

    require_once 'configuration.php';

?>

<!-- ---------------------------------------------------------- -->
<?php session_start() ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="./css/style-index.css">

    <title>SchooBook</title>
</head>
<body>

<div class="login-form">

    <form action="" method="POST" name="recover_psw" class="form2">
        <div class="text-log">
        <h2>Recovery password</h2>
        <p>An e-mail will be send to you with instructions on how to reset your password.</p>
        </div>

        <div class="inputs">
            <input type="text" class="form-input" placeholder=" |Enter your email..." class="form-control" name="email" required autofocus>
        
        </div>
        <input type="submit" class="btn-login" value="Recover" name="recover">
    </form>
    </div>

</body>
</html>

<?php 
    if(isset($_POST["recover"])){
        /* include('configuration.php'); */
        require_once 'configuration.php'; // On inclut la connexion à la base de données

        $email = $_POST["email"];
        $mysqli = mysqli_connect('localhost', 'root', 'root', 'db_schoolbook');
        $sql = mysqli_query($mysqli, "SELECT * FROM users WHERE email='$email'");
        
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if($query <= 0){
            ?>
            <script>
                alert("<?php  echo "Sorry, no emails exists "?>");
            </script>
            <?php
        }else{
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            //session_start ();
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            require "vendor/autoload.php";

            $mail = new PHPMailer(true);
            $mail->IsSMTP();
            $mail->Mailer = 'smtp';
            $mail->SMTPDebug = 1;
            //le probleme était au niveau de php, dans la nouvelle version, PHP a implémenté un comportement SSL plus strict qui a cause ce problème de SMTP. c'est pourquoi on ajoute ces lignes on créé un tableau avec notre ssl
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
                );
    
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure='tls';
            
            // h-hotel account
            $mail->Username='projetsidibe1@gmail.com';
            $mail->Password='Projetsidibe@';

            // send by h-hotel email
            $mail->setFrom('projetsidibe1@gmail.com', 'Password Reset');
            // get email from input
            $mail->addAddress($_POST["email"]);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Recover your password";
            $mail->Body="<b>Dear User</b>
            <h3>We received a request to reset your password.</h3>
            <p>Kindly click the below link to reset your password</p>
            http://localhost/schoolbook/reset_psw.php
            <br><br>
            <p>With regrads,</p>
            <b>SchoolBook</b>";

            if(!$mail->send()){
                ?>
                    <script>
                        alert("<?php echo " Invalid Email "?>");
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        window.location.replace("index.php");
                    </script>
                <?php
            }
        }
    }


?>







        



