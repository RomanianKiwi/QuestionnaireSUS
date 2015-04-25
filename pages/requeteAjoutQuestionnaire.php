<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$nom = $_POST['NomQuest'];
$dateC = $_POST['Date'];
$ident = $_POST['ID'];
$dateExp = $_POST['DE'];
$numVersion = $_POST['NV'];
$CodeSM = $_POST['CodeSM'];

function hashMail($nomH) {
    $test = hash('md5', $nomH);
    $retval = base_convert($test, 16, 10);
    return $retval;
}

$name2 = "'".$nom."'";
$nomHascher = "'".hashMail($nom)."'";

$etape1 = "INSERT INTO questionnaire VALUES (null, " . $name2 . "," . $dateC . "," . $ident . ");";
$etape2 = "INSERT INTO syshash VALUES (" . $name2 . "," . $nomHascher . ",'0');";

$bdd->exec($etape1 . $etape2);
$req = $bdd->query("SELECT IdQuest FROM questionnaire ORDER BY IdQuest DESC LIMIT 1;");
$donnees = $req->fetch();

if($CodeSM == "''")
	$bdd->exec("INSERT INTO versionquestionnaire VALUES (" . $numVersion . "," . $dateExp . ",".$donnees["IdQuest"].", NULL);");
else
	$bdd->exec("INSERT INTO versionquestionnaire VALUES (" . $numVersion . "," . $dateExp . ",".$donnees["IdQuest"]."," . $CodeSM . ");");

$bdd->exec("INSERT INTO versionquestionnaire VALUES (" . $numVersion . "," . $dateExp . ",".$donnees["IdQuest"].");");
?>
