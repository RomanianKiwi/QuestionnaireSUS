<?php
try {
        $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

$reponse = $bdd->query("SELECT * FROM administrateur WHERE UserName=". $_POST['login'] . "AND Password = ". $_POST['Password'] . "AND statut = ". $_POST['statut']);

echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));

$reponse->closeCursor(); // Termine le traitement de la requête

?>

