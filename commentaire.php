<!DOCTYPE html >
<html lang="en">
    <head>
        <title>Mon blog</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link href="style.css" rel="stylesheet" type="text/css" /> 
    </head>
        
    <body>
        <h1>Mon super blog !</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>
 
<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('SELECT idavis, content,  FROM comments WHERE idavis = ?');
$req->execute(array($_GET['comments']));
$donnees = $req->fetch();
?>

<div class="news">
    <h3>
        
    </h3>
    
    <p>
    <?php
    echo nl2br(htmlspecialchars($donnees['content']));
    ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
$req->closeCursor(); 


$req = $bdd->prepare('SELECT posts_users_iduser, comments,  FROM comments WHERE idavis = ? ');
$req->execute(array($_GET['comments']));

while ($donnees = $req->fetch())
{
?>
<p><strong><?php echo htmlspecialchars($donnees['posts_users_iduser']); ?></strong></p>
<p><?php echo nl2br(htmlspecialchars($donnees['comments'])); ?></p>
<?php
} 
$req->closeCursor();
?>
</body>
</html>