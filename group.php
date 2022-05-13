<?php
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$dbname = 'db_schoolbook';
$username = 'root';
$password = 'root';

$pdo = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
# Pkoi pas de ; à la fin de la requête sql ici ?
# 1ère vérification : la requête sort bien un résultat limité ici à 2 rows (car sinon c 500 rows !!).
$maRequete = $pdo->prepare("SELECT * FROM `groups`, `users`, `groups_has_users`, `posts`, `comments` 
                            WHERE groups_has_users.groups_idgroups = 10
                            AND groups_has_users.users_iduser = iduser
                            AND posts.groups_idgroups = 10
                            AND posts.idposts = idposts
                            LIMIT 2");

$maRequete->execute();
$groups = $maRequete->fetchAll(PDO::FETCH_ASSOC);

// var_dump($groups[0]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <!-- Google font icone "like" -->
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Bootstrap nav-bar style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/8e346a8501.js" crossorigin="anonymous"></script>
    <title><?= $groups[0]["name"] ?></title>
</head>
<body>
    
    <header>
        <section class="banner">
        <div class="banner-image"></div>
        </section>

        <div class="container">
            <section class="group-profil">
                <div class="image-circle">
                    <img src="./assets/group-logo.svg" class="rounded-circle" alt="group logo">
                </div>
                <div class="like-icon">
                    <button id="btn-like" class="bg-transparent border-0 text-secondary" type="button">
                    <i class="fa-solid fa-color fa-thumbs-up fa-2xl"></i>
                    </button>
                    <h3>J'aime</h3>
                </div> 
            </section>
        </div>

        <!-- Bootstrap nav bar -->

      <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="#"> <?= $groups[0]["name"] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="#">Accueil</a>
            <a class="nav-link" href="#">Invitez vos amis</a>
            <a class="nav-link">Membres</a>
        </div>
        </div>
    </div>
    </nav>
    </header>
    <main>
    <div class="container">
     <div class="a-propos-groupe">
            <h1>Nous connaître :</h1>
            <p><?= $groups[0]["description"]?></p>
        </div>
    </div>
     
        <section class="main-first-section">
        <section class="example-pages-container">
        <article class="example-page">
        <div class="image-circle">
            <img src="./assets/group-logo.svg" class="rounded-circle" alt="logo de la page connexe">
            <div class="first-page-titles">
            <h3>Post n° <?=$groups[0]["idposts"]?></h3>
            <h4><?= $groups[0]["date_publish"]?></h4>
            </div>
        </div>
        <p><?= $groups[0]["content"]?></p>
        <div class="example-page-image-container">
            <div class="example-page-image"></div>
        </div>
        <div class="sharing-icons-container">
            <img src="./assets/favorite_FILL0.svg" alt="Like" class="first-page-heart-inactive">
            <img src="./assets/favorite_FILL1.svg" alt="Like" class="first-page-heart-active">
            <img src="./assets/chat_bubble.svg" alt="Comment">
            <img src="./assets/share.svg" alt="Share">
        </div>
        </article>

        <article class="example-page">
        <div class="image-circle">
            <img src="./assets/group-logo.svg" class="rounded-circle" alt="logo de la page connexe">
            <div class="first-page-titles">
            <h3><?= $groups[1]["idposts"]?></h3>
            <h4><?= $groups[1]["date_publish"]?></h4>
            </div>
        </div>
        <p><?=$groups[1]["content"]?></p>
        <div class="example-page-image-container">
            <div class="example-page-image"></div>
        </div>
        <div class="sharing-icons-container">
            <img src="./assets/favorite_FILL0.svg" alt="Like" class="first-page-heart-inactive">
            <img src="./assets/favorite_FILL1.svg" alt="Like" class="first-page-heart-active">
            <img src="./assets/chat_bubble.svg" alt="Comment">
            <img src="./assets/share.svg" alt="Share">
        </div>
        </article>
        </section>
    </section>
</main>

</body>
</html>
