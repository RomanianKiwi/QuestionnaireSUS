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
				$('#formAjout').on('submit', function(e) {
					//console.log($('#user').val());
					$.ajax({
						type: "POST",
						url: "adminAccueil.php",
						data : { login : "'"+$('#user').val()+"'", mdp : "'"+$('#mdp').val()+"'", statut : "'"+$('#statut').val()+"'"},

						async: false,
						dataType: 'json',
						success: function (data)
						{
							//Mauvais identifiants
							if(data.length == 0){
								$('#accueil').append("<p>Mauvais identifiants </p>");
								$('#echec').show().delay(1000).fadeOut(500);
								console.log("erreur de mdp ou id");
								console.log(data);
							}
							//Bons identifiants
							else{
								console.log(data);
								$('#succes').show().delay(1000).fadeOut(500);
								$('#accueil').append("<p>"+data[0].UserName+" , mdp : "+data[0].Password+"</p>");
							}
						}
					});

					
				});
				$('.alert').hide();
            });
			

        </script>

	</head>
	
	<body>
		<div class="container">
			<div class="panel-group" id="accordion">


			
				<form id="formAjout" class="form-horizontal" role="form">
					<div class="form-group" >
						<div class="col-sm-8">
							<div class="input-group">

							  <span class="input-group-addon glyphicon glyphicon-user"></span>    
							  <input id ="user" type="text" class="form-control" placeholder="Utilisateur">
							</div>
						</div>
						
						
					</div>
					<div class="form-group">
						<div class="col-sm-8">
							<div class="input-group">

							  <span class="input-group-addon glyphicon glyphicon-lock"></span>    
							  <input id ="mdp" type="password" class="form-control" placeholder="Mot de passe">
							</div>
						</div>
						
						
					</div>
					
					<div class="form-group">
						<div class="col-sm-8">
							<div class="input-group">   
							  	<select id="statutChoix" class="form-control">
							  			<option>Administrateur</option>
							  			<option>Evaluateur</option>
								</select>
							</div>
						</div>
						
						
					</div>
					
					<button type="submit" class="btn btn-primary">Connexion</button>

				</form>
				
				<div id="echec" class="alert alert-danger">Echec de la connexion.</div>
					
				<div id="succes" class="alert alert-success">Connexion valide !</div>
			</div>
		</div>
	</body>
	
</html>