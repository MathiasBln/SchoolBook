<!DOCTYPE html >
<html lang="en">
    <head>
        <title>SchoolBook</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="style.css" rel="stylesheet" type="text/css" /> 
    </head>
        
    <body>
        <h1>SchoolBook</h1>
        <p>Derniers commentaires :</p>
 
<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


$req = $bdd->query('SELECT idavis, content, FROM comments ORDER BY date_creation DESC LIMIT 0, 5');

while ($donnees = $req->fetch())
{
?>
<div class="news">
    <h3>
    </h3>
    
    <p>
    <?php
    echo nl2br(htmlspecialchars($donnees['content']));
    ?>
    <br />
    <em><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em>
    </p>
</div>
<?php
}
$req->closeCursor();
?>
</body>
</html>