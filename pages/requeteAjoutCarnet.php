<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$nom = $_POST['nomCarnet'];
$id = $_POST['idCreateur'];

echo $id;
echo $nom;

$bdd->exec("INSERT INTO carnetadresse VALUES ('',". $nom .",". $id .");");

?>

