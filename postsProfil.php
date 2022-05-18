<?php

// Vérifier si le formulaire est soumis 
if ( isset($_POST['submit'])) {
    $user = $user[0]['iduser'];
    $content = $_POST['content'];
    

    if ($_FILES['file']['name'] == ""){
        $query = $pdo->prepare("INSERT INTO posts (`content`, `users_iduser`) VALUES (:content, :id)");
        $query->execute([
            ":content" => $content,
            ":id" => $user,
        ]);
        header('Location: home.php');
    } else {
        $tmpName = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $error = $_FILES['file']['error'];
        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));
        $extensions = ['jpg', 'png', 'jpeg', 'gif'];
        if(in_array($extension, $extensions)){
            $uniqueName = uniqid('', true);
            $file = $uniqueName.".".$extension;
            move_uploaded_file($tmpName, './upload/'.$file);

            $query = $pdo->prepare("INSERT INTO posts (`content`, `image`, `users_iduser`) VALUES (:content, :imageFile, :id)");
            $query->execute([
                ":content" => $content,
                ":imageFile" => $file,
                ":id" => $user,
            ]);
            header('Location: home.php');
        }
    }
}
       
?>


<form id="post" action="" method="POST" enctype="multipart/form-data" >
    <img id="postPicture" src=<?= $user[0]["avatar"] ?> alt="">
    <input id="textZone" name="content" placeholder="Write something there..">
    <img id="hr" src="svg/hr.svg" alt="">
    <div id="submit">
        <input type="file" name="file">
        <button type="submit" name="submit">Post</button>
    </div>
</form>

