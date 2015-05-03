<?php
	try {
        $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
	
	$quest = $_POST['IdQuest'];
	$nv = $_POST['NumVersion'];
	
	$reponse = $bdd->query("SELECT Email, Reponses, Score FROM participer P, utilisateurs U WHERE P.InviteCode = U.InviteCode AND IdQuest = ".$quest." AND NumVersion = ".$nv."  AND statut_Invitation = 1;");
	echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));
	$reponse->closeCursor(); // Termine le traitement de la requête
?>
