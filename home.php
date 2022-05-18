<?php
session_start();
if(!isset($_SESSION['user'])){
  header('Location:index.php');
  die();
}

require('includes/pdo.php');

$maRequete = $pdo->prepare("SELECT * FROM users WHERE token=?");
$maRequete->execute(array($_SESSION["user"]));
$user = $maRequete->fetchAll();
$test = $user[0]['iduser'];

$contactTest = $pdo->prepare("SELECT * FROM users u, relation r WHERE r.users_iduser = :test AND r.users_iduser1 = u.iduser");
$contactTest->execute([
  ":test" => $test
]);
$contactTest->setFetchMode(PDO::FETCH_ASSOC);
$contacts = $contactTest->fetchAll();

$post = $pdo->prepare("SELECT * FROM users_has_pages uhp WHERE uhp.users_iduser = :test");
$post->execute([
  ":test" => $test
]);
$post->setFetchMode(PDO::FETCH_ASSOC);
$publications = $post->fetchAll();

$test1 = $pdo->prepare("SELECT * FROM posts p");
$test1->execute();
$test1->setFetchMode(PDO::FETCH_ASSOC);
$results = $test1->fetchAll();

$test2 = $pdo->prepare("SELECT * FROM pages p");
$test2->execute();
$test2->setFetchMode(PDO::FETCH_ASSOC);
$pages = $test2->fetchAll();




// $responses = $pdo->prepare("SELECT * FROM posts p, comments c WHERE p.idposts=c.posts_idposts");
// $responses->execute([
//   ":user" => $test
// ]);
// $responses->setFetchMode(PDO::FETCH_ASSOC);
// $commentaries = $responses->fetchAll();


?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
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
      <img id="pic" src=<?= $user[0]["avatar"] ?> alt="">

      <span id="name" ><?= $user[0]["name"] . ' ' . $user[0]["last_name"]?> </span>
      <div id="liste">
        <ul>
          <li><img class="svg" src="svg/user.svg" alt="">
          <a href="#">My Profil</a></li>
          <li> <img class="svg" src="svg/users.svg" alt=""><a href="#">My Groups</a></li>
          <li> <img class="svg"  src="svg/book-open.svg" alt=""> <a href="#">My Pages</a></li>
          <li> <img class="svg"  src="svg/message-circle.svg" alt=""><a href="#">My Discussions</a></li>
        </ul>
      </div>
    
    </section>

    <section id="feed" class="boxes">
      <div id="post">
        <img id="postPicture" src=<?= $user[0]["avatar"] ?> alt="">
        <input id="textZone" name="Post" type="text"
        placeholder="Write something there..">
        <img id="hr" src="svg/hr.svg" alt="">
        <br>
        <div id="submit">
          <button name="Pictures">Pictures</button>

          <button type="submit">Post</button>
        </div>

        
      </div>

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
              <p id="friends"><?= $result["content"] ?></p> 
              <p><?= $page["title"] ?></p>
              <img id="publicationImage" src= <?= $result["image"] ?>>
              <p id="date"><?= $result["date_publish"] ?></p> 
            </div>
        <?php   }
          endforeach;
        endforeach;
      endforeach; 
      ?>
          </div>
      
      <div id="Contact">
      <?php foreach ($results as $result):
              foreach ($contacts as $contact):
                  if ($result["users_iduser"] == $contact["iduser"] && $result["pages_idpages"] == NULL && $result["groups_idgroups"] == NULL){ ?>
            <div id="publication"> 
              <p><?= $contact["name"] . ' ' . $contact["last_name"] ?></p>
              <p id="friends"><?= $result["content"] ?></p> 
              <p><?= $page["title"] ?></p>
              <img id="publicationImage" src= <?= $result["image"] ?>>
              <p id="date"><?= $result["date_publish"] ?></p> 
            </div>
        <?php   }
        endforeach;
      endforeach; 
      ?>
      </div>
      
      
    </section>
    
    <section id="contacts" class="boxes">
      <?php foreach($contacts as $contact): ?>
      <div id="contact"> 
        <img id="postPicture" src= <?= $contact["avatar"] ?>>
        <p id="friends"><?= $contact["name"] . ' ' . $contact["last_name"] ?></p> 
      </div>
        <?php endforeach; ?>

    </section>
  </div>

<?php require('partials/footer.php') ?>

        <script src="buttons.js"></script>
</body>
</html>