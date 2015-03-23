<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$idCarnet = $_POST['IDCarnet'];
$idCode = $_POST['CodeMail'];

/*$newNom = "'test carnet'";
  $idCarnet = "'1'"; */

$requete = "UPDATE gerer SET IdCarnet = " . $idCarnet . " WHERE InviteCode = " . $idCode . ";";
$bdd->exec($requete);

/* fonction ajax : 
  function supprimerUtilisateurCarnet(idCarnet, idCodeMail){

  $.ajax({
  type: "POST",
  url: "requeteSupprimerUtilisateur.php",
  data: {IDCarnet: "'" + idCarnet + "'", CodeMail: "'" + idCodeMail + "'"},
  async: false,
  success: function (result)
  {
  console.log("archivage réussie de "+idCodeMail+" du carnet numero "+idCarnet);
  //console.log(result);
  },
  error : function (result, status, err) {
  console.log(err);
  }
  });

  }
  //supprimerUtilisateurCarnet(4, 2154454); //ligne de test
 *  */
?>
