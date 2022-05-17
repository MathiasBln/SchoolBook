<?php
// $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$engine = "mysql";
$host = "localhost";
$port = 3306;
$dbname = "db_schoolbook";
$username = "root";
$password = "root";
$pdo = new PDO("$engine:host=$host:$port;dbname=$dbname", $username, $password);
$maRequete = $pdo->prepare("SELECT * FROM users WHERE iduser = 6");
// $maRequete->execute([
//     ":id" => $id
// ]);
$maRequete->execute();
$user = $maRequete->fetchAll(PDO::FETCH_ASSOC);


$maRequete2 = $pdo->prepare("SELECT * FROM groups g, groups_has_users  ghu WHERE ghu.users_iduser = 6 AND ghu.groups_idgroups = g.idgroups;");
$maRequete2->execute();
$maRequete2->setFetchMode(PDO::FETCH_ASSOC);
$groups = $maRequete2->fetchAll();

$maRequete3 = $pdo->prepare("SELECT content, image, date_publish FROM posts WHERE posts.users_iduser = 6 ;");
$maRequete3->execute();
$maRequete3->setFetchMode(PDO::FETCH_ASSOC);
$posts = $maRequete3->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  href="css/profil.css" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <?php foreach($user as $element){ ?>

    <title> Profil de <?php echo($element["name"]." ".$element["last_name"]);}; ?> </title>
</head>
<body>
    
    <?php //require_once('partials/header.php'); ?>
    


    <div id="profile_content">
        
        <?php foreach($user as $element){ ?>
        <div id="profile_name">
            <h1><?php  echo($element["first_name"]." ".$element["last_name"]); ?></h1>
        </div>
        <button> Ajouter en ami </button>
        <h2><?= $element["school_id"]; };?></h2>

        <div id="posts">
            <?php foreach($posts as $post){ ?>
            <div class="post">
                <p> <?= $post["content"]; ?> </p>
                <p> <?= $post["date_publish"]; }; ?> </p>
                <img src=<?= $post["image"]; ?> alt="image_du_post">
            </div>
        </div>

        <?php foreach($groups as $group_element){ ?>
        <h2> <?= $group_element["name"]; };?> </h2>
        
        
    </div>

    <?php //require('partials/footer.php'); ?>

</body>
</html>