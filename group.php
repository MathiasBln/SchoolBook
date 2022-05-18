<?php
require('./includes/pdo.php');
require('./includes/requests_homegpe.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/groupe.css" type="text/css">
    <link rel="stylesheet" href="css/footer.css" type="text/css">
    <link rel="stylesheet" href="css/header.css" type="text/css">
    <!-- Bootstrap nav-bar style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
    <title><?= $groups[0]["name"] ?></title>
</head>
<body> 
<?php require('./partials/header.php'); ?>
<?php require('./partials/navigation_gpe.php'); ?>

    <main>
  
        <section class="main-first-section-gpe container">
            <h2>Nos pages: </h2>
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
