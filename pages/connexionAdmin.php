<!DOCTYPE html>
<html>
	<head>
	
		<title>Accueil Administrateur</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="../js/fonctionsUtiles.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function() {
				
				$('.alert').hide();
            });
			

        </script>

	</head>
	
	<body>
		<div class="container">
			<div class="panel-group" id="accordion">


			
				<form id="formAjout" class="form-horizontal" role="form" method="post" action="../index.php">
					<div class="form-group" >
						<div class="col-sm-8">
							<div class="input-group">

							  <span class="input-group-addon glyphicon glyphicon-user"></span>    
							  <input id ="user" name="login" type="text" class="form-control" placeholder="Utilisateur">
							</div>
						</div>
						
						
					</div>
					<div class="form-group">
						<div class="col-sm-8">
							<div class="input-group">

							  <span class="input-group-addon glyphicon glyphicon-lock"></span>    
							  <input id ="mdp" name="password" type="password" class="form-control" placeholder="Mot de passe">
							</div>
						</div>
						
						
					</div>
					
					<div class="form-group">
						<div class="col-sm-8">
							<div class="input-group">   
							  	<select id="statutUtil" name="statut" class="form-control">
							  			<option>Administrateur</option>
							  			<option>Evaluateur</option>
								</select>
							</div>
						</div>
						
						
					</div>
					
					<INPUT Type="submit" name="submit" Value="Connexion">
					

				</form>
				
				<div id="echec" class="alert alert-danger">Echec de la connexion.</div>
					
				<div id="succes" class="alert alert-success">Connexion valide !</div>
			</div>
		</div>
	</body>
	
</html>