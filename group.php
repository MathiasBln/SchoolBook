<?php
require('./requests_homegpe.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="groupe.css" type="text/css">
    <link rel="stylesheet" href="css/footer.css" type="text/css">
    <link rel="stylesheet" href="css/header.css" type="text/css">
    <!-- Google font icone "like" -->
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Bootstrap nav-bar style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Icone from fontawesome -->
    <script src="https://kit.fontawesome.com/8e346a8501.js" crossorigin="anonymous"></script>
    <title><?= $groups[0]["name"] ?></title>
</head>
<body> 
<?php require('./partials/header.php'); ?>
<?php require('./navigation_gpe.php'); ?>

<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#"> <?= $groups[0]["name"] ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active nav-link-gpe" aria-current="page" href="#">Accueil</a>
                    <a class="nav-link nav-link-gpe" href="#">Invitez vos amis</a>
                    <a class="nav-link nav-link-gpe" href="./members.php?idgpe=<?= $groups[0]["idgroups"]?>">Membres du groupe</a>
                </div>
            </div>
        </div>
    </nav>
</section>

    <main>
    <div class="container">
     <div class="a-propos-groupe">
            <h1>Nous connaître :</h1>
            <p><?= $groups[0]["description"]?></p>
        </div>
    </div>
     
        <section class="main-first-section-gpe">
        <section class="example-pages-container-gpe">
        <article class="example-page-gpe">
        <div class="image-circle-gpe">
            <img src="./assets/group-logo.svg" class="rounded-circle" alt="logo de la page connexe">
            <div class="first-page-titles-gpe">
            <h3>Post n°</h3>
            <h4></h4>
            </div>
        </div>
        <p></p>
        <div class="example-page-image-container-gpe">
            <div class="example-page-image-gpe"></div>
        </div>
        <div class="sharing-icons-container-gpe">
            <img src="./assets/favorite_FILL0.svg" alt="Like" class="first-page-heart-inactive-gpe">
            <img src="./assets/favorite_FILL1.svg" alt="Like" class="first-page-heart-active-gpe">
            <img src="./assets/chat_bubble.svg" alt="Comment">
            <img src="./assets/share.svg" alt="Share">
        </div>
        </article>

        <article class="example-page-gpe">
        <div class="image-circle-gpe">
            <img src="./assets/group-logo.svg" class="rounded-circle" alt="logo de la page connexe">
            <div class="first-page-titles-gpe">
            <h3></h3>
            <h4></h4>
            </div>
        </div>
        <p></p>
        <div class="example-page-image-container-gpe">
            <div class="example-page-image-gpe"></div>
        </div>
        <div class="sharing-icons-container-gpe">
            <img src="./assets/favorite_FILL0.svg" alt="Like" class="first-page-heart-inactive-gpe">
            <img src="./assets/favorite_FILL1.svg" alt="Like" class="first-page-heart-active-gpe">
            <img src="./assets/chat_bubble.svg" alt="Comment">
            <img src="./assets/share.svg" alt="Share">
        </div>
        </article>
        </section>
    </section>
</main>

<?php require('partials/footer.php'); ?>
</body>
</html>
