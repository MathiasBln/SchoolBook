<?php 
require('../includes/pdo.php');

$group = intval($_GET['id_gpe']);
$sql = $pdo->prepare("SELECT * FROM groups WHERE idgroups= :gpe");
$sql->execute([ ":gpe" => $group]);
$result = $sql->fetchAll();

var_dump($group);

if(isset($_POST)) {

    var_dump($_POST);

    if(isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['img']) && !empty($_POST['img'])){
        $name = strip_tags($_POST['name']);
        $description = strip_tags($_POST['description']);
        $img = strip_tags($_POST['img']);

        $query = $pdo->prepare("UPDATE groups SET name=:name,  description=:description, image=:img WHERE idgroups=:id;");

        $query->execute([
       ":name" => $name,
       ":description" => $description,
       ":image" => $image,
       ":id" => $group
        ]);

    };

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap nav-bar style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Change Data</title>
</head>
<body>

<h1>Modifier le groupe</h1>
<form method="POST" enctype="multipart/form-data">
<label>Name</label>
<input type="text" value="<?= $result[0]["name"]; ?>" name="name">
<label>Description</label>
<textarea type="textarea" name="description"><?= $result[0]["description"]; ?></textarea>
<label>Change the picture</label>
<input type="file"
       accept="image/png, image/jpeg" name="img"> 
<button>SUBMIT</button>
</form>



</body>
</html>