<?php
require('./pdo_group.php');
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$maRequete = $pdo->prepare("SELECT * FROM groups
                            WHERE groups.idgroups=:id");

$maRequete->execute([
    ":id" => $id
]);

$maRequete->setFetchMode(PDO::FETCH_ASSOC);
$groups = $maRequete->fetchAll();

