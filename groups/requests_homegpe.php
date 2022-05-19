<?php

// $id_gpe provient du clic depuis group_search.php
// $id_gpe = filter_input(INPUT_GET, "id_gpe", FILTER_VALIDATE_INT);
// $idUserFromGpe = filter_input(INPUT_GET, "idUserFromGpe", FILTER_VALIDATE_INT); // pour l'instant on se base sur 4 (Hermann) - sera aussi utilisé dans l'url de quit
//$idMemberAdded = filter_input(INPUT_GET, "idMemberAdded", FILTER_VALIDATE_INT); // On se base sur 4
//$idMemberDelete = filter_input(INPUT_GET, "idUserDelete", FILTER_VALIDATE_INT);

$idUserFromGpe = 4;
$idMemberAdded = 4;
$idMemberDelete = 1;

// Requête pour identifier l'id de l'utilisateur du groupe (là où il y a à la fois l'utilisateur et le groupe sélectionné)
// Pour aussi récupérer les 2 autres colonnes: le statut de l'utilisateur dans le groupe (admin = 1) et l'id du groupe en question

if($id_gpe and $idUserFromGpe) {
    $myRequestIdUserGpe = $pdo->prepare("SELECT * FROM groups_has_users
                            WHERE groups_has_users.groups_idgroups=:id_gpe
                            AND groups_has_users.users_iduser = :idUserFromGpe");

    $myRequestIdUserGpe->execute([
        ":id_gpe" => $id_gpe,
        "idUserFromGpe" => $idUserFromGpe
    ]);

    $myRequestIdUserGpe->setFetchMode(PDO::FETCH_ASSOC);
    $idUserGpe = $myRequestIdUserGpe->fetchAll();

}


// ------ Requests from group_invitation

// Note: $idgpe est l'id envoyé lors du clic sur l'onglet du groupe depuis la page du groupe 
// $idgroup en revanche provient de cette page pour ajouter un membre au groupe dont l'id est la valeur de idgroup

// $idgroup = filter_input(INPUT_GET, "idgroup", FILTER_VALIDATE_INT);
$idgroup = $id_gpe;
$idMemberAdded = 4;

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


// --- Requetes depuis group_members.php

// $idgpe = filter_input(INPUT_GET, "id_gpe", FILTER_VALIDATE_INT);

$myRequest_members = $pdo->prepare("SELECT DISTINCT `name`, first_name, last_name, groups_idgroups, users_iduser, iduser 
                              FROM groups_has_users, users, groups 
                              WHERE users.iduser = users_iduser AND groups.idgroups = :id_gpe
                              ORDER BY `name`");
$myRequest_members->execute([
    ":id_gpe" => $id_gpe
]);
$myGroupMembers = $myRequest_members->fetchAll(PDO::FETCH_ASSOC);

$array_first_name = [];
$array_last_name = [];
$array_group_name = [];

for($i=0; $i < count($myGroupMembers); $i++) {
    if ($myGroupMembers[$i]["groups_idgroups"] === $id_gpe) {
        array_push($array_group_name, $myGroupMembers[$i]["name"]);
        array_push($array_first_name, $myGroupMembers[$i]["first_name"]);
        array_push($array_last_name, $myGroupMembers[$i]["last_name"]);
    }
}

// Je quitte le groupe : je me supprime de la base groups_has_users (variable qui contient l'user_iduser : idUserFromGpe )

if($idUserFromGpe) {
    $myRequestDeleteFromGpe = $pdo->prepare("DELETE FROM groups_has_users WHERE users_iduser = :idUserFromGpe");
    $myRequestDeleteFromGpe->execute([
        ":idUserFromGpe" => $idUserFromGpe
    ]);
}

// Je modifie mes droits: je deviens un admin - je dois ajouter dans la condition le fait que je n'ai pas statut = 1 déjà
if($idUserFromGpe) {

    $myRequestAdminInGpe = $pdo->prepare("UPDATE groups_has_users SET `status` = 1 WHERE users_iduser = :idUserFromGpe AND `status` = 0");
    $myRequestAdminInGpe->execute([
        ":idUserFromGpe" => $idUserFromGpe
    ]);
}

// Je supprime un autre membre : je dois ajouter le fait que j'ai le statut admin dans la condition
if($idMemberDelete) {
    $myRequestDeleteMemberFromGpe = $pdo->prepare("DELETE FROM groups_has_users WHERE users_iduser = :idMemberDelete");
    $myRequestDeleteMemberFromGpe->execute([
        ":idMemberDelete" => $idMemberDelete
    ]);
    // je dois actualiser la page avec un http location pour que l'utilisateur constate la disparition du nom
}
