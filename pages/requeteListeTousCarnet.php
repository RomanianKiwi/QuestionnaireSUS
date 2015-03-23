<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	
	$reponse = $bdd->query("SELECT * FROM carnetadresse;");
	echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));
	$reponse->closeCursor(); // Termine le traitement de la requête
?>