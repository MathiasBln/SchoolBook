<?php
// $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$engine = "mysql";
$host = "localhost";
$port = 3306;
$dbname = "db_schoolbook";
$username = "root";
$password = "root";
$pdo = new PDO("$engine:host=$host:$port;dbname=$dbname", $username, $password);
$maRequete = $pdo->prepare("SELECT * FROM users WHERE iduser = 1");
// $maRequete->execute([
//     ":id" => $id
// ]);
$maRequete->execute();
$user = $maRequete->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profil.css">
    <?php foreach($user as $element){ ?>

    <title> Profil de <?php echo($element["name"]." ".$element["last_name"]); ?> </title>
</head>
<body>
    <div class="banner">
        <img src="" alt="">
    </div>
    <img class="profile_pic" src="" alt="">

    
    <h1><?php  echo($element["name"]." ".$element["last_name"]); ?></h1>
    <h2><?= $element["school_id"]; }; ?></h2>
    



</body>
</html>