<?php
$dbname = 'db_schoolbook';
$username = 'root';
$password = 'root';

$pdo = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);

$maRequete = $pdo->prepare("SELECT * FROM `groups` WHERE idgroups=1");
$maRequete->execute();
$names = $maRequete->fetchAll(PDO::FETCH_ASSOC);
var_dump($names);
?>

<img src=<?php echo($names[0]["image"]);?> alt='image'>

<h1><?php echo($names[0]["name"]);?></h1>
<h1><?php echo($names[0]["description"]);?></h1>
