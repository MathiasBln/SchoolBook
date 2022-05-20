<?php 
require('../includes/pdo.php');

$id_gpe = $_GET['id_gpe'];
session_start();
if(!isset($_SESSION['user'])){
  header('Location: ../index.php');
  die();
}


$maRequeteUsers = $pdo->prepare("SELECT * FROM users INNER JOIN groups_has_users ghu ON ghu.users_iduser = users.iduser WHERE token=?");
$maRequeteUsers->execute(array($_SESSION["user"]));
$user = $maRequeteUsers->fetchAll();
$saveUser = $user[0]['iduser'];


$maRequeteGpe = $pdo->prepare("SELECT * FROM groups
WHERE groups.idgroups=:id_gpe");

$maRequeteGpe->execute([
":id_gpe" => $id_gpe
]);


$maRequeteGpe->setFetchMode(PDO::FETCH_ASSOC);
$groups = $maRequeteGpe->fetchAll();

$myRequestPostGpe = $pdo->prepare("SELECT * FROM posts
                                       INNER JOIN users u ON u.iduser = posts.users_iduser
                                       WHERE posts.groups_idgroups = :gpe_id;");
$myRequestPostGpe->execute([
    ":gpe_id" => $id_gpe
]);



$myRequestPostGpe->setFetchMode(PDO::FETCH_ASSOC);
$postsGpe = $myRequestPostGpe->fetchAll();



$myRequest_members = $pdo->prepare("SELECT * FROM groups_has_users ghu 
                                    INNER JOIN users u ON u.iduser = ghu.users_iduser
                                    WHERE ghu.groups_idgroups = :id_gpe");

$myRequest_members->execute([
":id_gpe" => $id_gpe
]);
$myGroupMembers = $myRequest_members->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/groupe.css" type="text/css">
    <link rel="stylesheet" href="../css/footer.css" type="text/css">
    <link rel="stylesheet" href="../css/header.css" type="text/css">
    <!-- Bootstrap nav-bar style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
    <title>A propos de <?= $groups[0]["name"] ?></title>
</head>
<body>
<?php require('../partials/header.php'); ?>
<?php require('navigation_gpe.php'); ?>

<main>

<div class="container">
     <div class="a-propos-groupe">
            <h1>A propos de nous</h1>
            <p><?= $groups[0]["description"]?></p>
        </div>
    </div>

    <div id="post">
    <div class="container container-gpe" style="text-align:center;">
            <h2>Postes des membres: </h2>
            </div> 

        <section class="container container-gpe ms-2">
            
            <div id="profile_content" style="display:block">             
            <div>
                <?php foreach($postsGpe as $postGpe){ ?>
                <div class="post mt-2 ms-3" style="background-color: rgba(224, 170, 255,0.2); border-radius:10px;">
                    <img src=<?= $postGpe["avatar"] ?> alt="avatar user" id="post-avatar">
                    <h3 class="p-1"><?= $postGpe["first_name"] . ' ' . $postGpe["last_name"] ?></h3>
                    <p class="p-1"> <?= $postGpe["content"]; ?> </p>
                    <p class="p-1"> <?= $postGpe["date_publish"]; ?> </p>
                    <img src=<?= $postGpe["image"]; ?> alt="image_du_post" class="p-5" style="height:auto; width:100%;">
                </div>
                <?php }; ?>
            </div>
        </div>
    
    </section>
    </div>

<article id="members" class="container-gpe mt-5">

    <div class="card mb-3 shadow p-3 mb-5 bg-body rounded" style="max-width: 100vw;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="assets/people_tree.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Voici les membres du groupe:</h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach($myGroupMembers as $myGroupMember): ?>  
                            <li class="list-group-item"><?= $myGroupMember["first_name"].' '.$myGroupMember["last_name"]?></li>
                            <?php if($user[0]["status"] == 1): ?>
                                <a class="btn btn-danger" href="delete.php?id=<?= $myGroupMember["iduser"] ?>&amp;gpe=<?= $id_gpe ?>">Exclure</a>
                                    <?php if($myGroupMember["status"] == 1): ?>
                                    <a class="btn btn-success" href="updateToMember.php?id=<?= $myGroupMember["iduser"] ?>&amp;gpe=<?= $id_gpe ?>">Admin</a>
                                    <?php else: ?>
                                    <a class="btn btn-success" href="updateToAdmin.php?id=<?= $myGroupMember["iduser"] ?>&amp;gpe=<?= $id_gpe ?>">Membre</a>

                                    <?php endif; ?>
                                <?php endif; ?>
                        <?php endforeach; ?>
                    </ul> 
                </div>
            </div>
        </div>
    </div>

</article>                

</main>

</body>
</html>
