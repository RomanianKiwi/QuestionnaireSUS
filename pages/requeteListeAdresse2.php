<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	
	$idcarnet = $_POST['idcarnet'];
	
	$reponse = $bdd->query("SELECT Email,InviteCode,U.IdCarnet FROM carnetadresse C, utilisateurs U WHERE '".$idcarnet."' = U.IdCarnet AND U.IdCarnet = C.IdCarnet;");
	echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));
	$reponse->closeCursor(); // Termine le traitement de la requête
?>