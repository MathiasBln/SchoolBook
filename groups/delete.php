<?php 
require('../includes/pdo.php');

$user = $_GET['id'];
$group = $_GET['gpe'];

$maRequeteDelete = $pdo->prepare("DELETE FROM groups_has_users 
                                  WHERE users_iduser = :user AND groups_idgroups = :gpe");

$maRequeteDelete->execute([ 
    ":user" => $user,
    ":gpe" => $group
]);

header("Location: group_presentation.php?id_gpe=".$group);

?>



