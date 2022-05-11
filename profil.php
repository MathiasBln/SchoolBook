<?php
$engine = "mysql";
$host = "localhost";
$port = 3306;
$dbname = "db_schoolbook";
$username = "root";
$password = "root";
$pdo = new PDO("$engine:host=$host:$port;dbname=$dbname", $username, $password);
$maRequete = $pdo->prepare("SELECT * FROM users");
// Etape 2 : On exécute la requête
$maRequete->execute();
// Etape 3 : Si c'est un SELECT, on récupère LE (fetch) ou LES (fetchAll) résultatS
// PDO::FETCH_ASSOC va ramener uniquement les noms de colonnes
$user = $maRequete->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profil.css">
    <title>Profil <?php $user["name"]." ".$user["last_name"] ?> </title>
</head>
<body>
    <div class="banner">
        <img src="" alt="">
    </div>

    <img class="profile_pic" src="" alt="">

    <h1><?php $user["name"]." ".$user["last_name"] ?></h1>
    <h2><?php $user["school_id"]?></h2>


</body>
</html>