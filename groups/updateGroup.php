<?php 
require('../includes/pdo.php');

//save information from the URL
$group = intval($_GET['id_gpe']);

//select all the information where the group id = information from the URL
$sql = $pdo->prepare("SELECT * FROM groups WHERE idgroups= :gpe");
$sql->execute([
     ":gpe" => $group
]);
$result = $sql->fetchAll();


//change data from groups without delete any information who has done
if ( isset($_POST['submit'])) {
    if ($_FILES['img']['name'] == ""){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $query = $pdo->prepare("UPDATE groups SET name=:name,  description=:description WHERE idgroups=:id;");

        $query->execute([
        ":name" => $name,
        ":description" => $description,
        ":id" => $group
        ]);
        header("Location: group_presentation.php?id_gpe=".$group);
    } else {
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
            $query = $pdo->prepare("UPDATE groups SET name=:name,  description=:description, image=:img WHERE idgroups=:id;");

            $query->execute([
            ":name" => $name,
            ":description" => $description,
            ":img" => $file,
            ":id" => $group
            ]);
            header("Location: group_presentation.php?id_gpe=".$group);
        };
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
    <title>Change Data</title>
</head>
<body>

<div id="sectionCreation">
    <div id="createGroup">
    <h1>Modify group</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="row mt-4 p-2">
            <div class="form-group col-md-6">
                <label>Name</label>
                <input class="form-control" type="text" value="<?= $result[0]["name"]; ?>" name="name">
            </div>
            <div class="form-group col-md-4">
                <label>Change the picture</label>
                <input  class="form-control" type="file" name="img"> 
            </div> 
        </div>
        <div class="form-group col-md-12 mt-4 p-2">
            <label>Description</label>
            <textarea class="form-control" type="textarea" name="description"><?= $result[0]["description"]; ?></textarea>
        </div>


        <button class="btn btn-primary m-3" type="submit" name="submit">submit</button>
    </form>
    </div>
</div>
</body>
</html>