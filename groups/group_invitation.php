<?php 
require('../includes/pdo.php');

//save information from the URL 
$id_gpe = $_GET['id_gpe'];

//Start session
session_start();
if(!isset($_SESSION['user'])){
  header('Location:index.php');
  die();
}

//save information of the user connect
$maRequeteUsers = $pdo->prepare("SELECT * FROM users WHERE token=?");
$maRequeteUsers->execute(array($_SESSION["user"]));
$user = $maRequeteUsers->fetchAll();
$saveUser = $user[0]['iduser'];

//listing of friends User.
$maRequeteContact = $pdo->prepare("SELECT * FROM users u, relation r WHERE r.user_one = :saveUser AND r.user_two = u.iduser");
$maRequeteContact->execute([
  ":saveUser" => $saveUser,
]);
$maRequeteContact->setFetchMode(PDO::FETCH_ASSOC);
$contacts = $maRequeteContact->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/invite_gpe.css" type="text/css">
    <link rel="stylesheet" href="../css/groupe.css" type="text/css">
    <link rel="stylesheet" href="../css/header.css" type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title> Invite friends </title>
</head>
<body>
<?php require('../partials/header-group.php'); ?>

<section id="contacts" class="boxes">
      <?php foreach($contacts as $contact): ?>
                <div id="contact" class="m-4"> 
                    <img id="postPicture" src= "../profile_images/<?= $contact["avatar"] ?>">
                    <p id="friends"><?= $contact["username"] . ' ' . $contact["last_name"] ?></p>
                    <a class="btn btn-success" href="addInGroup.php?id=<?= $contact["iduser"] ?>&amp;gpe=<?= $id_gpe ?>">Send Invitation</a>
                </div>
      <?php endforeach; ?>
</section>
    
</body>
</html>

