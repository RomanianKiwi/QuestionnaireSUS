<?php
	try {
        $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
	
	$id= $_POST['id'];
	
	$reponse = $bdd->query("SELECT * FROM carnetadresse where ID = '".$id."'");
	echo json_encode($reponse->fetchAll(PDO::FETCH_ASSOC));
	$reponse->closeCursor(); // Termine le traitement de la requête
?>