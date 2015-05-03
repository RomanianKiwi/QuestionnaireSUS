<!DOCTYPE html>
<html>
	<head>
	
		<title>Accueil Administrateur</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
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
        }

        #logo {
        	background-color: white;
        	margin-bottom: 0 !important;
        }

        #logo img {
        	max-height: 100px;
        	margin: 0 auto;

        }

        #emptydiv {
        	width:100%;
        	background-color:#626262;
        	height:30px;
        	margin-top:0;
        	margin-bottom:40px;
        }

        .page-header, h2{
            font-family: 'Lobster', cursive;
        }

        body {
            font-family: 'Slabo 27px', serif;
        }

    </style>

	</head>
	
	<body>
		<div class="navbar" id="logo">
			<img class="img-responsive" src="../images/logo.png" alt="logoSUS"/>
		</div>
		<div class="container" id="emptydiv">
		</div>
		<div class="container">

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

							  <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>    
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