<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

<<<<<<< HEAD
$reponse = $bdd->query("SELECT P.IdQuest, Q.nom, VersionSysteme, round(avg(Note),2) as Moyenne
						FROM participant P, questionnaire Q
						WHERE P.IdQuest = Q.IdQuest
						group by P.IdQuest, VersionSysteme;");
=======
$reponse = $bdd->query("SELECT P.IdQuest, Q.Nom, round(avg(Note),2) as Moyenne FROM participant P, questionnaire Q
                        WHERE P.IdQuest = Q.IdQuest
                        AND Nom=" . $_POST['Nom'] . " 
                        GROUP BY IdQuest;  ");
>>>>>>> f4c7453a785582f7ea9f24dfc6c1728fb12dbbf9

echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));

$reponse->closeCursor(); // Termine le traitement de la requête
?>

