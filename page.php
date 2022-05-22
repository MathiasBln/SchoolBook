<?php
require('includes/pdo.php');
$id = $_GET["id"];

session_start();
if(!isset($_SESSION['user'])){
  header('Location: ../index.php');
  die();
}

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
    <link  href="css/Page.css" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU:idauU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ:idjIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <title> Page de <?php echo($pages[0]["title"]); ?> </title>
</head>
<body>
<?php require('./partials/header.php'); ?>
    <?php  ?>
   
 
    <div id="whole_content">
        <div class="banner" style="background: url(profile_banners/<?= $pages[0]["banner"]; ?>) no-repeat center; background-size: cover;height: 40vh">
        </div>
    <div class="allContent">
        <div id="title_page">
            <h1><?php  echo($pages[0]["title"]); ?></h1>
        </div>
    <!-- <button class="btn-subscribe"> Subscribe </button> -->
        <div id="description">
            <p>
                <?= $pages[0]["description"]; ?>
            </p>
        </div>
        <div id="page_content">              
            <div>
                <h2>Posts</h2>
                <?php //require('postsPage.php')?>
                <?php foreach($posts as $post){ ?>
                <div class="post">
                    <h3></h3>
                    <p> <?= $post["date_publish"]; }; ?> </p>
                    <p> <?= $post["content"]; ?> </p>
                    <img src="profile_banners/<?= $post["image"]; ?>" alt="image_du_post">
                    
                    
                </div>
            </div>
        <div>
            <div id="admin">
                <h2>Admins</h2>
                <?php foreach($admins as $admin){ ?>
                    
                <p> <img class="postPicture" src="profile_images/<?= $admin["avatar"] ?>"
                                                                alt="image_page_sub"> 
                    <a href="profile.php?id=<?= $admin["iduser"] ?>"><?= $admin["username"] . ' ' . $admin["last_name"]; };?> </a>
                </p>
            </div>
                      
            </div>
            
        </div>   
        </div> 
    </div>

    <?php require('partials/footer.php'); ?>

</body>
</html>