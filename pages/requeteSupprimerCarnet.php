<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$idCarnet = $_POST['IDCarnet'];

//on supprime les invitations dans la table participer
//$etape1 = "DELETE FROM participer WHERE InviteCode IN (SELECT InviteCode FROM utilisateurs WHERE IdCarnet = " . $idCarnet . ");";

//on supprime les codes utilisaterus dans la table gerer mais on laisse les donnees d'utilisateur si d'autres carnet l'utilisent :
$etape2 = "DELETE FROM gerer WHERE IdCarnet = " . $idCarnet . ";";

// enfin, on supprime le carnet
$etape3 = "DELETE FROM carnetadresse WHERE IdCarnet = " . $idCarnet . ";";
        

$bdd->exec($etape2 . $etape3);
?>
