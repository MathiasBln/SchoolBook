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
}
else{
    header('Location: logout.php');
    exit;
}
// REQUEST NOTIFICATION NUMBER
$get_req_num = $frnd_obj->request_notification($_SESSION['user_id'], false);
// TOTAL FRIENDS
$get_frnd_num = $frnd_obj->get_all_friends($_SESSION['user_id'], false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo  $user_data->username;?></title>
    <link rel="stylesheet" href="./css/notif.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body style="background-color:white">
    <div class="profile_container">
       
    <div class="inner_profile" style="background: url(<?= 'profile_banners/' . $_SESSION['banner']?>) no-repeat center; background-size: cover;height: 40vh">
            <div class="img">
            <img src="<?= 'profile_images/' . $_SESSION['avatar']?>" alt="Profile image">
            </div>
            <h1><?php echo  $user_data->username;?> <?php echo  $user_data->last_name;?></h1>
            <div> 

        
                <form action="" method="post">
                <input type="text" name="serch" class="input_search"> <input type="submit" name="envoyer" value="Search" class="btn_search" style="background-color:#0c82b9 ; color:white; height:40px; border:none;">
         </form>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="profile.php" rel="noopener noreferrer" class="active">Profile</a></li>
                <li><a href="notifications.php" rel="noopener noreferrer">requests<span class="badge <?php
                if($get_req_num > 0){
                    echo 'redBadge';
                }
                ?>"><?php echo $get_req_num;?></span></a></li>
                
                
                <li><a href="recherche.php" rel="noopener noreferrer" >Search</a></li>
                <li><a href="friends.php" rel="noopener noreferrer">My Friends<span class="badge"><?php echo $get_frnd_num;?></span></a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>

            </ul>
        </nav>
        <div class="all_users">
            <h3>Search Friends</h3>
            <div class="usersWrapper">
            <?php 
                include("db.php");
                if(isset($_POST['envoyer'])){
                    $nom=$_POST['serch'];
                            
                    $allhopital=$pdo->query('SELECT * FROM users WHERE  username LIKE "%'.$nom.'%" ');

                    if($allhopital->rowCount()>0){


                        while($row=$allhopital->fetch())
                        {
                            $username= $row['username'];
                            $image= $row['avatar'];
                            $id=$row['iduser'];
                            echo '<div class="user_box">
                            <div class="user_img"><img src="profile_images/'.$image.'" alt="Profile image"></div>
                            <div class="user_info"><span>'.$username.'</span>
                            <span><a href="user_profile.php?id='.$id.'" class="see_profileBtn">voir le profile</a></div>
                        </div>';
                        }
        
        
                    } 
                } else{
                    // affiche moi all users si je ne fait pas de recherches
                        if($all_users){
                            foreach($all_users as $row){
                                echo '<div class="user_box">
                                <div class="user_img" style="background-image: url(profile_images/'.$row->avatar.'" alt="Profile image) no-repeat center; background-size: cover; width: 100px; height: 100px; border-radius: 50%"></div>
                                <div class="user_info"><span>'.$row->username.'</span>
                                <span><a href="user_profile.php?id='.$row->iduser.'" class="see_profileBtn">voir le profile</a></div>
                            </div>';
                            }
                        }
                        else{
                            echo '<h4>il aucun membre!</h4>';
                        }
                }
        
            ?>
            
                    
            </div>
        </div>
        
    </div>
</body>
</html>