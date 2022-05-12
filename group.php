<?php
$dbname = 'db_schoolbook';
$username = 'root';
$password = 'root';

$pdo = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);

$maRequete = $pdo->prepare("SELECT * FROM `groups` WHERE idgroups=1");
$maRequete->execute();
$groups = $maRequete->fetchAll(PDO::FETCH_ASSOC);

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
                    <img src="./assets/thumb_up.svg" alt="bouton like inactif" class="inactive-like">
                    <img src="./assets/thumb_up_active.svg" alt="bouton like actif" class="active-like">
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
            <h1>A propos</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde autem quia sed perferendis possimus quis assumenda incidunt veniam commodi nam placeat vitae reprehenderit sapiente illum, praesentium porro recusandae quibusdam suscipit fugiat nulla aperiam aspernatur. In laboriosam aspernatur perferendis, veritatis labore minus hic voluptatem officia necessitatibus id eligendi non velit et?</p>
        </div>
    </div>
     
        <section class="main-first-section">
        <section class="example-pages-container">
        <article class="example-page">
        <div class="image-circle">
            <img src="./assets/group-logo.svg" class="rounded-circle" alt="logo de la page connexe">
            <div class="first-page-titles">
            <h3><?= $pages[0]["title"]?></h3>
            <h4>When</h4>
            </div>
        </div>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita est neque asperiores nisi.</p>
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
            <h3><?= $pages[1]["title"]?></h3>
            <h4>When</h4>
            </div>
        </div>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Expedita est neque asperiores nisi.</p>
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
