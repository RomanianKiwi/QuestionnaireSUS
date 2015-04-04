<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$nVersion = $_POST['NumVersion'];
$InvCode = $_POST['InviteCode'];
$idQuest = $_POST['IdQuest'];

$bdd->exec("UPDATE participer SET statut_Invitation = '1' WHERE NumVersion = ".$nVersion." AND InviteCode = ".$InvCode." AND IdQuest =  ".$idQuest.";");

?>
