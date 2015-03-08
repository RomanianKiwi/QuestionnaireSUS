<!DOCTYPE html>

<html>
	<style>	
	h1{
		text-align: center;
	}
	</style>

	<head>
	
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Consultation des résultats</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>	
		<script src="../js/fonctionsUtiles.js"></script>
		
		<script type="text/javascript">

            $(document).ready(function () {

                $.ajax({
                    type: "POST",
                    url: "enquetes.php",
                    async: false,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.length == 0)
                            $('#contenu').append("<p>Aucun questionnaire remplie</p>");
                        else {
								console.log(data);
								var nomSysteme = "";
								var version = 0;
								var cpt=0;
								for (var i = 0; i < data.length; i++) {
									if(nomSysteme != data[i].Nom)
									{
										$('#contenu').append('<div class="panel-group" id="accordion'+cpt+'"><div class="panel panel-default"><div class="panel-heading"><h1 class="panel-title"><a class="accordeon'+cpt+'" data-toggle="collapse" data-parent="#accordion" href="#collapse'+cpt+'"><span class="glyphicon glyphicon-plus"></span>'+data[i].Nom+'</a></h1></div><div id="collapse'+cpt+'" class="panel-collapse collapse"><div class="panel-body"><p>Le score de cette version est de: '+data[i].Moyenne+'</p></div></div></div></div>');
										cpt++;
									}
									nomSysteme = data[i].Nom;
								}
							}
						}
					});

            });

        </script>
		
		
	</head>
	<body>
		<?php include("menu.php"); ?>
		<h1>Consultation des résultats</h1>
		<div id="contenu" class="container">
		</div>
	</body>
</html>