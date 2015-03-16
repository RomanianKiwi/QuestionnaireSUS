<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$nom = $_POST['UserName'];
$mdp = $_POST['PassWord'];
$statut = $_POST['Statut'];
$bdd->exec("INSERT INTO administrateur VALUES (''," . $nom . "," . $mdp . "," . $statut . ")");
/*
  $req = $bdd->prepare("INSERT INTO administrateur VALUES ('',:nom,:mdp);");
  $req->execute(array(
  'nom' => $nom,
  'mdp' => $mdp
  )); */
?>