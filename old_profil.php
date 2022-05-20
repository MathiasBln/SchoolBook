<?php
$id = $_GET["id"];
require('includes/pdo.php');

$maRequete = $pdo->prepare("SELECT * FROM users WHERE iduser =:id");
$maRequete->execute([
     ":id" => $id
]);
$user = $maRequete->fetchAll(PDO::FETCH_ASSOC);


$maRequete2 = $pdo->prepare("SELECT * FROM groups g, groups_has_users  ghu WHERE ghu.users_iduser = :id AND ghu.groups_idgroups = g.idgroups;");
$maRequete2->execute([
    ":id" => $id
]);
$maRequete2->setFetchMode(PDO::FETCH_ASSOC);
$groups = $maRequete2->fetchAll();

$maRequete3 = $pdo->prepare("SELECT content, image, date_publish FROM posts WHERE posts.users_iduser = :id ;");
$maRequete3->execute([
    ":id" => $id
]);
$maRequete3->setFetchMode(PDO::FETCH_ASSOC);
$posts = $maRequete3->fetchAll();

$maRequete4 = $pdo->prepare("SELECT * FROM users u, relation r WHERE (r.user_one = :id AND r.user_two = u.iduser) OR (r.user_two = :id AND r.user_one = u.iduser);");
$maRequete4->execute([
    ":id" => $id
]);
$maRequete4->setFetchMode(PDO::FETCH_ASSOC);
$friends = $maRequete4->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  href="css/old_profil.css" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <?php foreach($user as $element){ ?>

    <title> Profil de <?php echo($element["username"]." ".$element["last_name"]); ?> </title>
</head>
<body>
    <?php //require('partials/header.php'); ?>
   
    <div id="whole_content">
        <div id="banner">
            <img src=<?php 
                            if($element["avatar"]==null)
                            {echo ("avatar/no_avatar.png");
                            } else{echo($element["avatar"]);} ?> 
                                                                alt="image_profil" id="profile_pic">
        </div>

        <div id="profile_name">
            <h1><?php  echo($element["username"]." ".$element["last_name"]);}; ?></h1>
        </div>
        <button> Add as friend </button>
        <div id="profile_content">              
            <div>
                <h2>Posts</h2>
                <?php foreach($posts as $post){ ?>
                <div class="post">
                    <p> <?= $post["content"]; ?> </p>
                    <img src=<?= $post["image"]; ?> alt="image_du_post">
                    <p> <?= $post["date_publish"]; }; ?> </p>
                    
                </div>
            </div>
        </div>
        <div>
            <div id="groups">
                <h2>Groups</h2>
                <?php foreach($groups as $group_element){ ?>
                <p> <?= $group_element["name"]; };?> </p>
            </div>
            <div id="friends">
                <h2>Friends</h2>
                <?php foreach($friends as $friend){ ?>
                
                <p> <img class="postPicture" src=<?php 
                            if($friend["avatar"]==NULL)
                            {echo ("avatar/no_avatar.png");
                            } else{echo($friend["avatar"]);} ?> 
                                                                alt="image_profile_friend"> 
                    <?= $friend["username"] . ' ' . $friend["last_name"]; }; ?> 
                </p>
                    
            </div>
        </div>
            
            
    </div>

    <?php require('partials/footer.php'); ?>

</body>
</html>