<?php

try {
        $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

$newNom = $_POST['Nom'];
$idCarnet = $_POST['IDCarnet'];

$bdd->exec("UPDATE carnetadresse SET NomCarnet = " . $newNom . " WHERE IdCarnet = " . $idCarnet . ";");
?>
