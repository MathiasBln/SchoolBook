<?php
$id = $_GET["id"];
require('includes/pdo.php');

$maRequete = $pdo->prepare("SELECT * FROM pages WHERE idpages = :id");
 $maRequete->execute([
     ":id" => $id
 ]);
$pages = $maRequete->fetchAll(PDO::FETCH_ASSOC);

$maRequete2 = $pdo->prepare("SELECT * FROM users_has_pages uhp, users u WHERE uhp.pages_idpages = :id AND u.iduser = uhp.users_iduser AND(status = 1 OR status =2);");
$maRequete2->execute([
    ":id" => $id
]);
$maRequete2->setFetchMode(PDO::FETCH_ASSOC);
$admins = $maRequete2->fetchAll();

$maRequete3 = $pdo->prepare("SELECT content, image, date_publish FROM posts WHERE posts.pages_idpages = :id ;");
$maRequete3->execute([
    ":id" => $id
]);
$maRequete3->setFetchMode(PDO::FETCH_ASSOC);
$posts = $maRequete3->fetchAll();


$maRequete4 = $pdo->prepare("SELECT * FROM users_has_pages uhp, users u WHERE uhp.pages_idpages = :id AND u.iduser = uhp.users_iduser AND status = 0;");
$maRequete4->execute([
    ":id" => $id
]);
$maRequete4->setFetchMode(PDO::FETCH_ASSOC);
$subs = $maRequete4->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  href="css/page.css" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU:idauU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ:idjIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <?php foreach($pages as $element){ ?>

    <title> Page de <?php echo($element["title"]); ?> </title>
</head>
<body>
    <?php //require('partials/header.php'); ?>
   

    
    <div id="whole_content">
        <div class="banner">
            <img src=<?php
                            if($element["banner_page"]==null)
                            {echo("https://upload.wikimedia.org/wikipedia/commons/thumb/:id/:idd/Page_blanche_A4_points_1cm_hexa.svg/1200px-Page_blanche_A4_points_1cm_hexa.svg.png");
                            }else {echo($element["banner_page"]);} ?> 
                                                                alt="banner_page">
            <img src=<?php 
                            if($element["image_page"]==null)
                            {echo ("https://upload.wikimedia.org/wikipedia/commons/thumb/:id/:idd/Page_blanche_A4_points_1cm_hexa.svg/1200px-Page_blanche_A4_points_1cm_hexa.svg.png");
                            } else{echo($element["image_page"]);} ?> 
                                                                alt="image_page" id="page_pic">
        </div>

        <div id="title_page">
            <h1><?php  echo($element["title"]);}; ?></h1>
        </div>
        <button style="visibility:visible;"> Subscribe </button>
        <div id="description">
            <p>
                <?= $element["description"]; ?>
            </p>
        </div>
        <div id="page_content">              
            <div>
                <h2>Posts</h2>
                <?php //require('postsPage.php')?>
                <?php foreach($posts as $post){ ?>
                <div class="post">
                    <h3></h3>
                    <p> <?= $post["content"]; ?> </p>
                    <img src=<?= $post["image"]; ?> alt="image_du_post">
                    <p> <?= $post["date_publish"]; }; ?> </p>
                    
                </div>
            </div>
            <div>
            <div id="admin">
                <h2>Admins</h2>
                <?php foreach($admins as $admin){ ?>
                    
                <p> <img class="postPicture" src=<?php 
                            if($admin["avatar"]==NULL)
                            {echo ("avatar/no_avatar.png");
                            } else{echo($admin["avatar"]);} ?>
                                                                alt="image_page_sub"> 
                    <a href="old_profil.php?id=<?= $admin["iduser"] ?>"><?= $admin["username"] . ' ' . $admin["last_name"]; };?> </a>
                </p>
            </div>
            <div id="subs">
                <h2>Subscribers</h2>
                <?php foreach($subs as $sub){ ?>
                
                <p> <img class="postPicture" src=<?php 
                            if($sub["avatar"]==NULL)
                            {echo ("avatar/no_avatar.png");
                            } else{echo($sub["avatar"]);} ?> 
                                                                alt="image_page_sub"> 
                    <a href="old_profil.php?id=<?= $sub["iduser"] ?>"><?= $sub["username"] . ' ' . $sub["last_name"]; }; ?> </a>
                </p>
            </div>            
            </div>
            
        </div>    
    </div>

    <?php require('partials/footer.php'); ?>

</body>
</html>