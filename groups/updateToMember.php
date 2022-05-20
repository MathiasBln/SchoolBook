<?php 
require('../includes/pdo.php');

//save information from the URL
$user = $_GET['id'];
$group = $_GET['gpe'];

//transform admin to members
$updateToMembers = $pdo->prepare("UPDATE groups_has_users SET status= 0 
                                  WHERE users_iduser = :user AND groups_idgroups = :gpe");
$updateToMembers->execute([ 
    ":user" => $user,
    ":gpe" => $group
]);

header("Location: group_presentation.php?id_gpe=".$group);