<?php
require('./includes/pdo.php');

$myRequest_search_gpe = $pdo->prepare("SELECT * FROM groups");

$myRequest_search_gpe->execute();

$myGroups = $myRequest_search_gpe->fetchAll(PDO::FETCH_ASSOC);

print_r($myGroups.'<br/>');

var_dump($myGroups[0]["idgroups"]." ".$myGroups[0]["name"]);
var_dump($myGroups[1]["idgroups"]." ".$myGroups[1]["name"]);
var_dump($myGroups[2]["idgroups"]." ".$myGroups[2]["name"]);
var_dump($myGroups[3]["idgroups"]." ".$myGroups[3]["name"]);
var_dump($myGroups[4]["idgroups"]." ".$myGroups[4]["name"]);
var_dump($myGroups[5]["idgroups"]." ".$myGroups[5]["name"]);
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
    <!-- Bootstrap nav-bar style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
    <title>Rechercher un groupe</title>
</head>
<body>
    <?php require('./partials/header.php'); ?>

<article class="container-gpe mt-5">
<!-- shadow p-3 mb-5 bg-body rounded -->
<div class="card mb-3 shadow bg-body rounded mt-5" style="max-width: 100vw;">
  <div class="row g-0 p-x-0 m-x-0">

    <div class="col-4 picture-container">
      <img src="assets/people_tree.jpg" class="img-tree img-fluid rounded-start" style="height:100%; width:auto;" alt="...">
    </div>

    <div class="col-8">

      <div class="card-body">
        <h5 class="card-title">Groupes disponibles:</h5>
        <ul class="list-group list-group-flush">
        <?php for($i= 0; $i < count($myGroups); $i++): ?>  
        <li>
            <a class="list-group-item list-group-item-action text-decoration-none" href="group_presentation.php?id_gpe=<?= $myGroups[$i]["idgroups"] ?>"><?= $myGroups[$i]["name"] ?> </a>
        </li>
        <?php endfor; ?>
        </ul>  
      </div>
    </div>
  </div>
</div>

        </article>

</article>

</body>
</html>