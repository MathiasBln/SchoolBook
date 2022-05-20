<?php

// $id_gpe provient du clic depuis group_search.php
// $id_gpe = filter_input(INPUT_GET, "id_gpe", FILTER_VALIDATE_INT);
// $idUserFromGpe = filter_input(INPUT_GET, "idUserFromGpe", FILTER_VALIDATE_INT); // pour l'instant on se base sur 4 (Hermann) - sera aussi utilisé dans l'url de quit
//$idMemberAdded = filter_input(INPUT_GET, "idMemberAdded", FILTER_VALIDATE_INT); // On se base sur 4
//$idMemberDelete = filter_input(INPUT_GET, "idUserDelete", FILTER_VALIDATE_INT);


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

