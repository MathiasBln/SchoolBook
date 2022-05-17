<?php
require('./invite_gpe.php');
$idgpe = filter_input(INPUT_GET, "idgpe", FILTER_VALIDATE_INT); 
// Pour supprimer une catégorie, on a besoin de :
// - Un identifiant (en GET, sous la forme ?id=1)
$idMemberAdded = filter_input(INPUT_GET, "idMemberAdded", FILTER_VALIDATE_INT);
$idgroup = filter_input(INPUT_GET, "idgroup", FILTER_VALIDATE_INT);
// - Une requête pour supprimer
if($idMemberAdded) {
    require('./pdo_group.php');
    // Etape 1 : Je prépare ma requête
    $maRequete03 = $pdo->prepare("INSERT INTO groups_has_users (users_iduser, groups_idgroups, `status`) VALUES(:idMemberAdded, :idgroup, 0)");
    // Etape 2 : J'exécute ma requête
    $maRequete03->execute([
        ":idMemberAdded" => $idMemberAdded,
        ":idgroup" => $idgroup
    ]);
    // Y'a pas d'étape 3, parce qu'on ne fait pas de SELECT
} else {
    // - Rediriger l'utilisateur vers la page des catégories
http_response_code(302); // Found, c'est une redirection
header('Location: invite_gpe.php');
exit(); // Après une redirection, on appelle exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <h1>Membre ajouté:</h1>
</body>
</html>