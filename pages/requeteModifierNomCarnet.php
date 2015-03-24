<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$newNom = $_POST['Nom'];
$idCarnet = $_POST['IDCarnet'];

$bdd->exec("UPDATE carnetadresse SET NomCarnet = " . $newNom . " WHERE IdCarnet = " . $idCarnet . ";");
?>
