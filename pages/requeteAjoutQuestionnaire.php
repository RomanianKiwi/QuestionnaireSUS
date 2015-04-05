
<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$nom = $_POST['NomQuest'];
$dateC = $_POST['Date'];
$ident = $_POST['ID'];
$dateExp = $_POST['DE'];
$numVersion = $_POST['NV'];

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
$bdd->exec("INSERT INTO versionquestionnaire VALUES (" . $numVersion . "," . $dateExp . ",'0','0',".$donnees["IdQuest"].");");
?>