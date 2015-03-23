<?php
try {
$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
die('Erreur : ' . $e->getMessage());
}

$idCode = $_POST['CodeMail'];

$requete = "UPDATE utilisateurs SET IdCarnet = 0 WHERE InviteCode = " . $idCode . ";";
$bdd->exec($requete);
?>