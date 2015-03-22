<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$somme = $_POST['Somme'];
$nbrep = $_POST['NB'];
$version = $_POST['IDVERSION'];
$questID = $_POST['IDQUESTIONNAIRE'];

$bdd->exec("UPDATE versionquestionnaire SET SommeNote = ". $somme .", NbReponses = ". $nbrep ." WHERE NumVersion = ". $version ." AND IdQuest = ". $questID .";");

?>

