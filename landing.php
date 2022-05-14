<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/landing.css">
    <!-- Bootstrap CSS -->
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>profil design</title>
</head>
<body>

<div class="contain-profil">
    <div class="info-profil">
        
        <div class="img-avatar"></div>
        <div class="content-user">
            <ul class="contact-user">
                <li class="name">Prenom NOM</li>
                <li>user98@gmail.com</li>
                <li>name school</li>
            </ul>
            <ul class="edit-user">
                <li class="editer-txt">Edit profil</li>
                <li><a href="#">Change avatar</a></li>  
                <li> <a href="#">Change password</a></li>
            </ul>
        </div>
    </div>
    <div class="content-profil">
        <?php require('partials/header.php'); ?>

        <h1>Welcome Laura !</h1>
        <p>this is your overall social media development</p>
    </div>
</div>
    
    

<div class="text-center">
                    
                    <h1 class="p-5">Bonjour <?php echo $data['name']; ?> !</h1>
                    
                    <?php
                    if(isset($_SESSION['avatar'])){
                    ?>
                    <div style="margin: 10px 0">
                        <div style="background: url(<?= 'upload/' . $_SESSION['user'] . '/' . $_SESSION['avatar']?>) no-repeat center; background-size: cover; width: 150px; height: 150px"></div>
                    </div>
                    <?php
                        }
                    ?>

                    <hr />
                    <a href="logout.php" class="btn btn-danger btn-lg">Déconnexion</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#change_password">
                      Changer mon mot de passe
                    </button>

                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#avatar">
                      ajouter un avatar
                    </button>
            </div>
</body>
</html>