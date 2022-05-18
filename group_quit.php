<?php 
require('./includes/pdo.php');
require('./includes/requests_homegpe.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/invite_gpe.css" type="text/css">
    <link rel="stylesheet" href="css/groupe.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title> Nous quitter </title>
</head>
<body>
<?php require('./partials/header.php'); ?>
<!-- <?php require('./partials/navigation_gpe.php'); ?> -->

<main>
    <section class="container container-gpe">

            <div class="card mt-5" style="width: 50vw;">
                <img src="assets/1-logo.svg" class="card-img-top" style="height:10vh; width:100%;" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Un petit mot avant de se quitter...</h5>
                    <p class="card-text">Nous vous remercions pour l'intérêt porté à ce groupe.</p>
                    <a href="./home.php" class="btn btn-primary">Revenir à l'accueil</a>
                </div>
            </div>

    </section>
</main>