<?php   
    // Démarrage de la session 
    session_start();
    require_once 'configuration.php';


    // Si la session n'existe pas 
    if(!isset($_SESSION['user']))
    {
        header('Location: index.php');
        die();
    }


    // Si les variables existent 
   /*  $avatar = htmlspecialchars($_POST['avatar']); */
   if(isset($_POST['envoyer'])){
    $avatar = htmlspecialchars($_POST['avatar']); 
    $dossier = "upload/" . $_SESSION['user'] . "/";
 // On récupère les infos de l'utilisateur
 $check_avatar  = $pdo->prepare('SELECT avatar FROM users WHERE token = :token');
 $check_avatar->execute(array(
     "token" => $_SESSION['user']
 ));
 $data_avatar = $check_avatar->fetch();

    if(!is_dir($dossier)){
        mkdir($dossier);
    }

    $fichier = basename($_FILES['avatar']['name']);
    $fichier_extension = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1)) ;

    // on va passer au cryptage du fichier cad changer son nom
    $fichier = md5(uniqid(rand(), true)) . '.' . $fichier_extension;
  
    
    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
    {
        // on vient supprimer s'il y'avait déja une image
        if(file_exists("upload/" . $_SESSION['user'] . "/" . $_SESSION['avatar']) && isset($_SESSION['avatar'])){
            unlink("upload/" . $_SESSION['user'] . "/" . $_SESSION['avatar']);
        }

        // on insére le fichier 
        $req = $pdo->prepare('UPDATE users SET avatar = :avatar WHERE token = :token');

        $req->execute(array(
           "avatar" => $fichier, 
           "token" => $_SESSION['user']));
        // on va venir remettre a jour variable avatar que contient fichier
        $_SESSION['avatar'] = $fichier;


        /* echo 'Upload effectué avec succès !'; */
        header('location: dashboard.php?err=success_upload');
        exit;
           
    }
    else
    {
        header('location: dashboard.php');
        exit;
        /* echo 'Echec de l\'upload !'; */
    }
}
?>



<!-- 
$dossier = "upload/" . $_SESSION['user'] . "/";
    $fichier = basename($_FILES['avatar']['name']);
    $taille_maxi = 100000;
    $taille = filesize($_FILES['avatar']['tmp_name']);
    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $extension = strrchr($_FILES['avatar']['name'], '.'); 
    //Début des vérifications de sécurité...
    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
    }
    if($taille>$taille_maxi)
    {
        $erreur = 'Le fichier est trop gros...';
    }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
        //On formate le nom du fichier ici...
        $fichier = strtr($fichier, 
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            echo 'Upload effectué avec succès !';
           
        }
        else //Sinon (la fonction renvoie FALSE).
        {
            echo 'Echec de l\'upload !';
        }
    }
    else
    {
        echo $erreur;
    } -->