<?php
require('./pdo_group.php');

$maRequete = $pdo->prepare("SELECT * FROM groups");

$maRequete->execute();

$myGroups = $maRequete->fetchAll(PDO::FETCH_ASSOC);

print_r($myGroups.'<br/>');

var_dump($myGroups[0]["idgroups"]." ".$myGroups[0]["name"]);
var_dump($myGroups[1]["idgroups"]." ".$myGroups[1]["name"]);
var_dump($myGroups[2]["idgroups"]." ".$myGroups[2]["name"]);
var_dump($myGroups[3]["idgroups"]." ".$myGroups[3]["name"]);
var_dump($myGroups[4]["idgroups"]." ".$myGroups[4]["name"]);
var_dump($myGroups[5]["idgroups"]." ".$myGroups[5]["name"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher un groupe</title>
</head>
<body>
    <h1>Groupes disponibles: </h1>

    <table>
        <thead>
            <tr>
                <th>valeur de i</th>
                <th>Identifiant du groupe</th>
                <th>Nom du groupe</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 0; $i < count($myGroups); $i++): ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $myGroups[$i]["idgroups"] ?></td>
                    <td>
                        <a href="group.php?id=<?= $myGroups[$i]["idgroups"] ?>"> 
                        <?= $myGroups[$i]["name"] ?> </a>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>



</body>
</html>