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
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body >
    <div class="profile_container">
    
        <div class="inner_profile" style="background: url(<?= 'profile_banners/' . $_SESSION['banner']?>) no-repeat center; background-size: cover;height: 40vh">
      
            <div class="img">
                
                <img src="<?= 'profile_images/' . $_SESSION['avatar']?>" alt="Profile image">

            </div>
            <h1><?php echo  $user_data->username;?> <?php echo  $user_data->last_name;?></h1>
           
           
        </div>
        <nav>
            <ul>
            <li><a href="home.php" rel="noopener noreferrer">Home</a></li>
                <li><a href="profile.php" rel="noopener noreferrer" class="active">Profile</a></li>
                <li><a href="notifications.php" rel="noopener noreferrer">Requests<span class="badge <?php
                if($get_req_num > 0){
                    echo 'redBadge';
                }
                ?>"><?php echo $get_req_num;?></span></a></li>
                
                
                <li><a href="recherche.php" rel="noopener noreferrer" >Search</a></li>
                <li><a href="#" data-toggle="modal" data-target="#avatar" rel="noopener noreferrer" >Edit avatar</a></li>
                <li><a href="#" data-toggle="modal" data-target="#banner" rel="noopener noreferrer" >Edit banner</a></li>

                <li> <a href="#" data-toggle="modal" data-target="#change_password">Edit password</a></li>
                <li><a href="friends.php" rel="noopener noreferrer">My Friends<span class="badge"><?php echo $get_frnd_num;?></span></a></li>
                

            </ul>
        </nav>
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
                                <img src="upload/'.$row->image.'" alt="image post">
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
    <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit my password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                         </div>
                            <div class="modal-body">
                                <form action="change_password.php" method="POST">
                                    <label for='current_password'>Current password</label>
                                    <input type="password" id="current_password" name="current_password" class="form-control" required/>
                                    <br />
                                    <label for='new_password'>New password</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control" required/>
                                    <br />
                                    <label for='new_password_retype'>Retype a new password</label>
                                    <input type="password" id="new_password_retype" name="new_password_retype" class="form-control" required/>
                                    <br />
                                    <button type="submit" class="btn btn-success">Save</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="modal fade" id="avatar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit avatar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <form action="change_avatar.php" method="POST" enctype="multipart/form-data">
                                <label for="avatar">images allowed : png, jpg, jpeg- max 20Mo</label>
                                <input type="file" name="avatar">
                                <br />
                                <input type="submit" class="btn btn-success" name="envoyer" value="Add picture">
                                
                            </form>
         
                        </div>
            
                        <br />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="banner" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit banner</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <form action="change_banner.php" method="POST" enctype="multipart/form-data">
                                <label for="avatar">images allowed : png, jpg, jpeg- max 20Mo</label>
                                <input type="file" name="banner">
                                <br />
                                <input type="submit" class="btn btn-success" name="envoyer" value="Add picture">
                                
                            </form>
         
                        </div>
            
                        <br />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  

</body>
</html>