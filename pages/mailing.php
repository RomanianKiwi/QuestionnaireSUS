<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
	session_start();
	if (isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['statut']) && isset($_SESSION['ID'])) {
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
			$statut=$_SESSION['statut'];
			$reponse = $bdd->query("SELECT * FROM administrateur WHERE UserName= \"". $log . "\"AND PassWord = \"". $mpass ."\"AND Statut = \"". $statut ."\";");
			$donnees = $reponse->fetch(PDO::FETCH_ASSOC);
				
			print_r($_SESSION['ID']);
			//if ne sert plus après la premiere id car on a vérifié ce qu'il y a en post avec la BDD.
			//Maintenant vérifié si les données dans les SESSION sont egaux avec ce qu'il y a dans la BDD
			//donc le test est effectuer au dessus.(tester si le champ que retourne la bdd n'est pas vide)
			if($donnees['UserName'] != "" && $donnees['PassWord'] != "" && $_SESSION['login'] != "" && $donnees['Statut'] != ""){
				echo 'tu es un boss xD';
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
		<title>Invitation de participants</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		
	</head>
	
		 <script type="text/javascript">
			$(document).ready(function () {
				function afficherListeQuestionnaires() {
					$.ajax({
						type: "POST",
						url: "requeteListeQuestionnaire.php",
						async: false,
						dataType: 'json',
						success: function (data)
						{
							if(data.length == 0)
								$('#choixQuestionnaire').append("<option value='choix1'>Aucun Questionnaire</option>");
							else{
								for(var i=0; i<data.length; i++)
									$('#choixQuestionnaire').append('<option value="'+data[i].Nom+'">'+data[i].Nom+'</option>');
							}
						}
					});
				}
				afficherListeQuestionnaires();
			});
		</script>
		
		<style>	
		h1{
			text-align: center;
		}
		</style>	
	</head>    
	
	<body>			
		<?php include("menu.php"); ?>
		<h1>Invitation de participants</h1>
		<form id="formMail" class="form-horizontal" role="form" action="envoiMail.php" method="post">
			<div class="row">
				<div class="form-group">
						<label for="objet" class="col-sm-3 control-label">Objet: </label>
						<div class="col-sm-4">
							<input id="objet" type="text" name="objet" class="form-control" placeholder="Objet de votre message" required>
						</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="choixQuestionnaire" class="col-sm-3 control-label">Choix Questionnaire: </label>
					<div class="col-sm-4">
						<select id="choixQuestionnaire" name="choixQuestionnaire" class="form-control" required>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="destinataires" class="col-sm-3 control-label">Destinataires: </label>
					<div class="col-sm-4">
						<textarea id="destinataires" name="destinataires" class="form-control" rows="4" placeholder="Indiquez les destinataires sur une ligne différente." required></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="message" class="col-sm-3 control-label">Message: </label>
					<div class="col-sm-4">
						<textarea id="message" name="message" class="form-control" rows="4" placeholder="Votre message ici" required></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
							<button id="envoyer" type="submit" class="btn btn-primary">Envoyer</button>						
						</div>
				</div>
			</div>
		</form>
	</body>
</html>
