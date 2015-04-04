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
			$id_user =$_SESSION['ID'];
			$reponse = $bdd->query("SELECT * FROM administrateur WHERE UserName= \"". $log . "\"AND PassWord = \"". $mpass ."\"AND Statut = \"". $statut ."\";");
			$donnees = $reponse->fetch(PDO::FETCH_ASSOC);
				
			if($donnees['UserName'] != "" && $donnees['PassWord'] != "" && $_SESSION['login'] != "" && $donnees['Statut'] != ""){
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
	<style>	
	h1{
		text-align: center;
	}

	label{
		margin-right:10px;
		margin-top:8px;
	}
	
	form{
		margin-bottom:20px;
	}
	</style>

	<head>
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Consultation des r&eacute;sultats</title>
		<link rel="stylesheet" href="../css/bootstrap.css">
		<script src="../js/jquery-2.1.3.js"></script>
		<script src="../js/bootstrap.js"></script>		
		<script src="../js/fonctionsUtiles.js"></script>
		
        <script src="../js/highcharts.js"></script>
        <script src="../js/modules/exporting.js"></script>
        <script src="../js/generateChart.js"></script>
		
		<script type="text/javascript">

            $(document).ready(function () {
				
				var statutUtil =  "<?php echo $_SESSION['statut']; ?>" ;
				if(statutUtil != "Administrateur"){
					$(".AjoutAd").hide();
				}
				
				var iduser = parseInt('<?php echo $id_user; ?>');
				
				affichageCollapses(iduser);
				affichageGraphiques(iduser);

				$(".ajouter").click(function (e) {
					e.preventDefault();
				});
				
            });
			
			 function ajouterEnquete() {
					console.log("ok");
					var idUtil = <?php echo $_SESSION['ID']; ?>;
                    var d = new Date();

                    var month = d.getMonth() + 1;
                    var day = d.getDate();

                    var output = d.getFullYear() + '-' +
                            (month < 10 ? '0' : '') + month + '-' +
                            (day < 10 ? '0' : '') + day;
                    ajoutQuestionnaire($("#nomQuestionaire").val(), output, idUtil, $("#ajoutVersion").val(), $("#systemeDate").val());
             }
				
			function affichageCollapses(iduser){
				$('#contenu').children().remove();
				$.ajax({
					type: "POST",
					url: "enquetes.php",
					async: false,
					dataType: 'json',
					data: 'iduser=' + iduser,
					success: function (data)
					{
						if (data.length == 0)
							$('#contenu').append("<p>Aucun questionnaire remplie</p>");
						else {
								var nomSysteme = "";
								var cpt=0;
								
								for (var i = 0; i < data.length; i++) {
									if(nomSysteme != data[i].Nom)
									{
										$('#contenu').append('<div class="panel-group" id="accordion'+cpt+'"><div class="panel panel-default"><div class="panel-heading"><h1 class="panel-title"><a class="accordeon'+cpt+'" data-toggle="collapse" data-parent="#accordion'+cpt+'" href="#collapse'+cpt+'"><span class="glyphicon glyphicon-plus"></span>'+data[i].Nom+'</a></h1></div><div id="collapse'+cpt+'" class="panel-collapse collapse"><div id="body'+cpt+'" name='+data[i].IdQuest+' class="panel-body"><h3 class="col-xs-offset-5">Liste des versions</h3></div></div></div></div>');
									}
									else
									{
										cpt--;
									}
									if(data[i].Moyenne == null){
										data[i].Moyenne = 0;
									}
									$('#body'+cpt).append('<div class="panel-group" id="accordion'+cpt+'V'+data[i].NumVersion+'"><div class="panel panel-default"><div class="panel-heading"><h2 class="panel-title"><a class="accordeon'+cpt+'V'+data[i].NumVersion+'" data-toggle="collapse" data-parent="#accordion'+cpt+'V'+data[i].NumVersion+'" href="#collapse'+cpt+'V'+data[i].NumVersion+'"><span class="glyphicon glyphicon-plus"></span>Version '+data[i].NumVersion+'</a></h2></div><div id="collapse'+cpt+'V'+data[i].NumVersion+'" class="panel-collapse collapse"><div class="panel-body"><p>Le score de cette version est de: '+data[i].Moyenne+'</p><button type="button" onClick=supprimerVersion('+data[i].NumVersion+','+data[i].IdQuest+'); class="btn btn-primary ajouter">Supprimer cette version</button></div></div></div></div>');
									nomSysteme = data[i].Nom;
									cpt++;
								}
								for (var i = 0; i < cpt; i++){
									$('#body'+i).append('<form><label for="ajouV'+i+'">Version: <input id="ajoutV'+i+'" type="number" min=2 name="ajoutV'+i+'" required></label><label for="ajoutV'+i+'date">Date d\'expiration: <input id="ajoutV'+i+'date" type="text" placeholder="format aaaa-mm-jj" name="ajoutV'+i+'date" required></label><button type="submit" class="btn btn-primary ajouter" onClick=ajouterVersion('+i+'); >Ajouter Version</button></form>');
								}
							}
						}
					});
			}
			
			function affichageGraphiques(iduser){
				$.ajax({
					type: "POST",
					url: "enquetes.php",
					async: false,
					dataType: 'json',
					data: 'iduser=' + iduser,
					success: function (data)
					{
						if (data.length == 0)
						{
							
						}
						else {
								var nomSysteme = "";
								var cpt_s=0;
								var cpt_v=0;
								var tab_systemes = new Array();
								var tab_systemes_version = new Array();
								var tab_systemes_version_res = new Array();
								
								for (var i = 0; i < data.length; i++) {
									if(nomSysteme != data[i].Nom)
									{
										tab_systemes[cpt_s] = data[i].Nom;
										tab_systemes_version[cpt_s] = new Array();
										tab_systemes_version_res[cpt_s] = new Array();
										cpt_v=0;
										tab_systemes_version[cpt_s][cpt_v] = data[i].NumVersion;
										if(data[i].Moyenne == null){
											data[i].Moyenne = 0;
										}
										tab_systemes_version_res[cpt_s][cpt_v] = parseInt(data[i].Moyenne);
									}
									else
									{
										cpt_s--;
										tab_systemes_version[cpt_s][cpt_v] = data[i].NumVersion;
										if(data[i].Moyenne == null){
											data[i].Moyenne = 0;
										}
										tab_systemes_version_res[cpt_s][cpt_v] = parseInt(data[i].Moyenne);
									}
									nomSysteme = data[i].Nom;
									cpt_s++;
									cpt_v++;
								}
								for (var j = 0; j < tab_systemes.length; j++)
								{
									$('#body'+j).append('<h3 class="col-xs-offset-5">Graphique des résultats</h3><div id="chartContainer'+j+'" class="col-xs-6" style="margin-left : 6%;"></div>');
									generateChart(j,tab_systemes[j],tab_systemes_version[j],tab_systemes_version_res[j]);
								}
						}
					}		
				});
			}
			
			function ajouterVersion(idBody){
				var iduser = parseInt('<?php echo $id_user; ?>');
				console.log(iduser);
				var numV = $('#ajoutV'+idBody).val();
				var date = $('#ajoutV'+idBody+'date').val();
				var idQuestionnaire = $('#body'+idBody).attr('name');
				
				$.ajax({
					type: "POST",
					url: "ajoutVersion.php",
					async: false,
					data: {NumVersion: numV, IdQuest: idQuestionnaire, DateExpiration: "'" +date+ "'"},
					success: function (result)
					{
						affichageCollapses(iduser);
						affichageGraphiques(iduser);
					},
					error: function (result, status, err) {
                            console.log("err");
                    }					
				});
			}
			
			function supprimerVersion(NumV,idQ){
				var iduser = parseInt('<?php echo $id_user; ?>');
				$.ajax({
					type: "POST",
					url: "SupprimerVersion.php",
					async: false,
					data: {NumVersion: NumV, IdQuest: idQ},
					success: function (result)
					{
						affichageCollapses(iduser);
						affichageGraphiques(iduser);
					}		
				});
			}
			
			
			function ajoutQuestionnaire(nom, dateCreation, idAmin, NumVersion, DateExpiration) {
					var iduser = parseInt('<?php echo $id_user; ?>');
                    $.ajax({
                        type: "POST",
                        url: "requeteAjoutQuestionnaire.php",
                        data: {NomQuest: nom, Date: "'" + dateCreation + "'", ID: "'" + idAmin + "'", NV: "'" + NumVersion + "'", DE: "'" + DateExpiration + "'"},
                        async: false,
                        success: function (result)
                        {
							affichageCollapses(iduser);
							affichageGraphiques(iduser);
                        },
                        error: function (result, status, err) {
                            console.log(err);
                        }
                    });
                }			
        </script>
		
		
	</head>
	<body>
		<?php include("menu.php"); ?>
		<div class="container">
			<div class="row">
				<h2>Ajouter une nouvelle enquête</h2>
				<form id="formAjout" class="form-inline" role="form">
					<div class="form-group">
						<label for="nomQuestionaire" class="control-label">Nom du Questionnaire <input id="nomQuestionaire" type="text" placeholder="Nom du Questionnaire" required></label>
					</div>
					<div class="form-group">	
						<label for="ajoutVersion">Version <input id="ajoutVersion" type="number" min=1 name="ajoutVesion" required></label>
					</div>
					<div class="form-group">
						<label for="systemeDate">Date d'expiration <input id="systemeDate" type="text" placeholder="format aaaa-mm-jj" name="systemeDate" required></label>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-1">
							<button type="submit" class="btn btn-primary ajouter" onClick=ajouterEnquete()>Ajouter</button>
						</div>
					</div>
				</form>
			</div>
			<div class="row">
				<h2>Mes enquêtes</h2>
				<div id="contenu"></div>
			</div>
		</div>
	</body>
</html>