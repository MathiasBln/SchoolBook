<?php
/* connexion à la base de donnée */
try{
    $pdo = new PDO("mysql:host=localhost:3306;dbname=db_schoolbook", "root", "");

} catch(PDOException $e)
{
    die('Erreur : '.$e->getMessage());
}

?>