<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$mail = $_POST['Mail'];
$idCarnet = $_POST['IDCarnet'];

 /*$mail = "dylan2@gmail.com";
  $idCarnet = "'1'"; */

function hashMail($Email) {
    $test = hash('md5', $Email);
    $retval = base_convert($test, 16, 10);
    return $retval;
}

$mailHascher = hashMail($mail);

$testBool = "false";

$reponse = $bdd->query('SELECT * FROM utilisateurs');

while ($donnees = $reponse->fetch())
{
    if($mailHascher == $donnees['InviteCode'])
        $testBool = "true";
}

$reponse->closeCursor();

if($testBool == "false"){
    //etape 1 : inserer utilisateur dans la table utilisateurs si il n'existe pas déjà :
    $etape1 = "INSERT INTO utilisateurs VALUES ('" . $mailHascher . "' , '" . $mail . "', NULL, NULL);";
}
else
    $etape1 = "";

//etape 2 : inserer dans gerer le code hashé et le code du carnet en cours :
$etape2 = "INSERT INTO gerer VALUES (" . $idCarnet . ", '" . $mailHascher . "');";

//echo $etape1 . " " . $etape2;

$bdd->exec($etape1 . $etape2);

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
