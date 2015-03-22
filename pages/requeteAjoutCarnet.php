<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$nom = $_POST['nomCarnet'];
$id = $_POST['idCreateur'];

$bdd->exec("INSERT INTO carnetadresse VALUES (''," . $nom . "," . $id . ")");
//modification "UPDATE carnetadresse SET NomCarnet = " . $newName . " WHERE IdCarnet = " . $idCarnet . ";"
//suppression  "DELETE FROM carnetadresse WHERE IdCarnet = " . $idCarnet . ";"
//récupérer carnet "SELECT * FROM carnetadresse;" ou "SELECT * FROM carnetadresse WHERE ID = 3;"

?>

