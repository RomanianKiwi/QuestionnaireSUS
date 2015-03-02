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
	
	<!--<h3 style="text-align:center">Formulaire d'ajout d'un Admin/Evaluateur</h3>-->
	
	<form id="formAjout" class="form-horizontal" role="form">
					<div class="form-group">
						<label for="nom" class="col-sm-3 control-label">Nom</label>
						<div class="col-sm-4">
							<input id="nom" type="text" class="form-control" placeholder="Nom" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="prenom" class="col-sm-3 control-label">Prénom</label>
						<div class="col-sm-4">
							<input id="prenom" type="text" class="form-control" placeholder="Prénom" required>
						</div>
					</div>

					<div class="form-group">
						<label for="mail" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-4">
							<input id="email" type="text" class="form-control" placeholder="Email" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="tel" class="col-sm-3 control-label">Téléphone</label>
						<div class="col-sm-4">
							<input id="tel" type="text" class="form-control" placeholder="Numéro de téléphone" required>
						</div>
					</div>
					
					<div class="form-group">
						<label id="dateId" for="date" class="col-sm-3 control-label">Date Inscription</label>
						<div class="col-sm-4">
							<input id="dateInsc"  class="form-control" placeholder="Date de l'inscription">
						</div>
					</div>
					
					<div class="form-group">
						<label for="statut" class="col-sm-3 control-label">Statut</label>
						<div class="col-sm-4">
							<select id="statut" class="form-control" required>
								<option>évaluateur</option>
								<option>admin</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-10">
							<button id="ajouter" type="submit" class="btn btn-primary">Ajouter</button>
							
						</div>
					</div>
					
					
				</form>
				<?php echo "<a href=\"AjoutQuestionnaire.php\">Cliquez ici</a>";?>
				
	
	</body>
	
</html>