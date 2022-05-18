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
    <link rel="stylesheet" href="css/groupe.css" type="text/css">
    <link rel="stylesheet" href="css/footer.css" type="text/css">
    <link rel="stylesheet" href="css/header.css" type="text/css">
    <!-- Google font icone "like" -->
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Bootstrap nav-bar style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
    <title>Membres du groupe <?= $array_group_name[0] ?></title>
</head>
<body>

<?php require('./partials/header.php'); ?>
<?php require('./partials/navigation_gpe.php'); ?>

<main>
<article class="container-gpe mt-5">

<div class="card mb-3 shadow p-3 mb-5 bg-body rounded" style="max-width: 100vw;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="assets/people_tree.jpg" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Voici les membres du groupe <?= $array_group_name[0] ?> :</h5>
        <ul class="list-group list-group-flush">
        <?php for($i= 0; $i < count($array_first_name); $i++): ?>  
        <li class="list-group-item"><?= $array_first_name[$i]." ".$array_last_name[$i]?></li>
        <?php endfor; ?>
        </ul> 
      </div>
    </div>
  </div>
</div>

        </article>

      
</main>
 
    
</body>
</html>