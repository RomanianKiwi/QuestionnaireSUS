<?php

try {
        $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
$nom = $_POST['UserName'];
$mdp = $_POST['PassWord'];
$statut = $_POST['Statut'];
$bdd->exec("INSERT INTO administrateur VALUES (''," . $nom . "," . $mdp . "," . $statut . ")");

?>