<?php
/* connexion à la base de donnée */
/* try{ */
  /*   $pdo = new PDO("mysql:host=localhost;dbname=db_schoolbook", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
 */
/* } catch(PDOException $e)
{
    die('Erreur : '.$e->getMessage());
} */
$dbname = 'db_schoolbook';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
?>