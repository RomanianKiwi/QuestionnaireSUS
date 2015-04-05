<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$idCarnet = $_POST['IDCarnet'];
$idCode = $_POST['CodeMail'];

$requete = "DELETE FROM gerer WHERE IdCarnet = " . $idCarnet . "AND InviteCode = " . $idCode . ";";
$bdd->exec($requete);
?>
