<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	
	$carnet = $_POST['carnet'];
	
	$reponse = $bdd->query("SELECT Email,G.InviteCode,G.idCarnet FROM carnetadresse C, utilisateurs U, gerer G WHERE '".$carnet."' = C.NomCarnet AND C.idCarnet = G.idCarnet AND G.InviteCode = U.InviteCode");
	echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));
	$reponse->closeCursor(); // Termine le traitement de la requ�te
?>