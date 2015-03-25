<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$nom = $_POST['NomQuest'];
$dateC = $_POST['Date'];
$ident = $_POST['ID'];

/*$nom = "hihoooo";
$dateC = "'2015-01-02'";
$ident = "'1'";*/

function hashMail($nomH) {
    $test = hash('md5', $nomH);
    $retval = base_convert($test, 16, 10);
    return $retval;
}

$nomHascher = hashMail($nom);

$etape1 = "INSERT INTO questionnaire VALUES ('', '". $nom ."'," . $dateC . "," . $ident . ");";

$etape2 = "INSERT INTO syshash VALUES ('".$nom."','". $nomHascher ."','0');";

echo $etape1 . "<br/>" . $etape2;

$bdd->exec($etape1 . $etape2);

?>

