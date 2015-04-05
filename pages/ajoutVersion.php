<?php

try {
   $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$numVer = $_POST['NumVersion'];
$expDate = $_POST['DateExpiration'];
$IdQuest = $_POST['IdQuest'];


$requete = "INSERT INTO versionquestionnaire VALUES ('" . $numVer . "' , " . $expDate . ", 0, 0,'" . $IdQuest . "');";
$bdd->exec($requete);
?>
