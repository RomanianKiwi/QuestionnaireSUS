<?php

try {
        $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

$nVersion = $_POST['NumVersion'];
$InvCode = $_POST['InviteCode'];
$idQuest = $_POST['IdQuest'];
$reponses = $_POST['Reponses'];
$score = $_POST['Score'];

$bdd->exec("UPDATE participer SET statut_Invitation = '1', Reponses = ".$reponses.", Score = ".$score." WHERE NumVersion = ".$nVersion." AND InviteCode = ".$InvCode." AND IdQuest =  ".$idQuest.";");

?>