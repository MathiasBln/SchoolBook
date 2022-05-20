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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo  $user_data->username;?></title>
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body >
<?php require('partials/header.php');?>
    <div class="profile_container">
     
    <div class="contain_activites">
    <div class="all_users">
            <h3>All my friends</h3>
            <div class="usersWrapper">
                <?php
                if($get_frnd_num > 0){
                    foreach($get_all_friends as $row){
                        echo '<div class="user_box">
                        <div class="user_img" style="background-image: url(profile_images/'.$row->avatar.'" alt="Profile image) no-repeat center; background-size: cover; width: 100px; height: 100px; border-radius: 50%"></div>
                        <a href="user_profile.php?id='.$row->iduser.'"><div class="user_info"><span>'.$row->username.'</span></div></a>
                    </div>';
                    }
                }
                else{
                    echo '<h4>you don\'t have a friend</h4>';
                }
                ?>

            

            </div>
        </div>
        <section id="feed" class="boxes">
      <?php require('postsProfil.php')?>

      <div id="buttons">
        <button class="button" id="buttonPages">Pages</button>
        <button class="button" id="buttonContact">Contact</button>
      </div>

      <div id="Pages">
      </div>
    </section>
        <div class="all_posts">
            <H3>My posts</H3>
            <div class="postsWrapper">
                <?php
                    if($all_posts_users){
                        foreach($all_posts_users as $row){
                            echo '<div class="post_box">
                            <div class="post_content">
                            <h3>'.$row->username.' '.$row->last_name.'</h3>
                            <h4>'.$row->date_publish.'</h4>
                            <p>'.$row->content.'</p>
                            </div>
        
                            <div class="post_img">
                                <img src="profile_banners/'.$row->image.'" alt="image post">
                            </div>
                            
                            
                        </div>';
                        }
                    }
                    else{
                        echo '<h4>il aucun post!</h4>';
                    }
                ?>
                
            </div>
        </div>
    </div>
   
    </div>
</body>
</html>