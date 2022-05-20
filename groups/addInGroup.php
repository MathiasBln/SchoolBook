<?php 

require('../includes/pdo.php');

//save information from the URL in GET
$user = intval($_GET['id']);
$group = intval($_GET['gpe']);

//Request for the user in groups
$requeteUser = $pdo->prepare("SELECT * FROM groups_has_users WHERE groups_idgroups = :gpe AND users_iduser = :user");
$requeteUser->execute([ 
    ":user" => $user,
    ":gpe" => $group
]);
$userInGroup = $requeteUser->fetchAll();

//Add user in the group and location to the presentation of the group.
if($userInGroup == NULL){     
    $InsertUser = $pdo->prepare("INSERT INTO groups_has_users (groups_idgroups, users_iduser, status)
                                        VALUES (:gpe, :user, 0) ");
    $InsertUser->execute([ 
        ":user" => $user,
        ":gpe" => $group
    ]);
    header("Location: group_presentation.php?id_gpe=".$group);
} else {
    header("Location: group_presentation.php?id_gpe=".$group);
}


?>
