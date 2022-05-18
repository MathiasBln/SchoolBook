<?php 
require('./includes/pdo.php');
require('./includes/requests_homegpe.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/invite_gpe.css" type="text/css">
    <link rel="stylesheet" href="css/groupe.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title> Inviter vos amis </title>
</head>
<body>
<?php require('./partials/header.php'); ?>
<?php require('./partials/navigation_gpe.php'); ?>

<section>
    <h1>Bonjour <?= $userGpe[0]["first_name"]." ".$userGpe[0]["last_name"] ?> Invitez: </h1>
    <ul>
        <?php for($row = 0; $row < count($myFriendsGpe); $row++):?>
        <div class="friends-gpe">
            <li class="friend-gpe-name"><?= $myFriendsGpe[$row]["first_name"]." ".$myFriendsGpe[$row]["last_name"]?></li>
            <?php if(in_array($myFriendsGpe[$row]["id_receveur"], $alreadyUser) && in_array($id_gpe, $alreadyGpe) ):?>
                <li class="friend-gpe-link">Je suis déjà dans ce groupe</li>
            <?php else: ?>
                <li class="friend-gpe-link"><a href="./group_invitation.php?idMemberAdded=<?=$myFriendsGpe[$row]["id_receveur"]?>&idgroup=<?= $id_gpe?>">invitez ce membre</a></li>
            <?php endif; ?>
        </div>
        <?php endfor; ?>
    </ul>  
</section>

    
</body>
</html>

