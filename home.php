<?php
require 'includes/init.php';
if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
    $user_data = $user_obj->find_user_by_id($_SESSION['user_id']);
    if($user_data ===  false){
        header('Location: logout.php');
        exit;
    }
    // FETCH ALL USERS WHERE ID IS NOT EQUAL TO MY ID
    $all_users = $user_obj->all_users($_SESSION['user_id']);
    $all_posts_users = $user_obj->all_posts_users($_SESSION['user_id']);
}

else{
    header('Location: logout.php');
    exit;
}

// REQUEST NOTIFICATION NUMBER
$get_req_num = $frnd_obj->request_notification($_SESSION['user_id'], false);
// TOTAL FRIENDS
$get_frnd_num = $frnd_obj->get_all_friends($_SESSION['user_id'], false);

// GET MY($_SESSION['user_id']) ALL FRIENDS
$get_all_friends = $frnd_obj->get_all_friends($_SESSION['user_id'], true);
?>


<?php
//session_start();
if(!isset($_SESSION['user'])){
  header('Location: index.php');
  die();
}

require('includes/pdo.php');

//save information from the user connect
$maRequeteUsers = $pdo->prepare("SELECT * FROM users WHERE token=?");
$maRequeteUsers->execute(array($_SESSION["user"]));
$user = $maRequeteUsers->fetchAll();
$saveUser = $user[0]['iduser'];

$maRequeteContact = $pdo->prepare("SELECT * FROM users u, relation r WHERE r.user_one = :saveUser AND r.user_two = u.iduser");
$maRequeteContact->execute([
  ":saveUser" => $saveUser
]);
$maRequeteContact->setFetchMode(PDO::FETCH_ASSOC);
$contacts = $maRequeteContact->fetchAll();

//save information where user follows pages
$maRequetePostByPages = $pdo->prepare("SELECT * FROM users_has_pages uhp WHERE uhp.users_iduser = :saveUser");
$maRequetePostByPages->execute([
  ":saveUser" => $saveUser
]);
$maRequetePostByPages->setFetchMode(PDO::FETCH_ASSOC);
$publications = $maRequetePostByPages->fetchAll();

//select all the post
$maRequetePost = $pdo->prepare("SELECT * FROM posts p ORDER BY date_publish DESC");
$maRequetePost->execute();
$maRequetePost->setFetchMode(PDO::FETCH_ASSOC);
$results = $maRequetePost->fetchAll();

//select all the pages
$maRequetePages = $pdo->prepare("SELECT * FROM pages p");
$maRequetePages->execute();
$maRequetePages->setFetchMode(PDO::FETCH_ASSOC);
$pages = $maRequetePages->fetchAll();

?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/Home.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</head>
<body>
  <?php require_once('partials/header.php') ?>

  <div id="box">

    <section id="profile" class="boxes">
      <img id="pic" src="profile_images/<?= $user[0]["avatar"] ?>" alt="">
      <span id="name" ><?= $user[0]["username"] . ' ' . $user[0]["last_name"]?> </span>
      <div id="liste">
        <ul>
          <li><img class="svg" src="svg/user.svg" alt=""><a href="profile.php">My Profil</a></li>
          <li> <img class="svg" src="svg/users.svg" alt=""><a href="./groups/group_search.php">My Groups</a></li>
          <li> <img class="svg"  src="svg/book-open.svg" alt=""> <a href="#">My Pages</a></li>
          <li> <img class="svg"  src="svg/message-circle.svg" alt=""><a href="#">My Discussions</a></li>
        </ul>
      </div>
    </section>

    <section id="feed" class="boxes">
      <?php require('postsProfil.php')?>

      <div id="buttons">
        <button class="button" id="buttonPages">Pages</button>
        <button class="button" id="buttonContact">Contact</button>
      </div>

      <div id="Pages">
        <?php foreach ($results as $result):
          foreach ($pages as $page):
            foreach ($publications as $publication):
              if ($publication["pages_idpages"] == $result["pages_idpages"] && $publication["pages_idpages"] == $page["idpages"]){ ?>
                <div id="publication">
                <p id="date"><?= $result["date_publish"] ?></p>  
                  <p id="friends"><?= $result["content"] ?></p> 
                  <p><?= $page["title"] ?></p>
                  <img id="publicationImage" src= "profile_banners/<?= $result["image"] ?>">
                  
                </div>
              <?php }
            endforeach;
          endforeach;
        endforeach; ?>
          </div>
      
      <div id="Contact">
        <?php foreach ($results as $result):
          if ($result["users_iduser"] == $saveUser && $result["pages_idpages"] == NULL && $result["groups_idgroups"] == NULL){?>
              <div id="publication"> 
                <p id="username"><?= $user[0]["username"] . ' ' . $user[0]["last_name"] ?></p>
                <p id="date"><?= $result["date_publish"] ?></p>
                <p id="friends"><?= $result["content"] ?></p> 
                <?php if($result["image"] != NULL){ ?>
                <img id="publicationImage" src= "upload/<?= $result["image"] ?>">
                <?php } ?>
                           
              </div>
          <?php   }
          foreach ($contacts as $contact):
            if ($result["users_iduser"] == $contact["iduser"] && $result["pages_idpages"] == NULL && $result["groups_idgroups"] == NULL){ ?>
                <div id="publication"> 
                  <p id="username"><?= $contact["username"] . ' ' . $contact["last_name"] ?></p>
                  <p id="date"><?= $result["date_publish"] ?></p>
                  <p id="friends"><?= $result["content"] ?></p> 
                  <?php if($result["image"] != NULL){ ?>
                  <img id="publicationImage" src= "upload/<?= $result["image"] ?>">
                  <?php } ?>
                   
                </div>
              
            <?php  }
          endforeach;
        endforeach; 
      ?>
      </div>
    </section>
    
    <section id="contacts" class="boxes">
      <?php foreach($contacts as $contact): ?>
        <div id="contact"> 
          <img id="postPicture" src= "profile_images/<?= $contact["avatar"] ?>">
          <p id="friends"><?= $contact["username"] . ' ' . $contact["last_name"] ?></p> 
        </div>
      <?php endforeach; ?>
    </section>

  </div>

  <?php require('partials/footer.php') ?>

  <script src="Buttons.js"></script>
</body>
</html>