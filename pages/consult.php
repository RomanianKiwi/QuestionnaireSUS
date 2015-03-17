<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
	session_start();
	if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
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
			echo 'faiseur de merde!';
			//header("Location:logout.php");
		}
		$reponse->closeCursor();
	}
	else{
		header("Location:logout.php");
	}
	
?>

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
								console.log(version);
								for (var i = 0; i < data.length; i++) {
									if(nomSysteme != data[i].nom)
									{
										$('#contenu').append('<div class="panel-group" id="accordion'+cpt+'"><div class="panel panel-default"><div class="panel-heading"><h1 class="panel-title"><a class="accordeon'+cpt+'" data-toggle="collapse" data-parent="#accordion'+cpt+'" href="#collapse'+cpt+'"><span class="glyphicon glyphicon-plus"></span>'+data[i].nom+'</a></h1></div><div id="collapse'+cpt+'" class="panel-collapse collapse"><div id="body'+cpt+'" class="panel-body"></div></div></div></div>');
									}
									else
									{
										cpt--;
									}
									if(version != data[i].VersionSysteme)
									{
										$('#body'+cpt).append('<div class="panel-group" id="accordion'+cpt+'V'+data[i].VersionSysteme+'"><div class="panel panel-default"><div class="panel-heading"><h2 class="panel-title"><a class="accordeon'+cpt+'V'+data[i].VersionSysteme+'" data-toggle="collapse" data-parent="#accordion'+cpt+'V'+data[i].VersionSysteme+'" href="#collapse'+cpt+'V'+data[i].VersionSysteme+'"><span class="glyphicon glyphicon-plus"></span>Version '+data[i].VersionSysteme+'</a></h2></div><div id="collapse'+cpt+'V'+data[i].VersionSysteme+'" class="panel-collapse collapse"><div class="panel-body"><p>Le score de cette version est de: '+data[i].Moyenne+'</p></div></div></div></div>');
									}
									nomSysteme = data[i].nom;
									version = data[i].VersionSysteme;
									cpt++;
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