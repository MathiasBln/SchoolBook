<?php 
require('../includes/pdo.php');

//save information from the URL
$user = $_GET['id'];
$group = $_GET['gpe'];

//update a user to become an admin
$updateToAdmin = $pdo->prepare("UPDATE groups_has_users SET status= 1 
                                  WHERE users_iduser = :user AND groups_idgroups = :gpe");

$updateToAdmin->execute([ 
    ":user" => $user,
    ":gpe" => $group
]);

header("Location: group_presentation.php?id_gpe=".$group);