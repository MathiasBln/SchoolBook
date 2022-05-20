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
   /*  $banner = htmlspecialchars($_POST['banner']); */
   if(isset($_POST['envoyer'])){
    $banner = htmlspecialchars($_POST['banner']); 
    $dossier = "profile_banners/";
 // On récupère les infos de l'utilisateur
 $check_banner  = $pdo->prepare('SELECT banner FROM users WHERE token = :token');
 $check_banner->execute(array(
     "token" => $_SESSION['user']
 ));
 $data_banner = $check_banner->fetch();

    if(!is_dir($dossier)){
        mkdir($dossier);
    }

    $fichier = basename($_FILES['banner']['name']);
    $fichier_extension = strtolower(substr(strrchr($_FILES['banner']['name'], '.'), 1)) ;

    // on va passer au cryptage du fichier cad changer son nom
    $fichier = md5(uniqid(rand(), true)) . '.' . $fichier_extension;
  
    
    if(move_uploaded_file($_FILES['banner']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
    {
        // on vient supprimer s'il y'avait déja une image
        if(file_exists("profile_banners/" . $_SESSION['banner']) && isset($_SESSION['banner'])){
            unlink("profile_banners/" . $_SESSION['banner']);
        }

        // on insére le fichier 
        $req = $pdo->prepare('UPDATE users SET banner = :banner WHERE token = :token');

        $req->execute(array(
           "banner" => $fichier, 
           "token" => $_SESSION['user']));
        // on va venir remettre a jour variable banner que contient fichier
        $_SESSION['banner'] = $fichier;


        /* echo 'Upload effectué avec succès !'; */
        header('location: profile.php?err=success_upload');
        exit;
           
    }
    else
    {
        header('location: profile.php');
        exit;
        /* echo 'Echec de l\'upload !'; */
    }
}
?>