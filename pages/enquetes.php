<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$id_user = $_POST['iduser'];
						
$reponse = $bdd->query("SELECT  Q.IdQuest, Nom, NumVersion, (SommeNote/NbReponses) as Moyenne, V.IdQuest
						FROM versionquestionnaire V, questionnaire Q
						WHERE V.IdQuest = Q.IdQuest  AND ID = " .$id_user. " ORDER BY Nom;");
						

echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));

$reponse->closeCursor(); // Termine le traitement de la requête
?>
