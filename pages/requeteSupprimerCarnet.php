<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$idCarnet = $_POST['IDCarnet'];

/*$newNom = "'test carnet'";
  $idCarnet = "'1'"; */

//on supprime les invitations dans la table participer
$etape1 = "DELETE FROM participer WHERE InviteCode IN (SELECT InviteCode FROM utilisateurs WHERE IdCarnet = " . $idCarnet . ");";

// on supprime tous les utilisaterus du carnet � supprimer
$etape2 = "DELETE FROM utilisateurs WHERE IdCarnet = " . $idCarnet . ";";

// enfin, on supprime le carnet
$etape3 = "DELETE FROM carnetadresse WHERE IdCarnet = " . $idCarnet . ";";


        

$bdd->exec($etape1 . $etape2 . $etape3);

/* fonction ajax : 
  function supprimerCarnet(idCarnet){

  $.ajax({
  type: "POST",
  url: "requeteSupprimerCarnet.php",
  data: {IDCarnet: "'" + idCarnet + "'"},
  async: false,
  success: function (result)
  {
  console.log("suppression r�ussie de "+idCarnet);
  //console.log(result);
  },
  error : function (result, status, err) {
  console.log(err);
  }
  });

  }
  //supprimerCarnet(4); //ligne de test
 *  */
?>
