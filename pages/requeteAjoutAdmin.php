<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$nom = $_POST['NomU'];
$mdp = $_POST['MdpU'];
$statut = $_POST['Statut'];

$bdd->exec("INSERT INTO administrateur VALUES ('',". $nom ."," . $mdp . "," . $statut . ")");



?>

