<?php

// check if the form is submit
if ( isset($_POST['submit'])) {
    $user = $user[0]['iduser'];
    $content = $_POST['content'];
    
    //if $_FILES is empty add information without image
    if ($_FILES['file']['name'] == ""){
        $query = $pdo->prepare("INSERT INTO posts (`content`, `users_iduser`, `groups_idgroups`) VALUES (:content, :id, :id_grp)");
        $query->execute([
            ":content" => $content,
            ":id" => $user,
            ":id_grp" => $id_gpe
        ]);
    //if $_FILES is full add information with image
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
            move_uploaded_file($tmpName, './assets/'.$file);

            $query = $pdo->prepare("INSERT INTO posts (`content`, `image`, `users_iduser`, `groups_idgroups`) VALUES (:content, :imageFile, :id, :id_grp)");
            $query->execute([
                ":content" => $content,
                ":imageFile" => $file,
                ":id" => $user,
                ":id_grp" => $id_gpe
            ]);
        }
    }
}
       
?>


<form id="post" action="" method="POST" enctype="multipart/form-data" >
    <input id="textZone" name="content" placeholder="Write something there..">
    <img id="hr" src="svg/hr.svg" alt="">
    <div id="submit">
        <input type="file" name="file">
        <button type="submit" name="submit">Post</button>
    </div>
</form>

