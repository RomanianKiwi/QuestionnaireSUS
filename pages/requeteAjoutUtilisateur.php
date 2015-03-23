<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$mail = $_POST['Mail'];
$idCarnet = $_POST['IDCarnet'];

/* $mail = "dylan@gmail.com";
  $idCarnet = "'4'"; */

function hashMail($Email) {
    $test = hash('md5', $Email);
    $retval = base_convert($test, 16, 10);
    return $retval;
}

$mailHascher = hashMail($mail);
//echo $mailHascher;

$bdd->exec("INSERT INTO utilisateurs VALUES ('" . $mailHascher . "' , '" . $mail . "', NULL, NULL," . $idCarnet . ");");

/* fonction ajax : 
  function ajoutUtilisateur(mail, idCarnet){

  $.ajax({
  type: "POST",
  url: "requeteAjoutUtilisateur.php",
  data: {Mail: mail, IDCarnet: "'" + idCarnet + "'"},
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
  ajoutUtilisateur("mail@test", 4); //ligne de test
 *  */
?>
