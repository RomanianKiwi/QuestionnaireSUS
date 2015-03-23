<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$mail = $_POST['Mail'];
$idCarnet = $_POST['IDCarnet'];

function hashMail($Email) {
    $test = hash('md5', $Email);
    $retval = base_convert($test, 16, 10);
    return $retval;
}

$mailHascher = hashMail($mail);

$bdd->exec("INSERT INTO utilisateurs VALUES ('" . $mailHascher . "' , '" . $mail . "', NULL, NULL," . $idCarnet . ");");
?>
