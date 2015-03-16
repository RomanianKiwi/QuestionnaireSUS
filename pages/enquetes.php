<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$reponse = $bdd->query("SELECT P.IdQuest, Q.nom, VersionSysteme, round(avg(Note),2) as Moyenne
						FROM participant P, questionnaire Q
						WHERE P.IdQuest = Q.IdQuest
						group by P.IdQuest, VersionSysteme;");
						
$reponse = $bdd->query("SELECT  Nom, NumVersion, (SommeNote/NbReponses) as Moyenne, V.IdQuest
						FROM versionquestionnaire V, questionnaire Q
						WHERE V.IdQuest = Q.IdQuest;");
						

echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));

$reponse->closeCursor(); // Termine le traitement de la requête
?>
