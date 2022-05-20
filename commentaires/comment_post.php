<?php 

// $dbname = "db_schoolbook";
// $username = "root";
// $password = "root";
// $pdo = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
require('includes/pdo.php');

$idUserCom = 1;
$idGpeCom = 7;
$idPostCom = 5;


$maRequeteInsertCom = $pdo->prepare("INSERT INTO comments (idavis, comment, post_idpost) VALUES(:idMemberAdded, :idgroup, 0)");
$maRequeteInsertCom->execute([
    ":idMemberAdded" => $idMemberAdded,
    ":idgroup" => $idgroup
]);




