<?php
require('./pdo_group.php');


$idgpe = filter_input(INPUT_GET, "idgpe", FILTER_VALIDATE_INT);

$myRequest = $pdo->prepare("SELECT `name`, first_name, last_name, groups_idgroups, users_iduser, iduser 
                              FROM groups_has_users, users, groups 
                              WHERE users.iduser = users_iduser AND groups.idgroups = :idgpe
                              ORDER BY `name`");
$myRequest->execute([
    ":idgpe" => $idgpe
]);
$myGroupMembers = $myRequest->fetchAll(PDO::FETCH_ASSOC);

$array_first_name = [];
$array_last_name = [];
$array_group_name = [];
// Attention l'idgpe gagnera en sécurité s'il est plutôt mis ailleurs qu'ici 
for($i=0; $i < count($myGroupMembers); $i++) {
    if ($myGroupMembers[$i]["groups_idgroups"] === $idgpe) {
        array_push($array_group_name, $myGroupMembers[$i]["name"]);
        array_push($array_first_name, $myGroupMembers[$i]["first_name"]);
        array_push($array_last_name, $myGroupMembers[$i]["last_name"]);
    }
}

var_dump($array_group_name);
echo("<br/><br/>");
var_dump($array_first_name);
echo("<br/><br/>");
var_dump($array_last_name);

// echo("<br/><br/>");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membres</title>
</head>
<body>
    <h1>Membres du groupe <?= $array_group_name[0] ?>:</h1>

    <ul>
    <?php for($i= 0; $i < count($array_first_name); $i++): ?>  
            <li><?= $array_first_name[$i]." ".$array_last_name[$i]?></li>
    <?php endfor; ?>
    </ul>    
    
</body>
</html>