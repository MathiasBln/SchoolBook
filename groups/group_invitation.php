<?php 
require('../includes/pdo.php');

// $id_gpe provient du clic depuis group_search.php
// $id_gpe = filter_input(INPUT_GET, "id_gpe", FILTER_VALIDATE_INT);
// $idUserFromGpe = filter_input(INPUT_GET, "idUserFromGpe", FILTER_VALIDATE_INT); // pour l'instant on se base sur 4 (Hermann) - sera aussi utilisé dans l'url de quit
//$idMemberAdded = filter_input(INPUT_GET, "idMemberAdded", FILTER_VALIDATE_INT); // On se base sur 4
//$idMemberDelete = filter_input(INPUT_GET, "idUserDelete", FILTER_VALIDATE_INT);
// Note: $idgpe est l'id envoyé lors du clic sur l'onglet du groupe depuis la page du groupe 
// $idgroup en revanche provient de cette page pour ajouter un membre au groupe dont l'id est la valeur de idgroup

// $idgroup = filter_input(INPUT_GET, "idgroup", FILTER_VALIDATE_INT);



$idgroup = 5;
$id_gpe = 5;
$idMemberAdded = 7; 
$idUserFromGpe = 4;
$idMemberDelete = 1;


// Le membre est ajouté avec un statut de membre classique (0) - pas encore la possibilité de le choisir en admin : remplacer 0 par une autre variable.
if($idMemberAdded && $idgroup) {
$maRequete03 = $pdo->prepare("INSERT INTO groups_has_users (users_iduser, groups_idgroups, `status`) VALUES(:idMemberAdded, :idgroup, 0)");
$maRequete03->execute([
    ":idMemberAdded" => $idMemberAdded,
    ":idgroup" => $idgroup
]);

}  

// Je m'inscris dans le groupe x à partir de la page de recherche des groupes (si je suis pas déjà inscris = NOT IN )
// Requête à faire en lien avec la page de group_research 
// Si je veux être admin je fais une demande spéciale (messagerie...)

if($idUserFromGpe) {

    $myRequestFdsAdd = $pdo->prepare("SELECT DISTINCT first_name, last_name, iduser, id_demandeur, id_receveur
    FROM users, relation 
    WHERE relation.id_receveur = users.iduser
    AND relation.id_receveur NOT IN (4)
    AND id_demandeur = 4"); // ici on mettra :idUserFromGpe à la place
    /* for id_demandeur or iduser is 4:
    +------------+-----------+--------+--------------+-------------+
    | first_name | last_name | iduser | id_demandeur | id_receveur |
    +------------+-----------+--------+--------------+-------------+
    | Freddy     | Emard     |      3 |            4 |           3 |
    | Bella      | Kihn      |     10 |            4 |          10 |
    +------------+-----------+--------+--------------+-------------+
    */ 

    $myRequestFdsAdd->execute();
    $myFriendsGpe = $myRequestFdsAdd->fetchAll(PDO::FETCH_ASSOC);

    // Se saisir du nom de l'utilisateur qui a le bon id (ici ça sera tj le 4 - Hermann) (qui sera dans l'URL et la même variable que pour avoir l'id_demandeur).
    $myRequest02 = $pdo->prepare("SELECT first_name, last_name, iduser
        FROM users
        WHERE iduser = 4"); // ici aussi on met :idUserFromGpe
    $myRequest02->execute();
    $userGpe = $myRequest02->fetchAll(PDO::FETCH_ASSOC);

    // Pour vérifier si le membre est déjà dans le groupe
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

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/invite_gpe.css" type="text/css">
    <link rel="stylesheet" href="../css/groupe.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title> Inviter vos amis </title>
</head>
<body>
<?php require('../partials/header.php'); ?>
<?php require('navigation_gpe.php'); ?>

<section>
    <h1>Bonjour <?= $userGpe[0]["first_name"]." ".$userGpe[0]["last_name"] ?> Invitez: </h1>
    <ul>
        <?php for($row = 0; $row < count($myFriendsGpe); $row++):?>
        <div class="friends-gpe">
            <li class="friend-gpe-name"><?= $myFriendsGpe[$row]["first_name"]." ".$myFriendsGpe[$row]["last_name"]?></li>
            <?php if(in_array($myFriendsGpe[$row]["id_receveur"], $alreadyUser) && in_array($id_gpe, $alreadyGpe) ):?>
                <li class="friend-gpe-link">Je suis déjà dans ce groupe</li>
            <?php else: ?>
                <li class="friend-gpe-link"><a href="./group_invitation.php?idMemberAdded=<?=$myFriendsGpe[$row]["id_receveur"]?>&idgroup=<?= $id_gpe?>">invitez ce membre</a></li>
            <?php endif; ?>
        </div>
        <?php endfor; ?>
    </ul>  
</section>

    
</body>
</html>

