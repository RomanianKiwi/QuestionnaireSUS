<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$numVer = $_POST['NumVersion'];
$idQ = $_POST['IdQuest'];

$requete0 = "SET foreign_key_checks = 0;"; 
$requete1 = "DELETE FROM participer WHERE NumVersion = " . $numVer . " AND IdQuest = " . $idQ . ";";
$requete2 = "DELETE FROM versionquestionnaire WHERE NumVersion = " . $numVer . " AND IdQuest = " . $idQ . ";";
$requete3 = "SET foreign_key_checks = 1"; 
$bdd->exec($requete1.$requete0.$requete2.$requete3);
?>
