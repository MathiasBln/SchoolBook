<?php
//  $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
require('includes/pdo.php');

$maRequete = $pdo->prepare("SELECT * FROM pages p , users u, users_has_pages uhp WHERE (u.iduser = 12 AND uhp.users_iduser = u.iduser) AND (uhp.pages_idpages = p.idpages)");
$maRequete->execute();
$maRequete->execute();
$pages = $maRequete->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  href="css/page.css" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <title> Liste de vos pages </title>
</head>
<body>
    <?php //require('partials/header.php');?>
    <div id="pages">
    <?php foreach($pages as $page){ ?>

        <h2>Vos pages</h2>
    <p><a href="page.php?id=<?= $page["idpages"]?>"><?= $page["title"];}; ?></a></p></div>

    <?php require('partials/footer.php'); ?>

</body>
</html>