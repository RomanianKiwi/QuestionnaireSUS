<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$newNom = $_POST['Nom'];
$idCarnet = $_POST['IDCarnet'];

/*$newNom = "'test carnet'";
  $idCarnet = "'1'"; */


$bdd->exec("UPDATE carnetadresse SET NomCarnet = " . $newNom . " WHERE IdCarnet = " . $idCarnet . ";");

/* fonction ajax : 
  function modifierNomCarnet(nom, idCarnet){

  $.ajax({
  type: "POST",
  url: "requeteModifierNomCarnet.php",
  data: {Nom: "'" + nom + "'", IDCarnet: "'" + idCarnet + "'"},
  async: false,
  success: function (result)
  {
  console.log("insertion réussie de "+mail);
  //console.log(result);
  },
  error : function (result, status, err) {
  console.log(err);
  }
  });

  }
  //modifierNomCarnet("Nouveau Nom Carnet", 1); //ligne de test
 *  */
?>
