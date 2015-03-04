<!DOCTYPE html>
<html>
	<head>
	
		<meta charset="utf-8" />
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		
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
					
					<div class="form-group">
						<label for="NomSysteme" class="col-sm-3 control-label">Nom du Systeme</label>
						<div class="col-sm-4">
							<input id="NomSysteme" type="text" class="form-control" placeholder="Nom du Systeme a évalué" required>
						</div>
					</div>
					
					<div class="form-group">
						<label id="dateId" for="date" class="col-sm-3 control-label">Date de création du Questionnaire</label>
						<div class="col-sm-4">
							<input id="dateDebut"  class="form-control" placeholder="Date de Debut">
						</div>
					</div>
					
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
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
							<button id="ajouter" type="submit" class="btn btn-primary">Ajouter</button>
							
						</div>
					</div>
					
					
				</form>
	
	</body>
	
</html>