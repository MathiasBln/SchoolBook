<?php 
require('../includes/pdo.php');

//save information of the URL in GET
$user = $_GET['id'];
$group = $_GET['gpe'];

//Delete user from groups
$maRequeteDelete = $pdo->prepare("DELETE FROM groups_has_users 
                                  WHERE users_iduser = :user AND groups_idgroups = :gpe");
$maRequeteDelete->execute([ 
    ":user" => $user,
    ":gpe" => $group
]);

header("Location: group_presentation.php?id_gpe=".$group);

?>



