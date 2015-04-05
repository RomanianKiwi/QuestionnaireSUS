<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	
	$idcarnet = $_POST['idcarnet'];
	
	$reponse = $bdd->query("SELECT Email,G.InviteCode,G.IdCarnet FROM carnetadresse C, utilisateurs U, gerer G WHERE '".$idcarnet."' = G.IdCarnet AND G.IdCarnet = C.IdCarnet AND G.InviteCode = U.InviteCode;");
	echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));
	$reponse->closeCursor(); // Termine le traitement de la requête
?>