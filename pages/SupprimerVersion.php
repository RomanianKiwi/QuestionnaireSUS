<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$numVer = $_POST['NumVersion'];
$idQ = $_POST['IdQuest'];

$requete1 = "DELETE FROM participer WHERE NumVersion = " . $numVer . " AND IdQuest = " . $idQ . ";";
$requete2 = "DELETE FROM versionquestionnaire WHERE NumVersion = " . $numVer . " AND IdQuest = " . $idQ . ";";
$bdd->exec($requete1,$requete2);
?>
