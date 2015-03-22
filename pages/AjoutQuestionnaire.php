<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
	session_start();
	if (isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['statut']) && isset($_SESSION['ID'])) {
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
		
		<!-- plugin Bootstrap DatePicker -->
		<link href="../css/datepicker.css" rel="stylesheet">
		<script src="../js/bootstrap-datepicker.js"></script>
		<script src="../js/dateFRtoEN.js"></script>
		
		<script type="text/javascript">

            $(document).ready(function () {

                function ajoutQuestionnaire(nom, dateCreation, idAmin) {
                    $.ajax({
                        type: "POST",
                        url: "requeteAjoutQuestionnaire.php",
                        data: {NomQuest: "'" + nom + "'", Date: "'" + dateCreation + "'", ID: "'" + idAmin + "'"},
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
						//ajoutQuestionnaire($("#NomSysteme").val(),$("#dateDebut").val(),2);
						var date = $("#datepicker").val();
						//console.log( date);
						
						//var date2 = $("#datepicker").val($.datepicker.formatdate('dd-mm-yyyy',new Date()));
						//console.log( DateFrtoEn(date));
						
						ajoutQuestionnaire($("#nomQuestionaire").val(),DateFrtoEn(date),2);
					});
				$(function() {
					$("#datepicker").datepicker({
						format : 'dd/mm/yyyy' 
					});
				});
				


				
				//ajoutQuestionnaire("GPS", "2015-03-15",2);
                
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
						<label for="nomQuestionaire" class="col-sm-3 control-label">Nom du Questionnaire</label>
						<div class="col-sm-4">
							<input id="nomQuestionaire" type="text" class="form-control" placeholder="Nom du Questionnaire" required>
						</div>
					</div>
					<!--
					<div class="form-group">
						<label for="NomSysteme" class="col-sm-3 control-label">Nom du Systeme</label>
						<div class="col-sm-4">
							<input id="NomSysteme" type="text" class="form-control" placeholder="Nom du Systeme a évalué" required>
						</div>
					</div>
					-->
					<div class="form-group">
						<label id="dateId" for="date" class="col-sm-3 control-label">Date de création du Questionnaire</label>
						<div class="col-sm-4">
							<input id="datepicker" class="form-control " placeholder="Date de Debut">
						</div>
					</div>
					<!--
					<div class="form-group">
						<label id="dateId" for="date" class="col-sm-3 control-label">Fin de validité du questionnaire</label>
						<div class="col-sm-4">
							<input id="dateFin"  class="form-control" placeholder="Date de Fin">
						</div>
					</div>
					
					<div class="form-group">
						<label for="statut" class="col-sm-3 control-label">Inclure un formulaire Démographique</label>
						<div class="col-sm-4">
							<INPUT type="radio" name="formulaireDémo" value="OUI">Oui<br>
							<INPUT type="radio" name="formulaireDémo" value="NON">Non<br>
						</div>
					</div>
					-->
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
							<button id="ajouter" type="submit" class="btn btn-primary">Ajouter</button>
							
						</div>
					</div>
					
					
				</form>
	
	</body>
	
</html>