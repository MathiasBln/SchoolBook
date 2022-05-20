<?php

// Vérifier si le formulaire est soumis 
if ( isset($_POST['submit'])) {
    $page = $page[0]['idpages'];
    $content = $_POST['content'];
    

    if ($_FILES['file']['name'] == ""){
        $query = $pdo->prepare("INSERT INTO posts (`content`, `pages_idpages`) VALUES (:content, :idpages)");
        $query->execute([
            ":content" => $content,
            ":idpages" => $page,
        ]);
        header('Location: page.php?=$page');
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

            $query = $pdo->prepare("INSERT INTO posts (`content`, `image`, `pages_idpages`) VALUES (:content, :imageFile, :idpages)");
            $query->execute([
                ":content" => $content,
                ":imageFile" => $file,
                ":idpages" => $page,
            ]);
            header('Location: page.php?id=$page');
        }
    }
}
       
?>


<form id="post" action="" method="POST" enctype="multipart/form-data" >
    <img id="postPicture" src=<?= $page[0]["avatar"] ?> alt="">
    <input id="textZone" name="content" placeholder="Write something there..">
    <img id="hr" src="svg/hr.svg" alt="">
    <div id="submit">
        <input type="file" name="file">
        <button type="submit" name="submit">Post</button>
    </div>
</form>

