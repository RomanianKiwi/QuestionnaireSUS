<!DOCTYPE html>
<html>
	<head>
	
		<title>Accueil Administrateur</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.css">
		<script src="../js/jquery-2.1.3.js"></script>
		<script src="../js/bootstrap.js"></script>	
        <script src="../js/fonctionsUtiles.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function() {
				
				$('.alert').hide();
            });
			

        </script>
		 <style>

        body {
            background-color: #F7F7F9;
			padding-top: 100px;
        }

        #wrapper {
            position: absolute;
            top: 25%;
            width: 100%;
        }

        form {
            border: 2px solid lightgrey;
            padding-top: 50px;
            padding-bottom: 20px;
			padding-left: 40px;
			
        }
    </style>

	</head>
	
	<body>
		<div class="container" id="wrapper">


			
				<form id="formAjout" class="form-horizontal" role="form" method="post" action="creationSession.php">
					<div class="form-group" >
						<div class="col-sm-8">
							<div class="input-group">

							  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>    
							  <input id ="user" name="login" type="text" class="form-control" placeholder="Utilisateur">
							</div>
						</div>
						
						
					</div>
					<div class="form-group">
						<div class="col-sm-8">
							<div class="input-group">

							  <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>    </span>    
							  <input id ="mdp" name="password" type="password" class="form-control" placeholder="Mot de passe">
							</div>
						</div>
						
						
					</div>
					
					<div class="form-group">
						<div class="col-sm-8">
							<div class="input-group">   
								<select id="statut" name="statut" class="form-control" style="border-radius: 8px;">
							  			<option>Administrateur</option>
							  			<option>Evaluateur</option>
								</select>
							</div>
						</div>
						
						
					</div>
					
					<INPUT Type="submit" name="submit" Value="Connexion" class="btn btn-primary">
					

				</form>
				
				<div id="echec" class="alert alert-danger">Echec de la connexion.</div>
					
				<div id="succes" class="alert alert-success">Connexion valide !</div>
			
		</div>
	</body>
	
</html>