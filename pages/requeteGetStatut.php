<?php
    try {
            $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
    } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
    }

    $idQUEST = $_POST['IdQuest'];
	$iCode  = $_POST['InviteCode'];
    $nVersion = $_POST['NumVersion'];

    $reponse = $bdd->query("SELECT statut_Invitation FROM participer WHERE InviteCode = ".$iCode." AND IdQuest = ".$idQUEST." AND NumVersion = ".$nVersion." ;");

	echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));
	$reponse->closeCursor(); // Termine le traitement de la requête
?>
