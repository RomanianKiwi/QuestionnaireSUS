<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
	session_start();
	if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
		/*
		print_r($_SESSION['login']);
		echo "<br/>";
		print_r($_SESSION['password']);
		*/
		
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
		}
		catch (Exception $e)
		{
				die('Erreur : ' . $e->getMessage());
		}
		$log = $_SESSION['login'];
		$mpass = $_SESSION['password'];
		$reponse = $bdd->query("SELECT * FROM administrateur WHERE UserName= \"". $log . "\"AND PassWord = \"". $mpass ."\";");
		$donnees = $reponse->fetch(PDO::FETCH_ASSOC);
	
		/* echo "<br/>";
		echo $donnees['UserName'];
		echo "<br/>";
		echo $donnees['PassWord'];
		echo "<br/>"; */
			
		//if ne sert plus après la premiere id car on a vérifié ce qu'il y a en post avec la BDD.
		//Maintenant vérifié si les données dans les SESSION sont egaux avec ce qu'il y a dans la BDD
		//donc le test est effectuer au dessus.(tester si le champ que retourne la bdd n'est pas vide)
		if($donnees['UserName'] != "" && $donnees['PassWord'] != "" && $_SESSION['login'] != ""){
			echo 'tu es un boss';
		}else{
			header("Location:logout.php");
		}
		$reponse->closeCursor();
	}
	else{
		header("Location:logout.php");
	}
	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                function ajoutAdmin(nom, mdp,statut) {
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
						error : function (result, status, err) {
							console.log(err);
						}
                    });
				}
					
					
					$('#formAjout').on('submit', function(e) {
						ajoutAdmin($("#nom").val(),$("#motdepasse").val(),$("#statut").val());
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
        <!--<h3 style="text-align:center">Formulaire d'ajout d'un Admin/Evaluateur</h3>-->
        <form id="formAjout" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="nom" class="col-sm-3 control-label">Nom</label>
                <div class="col-sm-4">
                    <input id="nom" type="text" class="form-control" placeholder="Nom" required>
                </div>
            </div><!--
            <div class="form-group">
                <label for="prenom" class="col-sm-3 control-label">PrÃ©nom</label>
                <div class="col-sm-4">
                    <input id="prenom" type="text" class="form-control" placeholder="PrÃ©nom" required>
                </div>
            </div>
            <div class="form-group">
                <label for="mail" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-4">
                    <input id="email" type="text" class="form-control" placeholder="Email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="tel" class="col-sm-3 control-label">TÃ©lÃ©phone</label>
                <div class="col-sm-4">
                    <input id="tel" type="text" class="form-control" placeholder="NumÃ©ro de tÃ©lÃ©phone" required>
                </div>
            </div>
            <div class="form-group">
                <label id="dateId" for="date" class="col-sm-3 control-label">Date Inscription</label>
                <div class="col-sm-4">
                    <input id="dateInsc" class="form-control" placeholder="Date de l'inscription">
                </div>
            </div>-->
			<div class="form-group">
                <label id="mdp" class="col-sm-3 control-label">mot de passe</label>
                <div class="col-sm-4">
                    <input id="motdepasse" class="form-control" placeholder="Mot de passe">
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