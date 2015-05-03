<?php

try {
        $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

$somme = $_POST['Somme'];
$nbrep = $_POST['NB'];
$version = $_POST['IDVERSION'];
$questID = $_POST['IDQUESTIONNAIRE'];

$bdd->exec("UPDATE versionquestionnaire SET SommeNote = ". $somme .", NbReponses = ". $nbrep ." WHERE NumVersion = ". $version ." AND IdQuest = ". $questID .";");

?>

