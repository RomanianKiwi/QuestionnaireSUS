<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query("SELECT P.IdQuest, Q.nom, round(avg(Note),2) as Moyenne FROM participant P, questionnaire Q
                        WHERE P.IdQuest = Q.IdQuest
                        AND nom=" . $_POST['nomSyst'] . " 
                        GROUP BY IdQuest;  ");

echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));

$reponse->closeCursor(); // Termine le traitement de la requête
?>

