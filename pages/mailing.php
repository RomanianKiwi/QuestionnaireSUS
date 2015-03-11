<!DOCTYPE html>
<html>

	<style>	
	h1{
		text-align: center;
	}
	</style>

	<head>
	
		<meta charset="iso-8859-1" />
		<title>Invitation de participants</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		
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
							$('#choixQuestionnaire').append("<option value='choix"+i+"'>"+data[i].Nom+"</option>");
					}
				}
				});
			}
			afficherListeQuestionnaires();
		});
</script>
		
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
                                        $('#choixQuestionnaire').append("<option value='choix"+i+"'>"+data[i].Nom+"</option>");
                                }
                        }
                    });
                }
                
                afficherListeQuestionnaires();
                
            });

        </script>
        
	<body>			
		<?php include("menu.php"); ?>
		<h1>Invitation de participants</h1>
		<form id="formMail" class="form-horizontal" role="form" action="" method="post">
			<div class="row">
				<div class="form-group">
						<label for="objet" class="col-sm-3 control-label">Objet: </label>
						<div class="col-sm-4">
							<input id="objet" type="text" class="form-control" placeholder="Objet de votre message" required>
						</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="choixQuestionnaire" class="col-sm-3 control-label">Choix Questionnaire: </label>
					<div class="col-sm-4">
						<select id="choixQuestionnaire" class="form-control" required>
						<!--<option value="choix1">Choix questionnnaire 1</option>
						<option value="choix2">Choix questionnnaire 2</option>
						<option value="choix3">Choix questionnnaire 3</option>
						<option value="choix4">Choix questionnnaire 4</option>-->
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="destinataires" class="col-sm-3 control-label">Destinataires: </label>
					<div class="col-sm-4">
						<textarea id="destinataires" class="form-control" rows="4" placeholder="Indiquez le/les destinataires" required></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label for="message" class="col-sm-3 control-label">Message: </label>
					<div class="col-sm-4">
						<textarea id="message" class="form-control" rows="4" placeholder="Votre message ici" required></textarea>
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
		</p>
	</body>
</html>
	