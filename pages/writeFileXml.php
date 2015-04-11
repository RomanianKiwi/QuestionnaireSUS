<?php

$nom = $_POST['NameFile'];
$chaine = $_POST['StringXML'];

if (!empty($nom) && !empty($chaine)) {
    $nameFile = "../questionnaires/quest_" . $nom . ".xml";
    echo $nameFile;
    echo "<br/>";
    $file = fopen($nameFile, "w");
    echo fwrite($file, $chaine);
    fclose($file);
} else {
    echo "impossible de générer le fichier xml";
}
?> 