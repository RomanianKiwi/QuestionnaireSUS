<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$nom = $_POST['NomQuest'];
$dateC = $_POST['Date'];
$ident = $_POST['ID'];

$bdd->exec("INSERT INTO questionnaire VALUES ('',". $nom ."," . $dateC . "," . $ident . ")");

?>

