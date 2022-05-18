<?php
require('./includes/pdo.php');
require('./includes/requests_homegpe.php');

if($gpe_id) {
    // Problème avec la vérif pour savoir si le post est bien celui d'un utilisateur du groupe : nom de colonne identique dans post/group_has_users
    $gpe_id = 7;
    // Ici on ne sort donc que les postes écrit pas les utilisateurs du groupe sur lequel on est :
    $myRequestPostGpe = $pdo->prepare("SELECT content, image, date_publish, users_iduser, groups_idgroups FROM posts
                                       WHERE posts.groups_idgroups = :gpe_id;");
    $myRequestPostGpe->execute([
        ":gpe_id" => $gpe_id
    ]);

    $myRequestPostGpe->setFetchMode(PDO::FETCH_ASSOC);
    $postGpe = $myRequestPostGpe->fetchAll();

    $myRequestUserPost = $pdo->prepare("SELECT users_iduser, groups_idgroups, iduser, first_name, last_name FROM posts, users
    WHERE posts.users_iduser = iduser AND posts.groups_idgroups = 7");

// +--------------+-----------------+--------+------------+-----------+
// | users_iduser | groups_idgroups | iduser | first_name | last_name |
// +--------------+-----------------+--------+------------+-----------+
// |            8 |               7 |      8 | Leatha     | Kulas     |
// |            5 |               7 |      5 | Aida       | Gorczany  |
// +--------------+-----------------+--------+------------+-----------+
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  href="css/profil.css" rel="stylesheet">
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
            <h2>Postes des membres: </h2>

            <div id="profile_content">              
            <div>
                <?php foreach($postGpe as $postGpe){ ?>
                <div class="post">
                    <h2>Post de ....></h2>
                    <p> <?= $postGpe["content"]; ?> </p>
                    <p> <?= $postGpe["date_publish"]; }; ?> </p>
                    <img src=<?= $postGpe["image"]; ?> alt="image_du_post">
                </div>
            </div>
        </div>
        
</main>

<?php require('partials/footer.php'); ?>
</body>
</html>
