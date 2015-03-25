<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$numVer = $_POST['NumVersion'];

$requete1 = "DELETE FROM participer WHERE NumVersion = " . $numVer . ";";
$requete2 = "DELETE FROM versionquestionnaire WHERE NumVersion = " . $numVer . ";";
$bdd->exec($requete1,$requete2);
?>
