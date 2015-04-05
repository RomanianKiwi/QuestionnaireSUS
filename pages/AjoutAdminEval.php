<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['statut']) && isset($_SESSION['ID'])) {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $log = $_SESSION['login'];
    $mpass = $_SESSION['password'];
    $statut = $_SESSION['statut'];
    $reponse = $bdd->query("SELECT * FROM administrateur WHERE UserName= \"" . $log . "\"AND PassWord = \"" . $mpass . "\"AND Statut = \"" . $statut . "\";");
    $donnees = $reponse->fetch(PDO::FETCH_ASSOC);

    //print_r($_SESSION['ID']);
    //if ne sert plus après la premiere id car on a vérifié ce qu'il y a en post avec la BDD.
    //Maintenant vérifié si les données dans les SESSION sont egaux avec ce qu'il y a dans la BDD
    //donc le test est effectuer au dessus.(tester si le champ que retourne la bdd n'est pas vide)
    if ($donnees['UserName'] != "" && $donnees['PassWord'] != "" && $_SESSION['login'] != "" && $donnees['Statut'] != "") {
        if ($donnees['Statut'] == "Administrateur") {
            //echo 'tu es un boss xD';
        } else {
            header("Location:../index.php");
        }
    } else {
        header("Location:logout.php");
    }
    $reponse->closeCursor();
} else {
    header("Location:logout.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/bootstrap.css">
		<script src="../js/jquery-2.1.3.js"></script>
		<script src="../js/bootstrap.js"></script>	
        <script type="text/javascript">
            $(document).ready(function () {
                function ajoutAdmin(nom, mdp, statut) {
                    $.ajax({
                        type: "POST",
                        url: "requeteAjoutAdmin.php",
                        data: {UserName: "'" + nom + "'", PassWord: "'" + mdp + "'", Statut: "'" + statut + "'"},
                        async: false,
                        success: function (result)
                        {
                            console.log("insertion réussie");
                            console.log(result);
                        },
                        error: function (result, status, err) {
                            console.log(err);
                        }
                    });
                }


                $('#formAjout').on('submit', function (e) {
                    ajoutAdmin($("#nom").val(), $("#motdepasse").val(), $("#statut").val());
                });

                //ajoutAdmin("jeremy", "laBOC");
                /*
                 T'as juste à faire appel à la fonction ajoutAdmin(nom, mdp);
                 Et en paramètre tu mets l'identifiant et le mot de passe que l'admin que tu récupèreras dans
                 tes formulaires (avec les $.text() ).
                 Et voilà
                 */
            });
        </script>
        <style type="text/css">
            .bs-example{
                margin: 20px;
            }
            li:hover {
                background-color: #D8D8D8;
            }
        </style>
    </head>
    <body>
<?php include("menu.php"); ?>
        
        <form id="formAjout" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="nom" class="col-sm-3 control-label">Nom</label>
                <div class="col-sm-4">
                    <input id="nom" type="text" class="form-control" placeholder="Nom" required>
                </div>
            </div>
            
            <div class="form-group">
                <label id="mdp" class="col-sm-3 control-label">mot de passe</label>
                <div class="col-sm-4">
                    <input id="motdepasse" type="password" class="form-control" placeholder="Mot de passe">
                </div>
            </div>
            <div class="form-group">
                <label for="statutUtil" class="col-sm-3 control-label">Statut</label>
                <div class="col-sm-4">
                    <select id="statut" class="form-control" required>
                        <option>Evaluateur</option>
                        <option>Administrateur</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                    <button id="ajouter" type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
    </body>
</html>