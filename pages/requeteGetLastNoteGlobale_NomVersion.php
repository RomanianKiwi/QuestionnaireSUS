<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	$reponse = $bdd->query("SELECT NumVersion, DateExpiration, SommeNote, NbReponses, V.IdQuest, Nom FROM versionquestionnaire V, questionnaire Q
							WHERE V.IdQuest = Q.IdQuest
							AND V.IdQuest in (SELECT IdQuest FROM questionnaire WHERE Nom in (SELECT SysName FROM syshash WHERE HashCode = ". $_POST['Code']."))
							ORDER BY NumVersion DESC LIMIT 1;");
	
	echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));
	$reponse->closeCursor(); // Termine le traitement de la requête
?>

