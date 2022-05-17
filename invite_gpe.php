<?php 

require('./pdo_group.php');
// Note: $idgpe est l'id envoyé lors du clic sur l'onglet du groupe depuis la page du groupe 
// $idgroup en revanche provient de cette page pour ajouter un membre au groupe dont l'id est la valeur de idgroup
if($idgpe) {
    $idgpe = filter_input(INPUT_GET, "idgpe", FILTER_VALIDATE_INT);
} else {
    $idgpe = 1;
}

$idUserFromGpe = filter_input(INPUT_GET, "idUserFromGpe", FILTER_VALIDATE_INT); // pour l'instant on se base sur 4
$idMemberAdded = filter_input(INPUT_GET, "idMemberAdded", FILTER_VALIDATE_INT);
$idgroup = filter_input(INPUT_GET, "idgroup", FILTER_VALIDATE_INT);

if($idMemberAdded) {
$maRequete03 = $pdo->prepare("INSERT INTO groups_has_users (users_iduser, groups_idgroups, `status`) VALUES(:idMemberAdded, :idgroup, 0)");
$maRequete03->execute([
    ":idMemberAdded" => $idMemberAdded,
    ":idgroup" => $idgroup
]);

}  

$myRequest = $pdo->prepare("SELECT DISTINCT first_name, last_name, iduser, id_demandeur, id_receveur
                              FROM users, relation 
                              WHERE relation.id_receveur = users.iduser
                              AND relation.id_receveur NOT IN (4)
                              AND id_demandeur = 4");
/* for id_demandeur or iduser is 4:
+------------+-----------+--------+--------------+-------------+
| first_name | last_name | iduser | id_demandeur | id_receveur |
+------------+-----------+--------+--------------+-------------+
| Freddy     | Emard     |      3 |            4 |           3 |
| Bella      | Kihn      |     10 |            4 |          10 |
+------------+-----------+--------+--------------+-------------+
*/ 

$myRequest->execute();

// Se saisir du nom de l'utilisateur qui a le bon id (qui sera dans l'URL et la même variable que pour avoir l'id_demandeur).
$myFriendsGpe = $myRequest->fetchAll(PDO::FETCH_ASSOC);

$myRequest02 = $pdo->prepare("SELECT first_name, last_name, iduser
                              FROM users
                              WHERE iduser = 4");

// +------------+-----------+--------+
// | first_name | last_name | iduser |
// +------------+-----------+--------+
// | Freddy     | Emard     |      3 |
// +------------+-----------+--------+

$myRequest02->execute();
$userGpe = $myRequest02->fetchAll(PDO::FETCH_ASSOC);


$myRequest05 = $pdo->prepare("SELECT users_iduser, groups_idgroups, `status` FROM groups_has_users");
$myRequest05->execute();
$alreadyInGroup = $myRequest05->fetchAll(PDO::FETCH_ASSOC);

$alreadyStatus = [];
$alreadyUser = [];
$alreadyGpe = [];
for($rows = 0; $rows < count($alreadyInGroup); $rows++) {
    array_push($alreadyStatus,$alreadyInGroup[$rows]["status"]);
    array_push($alreadyUser,$alreadyInGroup[$rows]["users_iduser"]);
    array_push($alreadyGpe,$alreadyInGroup[$rows]["groups_idgroups"]);
}

var_dump($alreadyUser);
echo("<br/><br/>");
var_dump($alreadyGpe);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="invite_gpe.css" type="text/css">
    <link rel="stylesheet" href="groupe.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title> Inviter vos amis </title>
</head>
<body>
<?php require('./partials/header.php'); ?>
<?php require('./navigation_gpe.php'); ?>


        <!-- Bootstrap nav bar -->

      <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="#"> <?= $groups[0]["name"] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link nav-link-gpe" href="./members.php?idgpe=<?= $groups[0]["idgroups"]?>">Retour au groupe</a>
        </div>
        </div>
    </div>
    </nav>
</section>



    <h1>Bonjour <?= $userGpe[0]["first_name"]." ".$userGpe[0]["last_name"] ?> Invitez: </h1>
    <ul>
        <?php for($row = 0; $row < count($myFriendsGpe); $row++):?>
        <div class="friends-gpe">
            <li class="friend-gpe-name"><?= $myFriendsGpe[$row]["first_name"]." ".$myFriendsGpe[$row]["last_name"]?></li>
            <?php if(in_array($myFriendsGpe[$row]["id_receveur"], $alreadyUser) && in_array($idgpe, $alreadyGpe) ):?>
                <li class="friend-gpe-link">Je suis déjà dans ce groupe</li>
            <?php else: ?>
                <li class="friend-gpe-link"><a href="./invite_gpe.php?idMemberAdded=<?=$myFriendsGpe[$row]["id_receveur"]?>&idgroup=<?= $idgpe?>">invitez ce membre</a></li>
            <?php endif; ?>
        </div>
        <?php endfor; ?>
    </ul>    
</body>
</html>

