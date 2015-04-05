<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$nomEnquete = "Parions Sport";
$urlIni = "http://localhost/QuestionnaireSUS/pages/formulaire.php";

//foncin qui hashe une chaine de caractère
function hashMail($Email) {
    $test = hash('md5', $Email);
    $retval = base_convert($test, 16, 10);
    return $retval;
}

$reponse = $bdd->query('SELECT * FROM utilisateurs');

//Ici je génère les adresses url et à la place de while remplace par ta boucle for qui parcourt les adresses selectionnées
//j'ai pris comme exemple de selectionnées toutes les adresses mails de la base
while ($donnees = $reponse->fetch())
{
    $mailHascher = hashMail($donnees['Email']);
    $nomHasher = hashMail($nomEnquete);
    $message = $urlIni . "?c=" . $mailHascher . "&n=" . $nomHasher;
    echo $message;
    echo "<br/><br/>";
    //ici tu envoies le mail à chaque fois dans la boucle for
    //mail($destinataire,$sujet,$message,$header);
}

$reponse->closeCursor();


?>
