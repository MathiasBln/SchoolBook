<?php
// $dbname = 'db_schoolbook';
// $username = 'root';
// $password = 'root';

// $pdo = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);

// $maRequete = $pdo->prepare("SELECT * FROM `groups` WHERE idgroups=1");
// $maRequete->execute();
// $names = $maRequete->fetchAll(PDO::FETCH_ASSOC);
// var_dump($names);

//$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$dbname = 'db_schoolbook';
$username = 'root';
$password = 'root';

$pdo = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
// Pkoi pas de ; à la fin de la requête sql ici ?
//1ère vérification : la requête sort bien un résultat limité ici à 2 rows (car sinon c 500 rows !!).

$maRequete = $pdo->prepare("SELECT * FROM `groups`, `users`, `groups_has_users`, `posts`, `comments` 
                            WHERE groups_has_users.groups_idgroups = 10
                            AND groups_has_users.users_iduser = iduser
                            AND posts.groups_idgroups = 9
                            AND posts.idposts = idposts
                            LIMIT 2");

$maRequete->execute();
$groups = $maRequete->fetchAll(PDO::FETCH_ASSOC);

var_dump($groups[0]);

?>

<img src=<?php echo($groups[0]["image"]);?> alt='image'>

<h1><?php echo($groups[0]["name"]);?></h1>
<h1><?php echo($groups[0]["description"]);?></h1>
