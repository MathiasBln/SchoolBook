<?php

require('../includes/pdo.php');

//Start a session
session_start();
if(!isset($_SESSION['user'])){
  header('Location: ../index.php');
  die();
}

//information of the user connected
$maRequeteUsers = $pdo->prepare("SELECT * FROM users WHERE token=?");
$maRequeteUsers->execute(array($_SESSION["user"]));
$user = $maRequeteUsers->fetchAll();
$saveUser = intval($user[0]['iduser']);

//Cut the $_FILES and add image in the assets doc
// Insert information on the tables Groups.
if ( isset($_POST['submit'])) {
        $tmpName = $_FILES['img']['tmp_name'];
        $name = $_FILES['img']['name'];
        $size = $_FILES['img']['size'];
        $error = $_FILES['img']['error'];
        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));
        $extensions = ['jpg', 'png', 'jpeg', 'gif'];

        if(in_array($extension, $extensions)){

            $uniqueName = uniqid('', true);
            $file = $uniqueName.".".$extension;
            move_uploaded_file($tmpName, './assets/'.$file);     
            $name = $_POST['name'];
            $description = $_POST['description'];
            $query = $pdo->prepare("INSERT INTO groups (name, description, image) VALUES (:name, :description, :img);
                                    SET @idgroups = LAST_INSERT_ID();
                                    INSERT INTO groups_has_users (groups_idgroups, users_iduser, status) VALUES (@idgroups, :user, 1)");
            $query->execute([
            ":name" => $name,
            ":description" => $description,
            ":img" => $file,
            ":user" => $saveUser
            ]);

            
           header("Location: group_search.php");
        };
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/groupe.css" type="text/css">
    <!-- Bootstrap nav-bar style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Create Group</title>
</head>
<body>

<div id="sectionCreation">
    <div id="createGroup">
   <h1>Create a group</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="row mt-4 p-2">
            <div class="form-group col-md-6">
                <label>Name</label>
                <input class="form-control" type="text" value="" name="name">
            </div>
            <div class="form-group col-md-4">
                <label>Change the picture</label>
                <input type="file" name="img"> 
            </div> 
        </div>
        
        <div class="form-group col-md-12 mt-4 p-2">
            <label>Description</label>
            <textarea class="form-control" type="textarea" name="description"></textarea>
        </div>
        
        <button class="btn btn-primary m-3"type="submit" name="submit">submit</button>
    </form> 
</div>
</div>



</body>
</html>