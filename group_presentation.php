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
    <!-- Bootstrap nav-bar style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
    <title>A propos de <?= $array_group_name[0] ?></title>
</head>
<body>

<?php require('./partials/header.php'); ?>
<?php require('./partials/navigation_gpe.php'); ?>

<main>
<div class="container">
     <div class="a-propos-groupe">
            <h1>A propos de nous :</h1>
            <p><?= $groups[0]["description"]?></p>
        </div>
    </div>
</main>

</body>
</html>
