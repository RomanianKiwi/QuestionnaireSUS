<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
	session_start();
	if (isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['statut']) && isset($_SESSION['ID'])) {
			try {
        $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
    } catch (Exception $e) {
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
	<head>
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<title>Gestion carnet d'adresse</title>
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<script src="../js/jquery-2.1.3.js"></script>
		<script src="../js/bootstrap.js"></script>	
		<script src="../js/fonctionsUtiles.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.1/jquery.fittext.min.js"></script>		
	</head>


	
	<style>	
	h1,h2{
		text-align: center;
	}
	
	label{
		margin-right:10px;
	}
	
	form{
		margin-bottom:20px;
	}

	.page-header, h2{
            font-family: 'Lobster', cursive;
        }

    body {
        font-family: 'Slabo 27px', serif;
        }
	
	</style>
	
	<script type="text/javascript">
			$(document).ready(function () {
			
				var statutUtil =  "<?php echo $_SESSION['statut']; ?>" ;
				if(statutUtil != "Administrateur"){
					$(".AjoutAd").hide();
				}
			
				var iduser = parseInt('<?php echo $id_user; ?>');
				afficherListeCarnet(iduser);
				
				$("button[type='submit']").click(function (e) {
					e.preventDefault();
				});
				
				$(document).on("click", ".delete", function() {
					var res = $(this).attr('id').split(";");
					var invCode = res[0];
					var carnetid = res[1];
					supprimerUtilisateurCarnet(carnetid,invCode);
				});
				
				//
				$("h2").fitText(2,{'minFontSize':25, 'maxFontSize':30});
			});
			
			
			
				//Affiche tous les carnets dans un collapse.
				function afficherListeCarnet(id) {
					$('#contenuCarnet').children().remove();
					$('#contenuCarnet').append('<h2>Liste de vos carnets:</h2>');
					$.ajax({
						type: "POST",
						url: "requeteListeCarnet.php",
						async: false,
						dataType: 'json',
						data: 'id=' + id,
						success: function (data)
						{
							if(data.length == 0)
							{
								$('#contenuCarnet').append("<p>Vous n'avez aucun carnet d'adresse</p>")
							}
							else{
								for(var i=0; i<data.length; i++){
									$('#contenuCarnet').append('<div class="panel-group" id="accordion'+data[i].IdCarnet+'"><div class="panel panel-default"><div class="panel-heading"><h1 class="panel-title"><a class="accordeon'+data[i].IdCarnet+'" data-toggle="collapse" data-parent="#accordion'+data[i].IdCarnet+'" href="#collapse'+data[i].IdCarnet+'"><span class="glyphicon glyphicon-plus"></span>'+data[i].NomCarnet+'</a></h1></div><div id="collapse'+data[i].IdCarnet+'" class="panel-collapse collapse"><div id="body'+data[i].IdCarnet+'" class="panel-body"><table id="tabAdresses'+data[i].IdCarnet+'" class="table table-bordered"><tr><th>Adresse</th><th>Supprimer</th></tr></table></div></div></div></div>');
									afficherAdresses(data[i].IdCarnet);
									$('#body'+data[i].IdCarnet+'').append('<form><label for="email'+data[i].IdCarnet+'">Adresse: <input id="email'+data[i].IdCarnet+'" type="email" name="email'+data[i].IdCarnet+'" required></label><button type="submit" class="btn btn-primary" onClick=ajouterAdresse('+data[i].IdCarnet+'); >Ajouter Adresse</button></form><form><label for="nouveauNom'+data[i].IdCarnet+'">Nouveau nom du carnet: <input id="nouveauNom'+data[i].IdCarnet+'" type="text" name="nouveauNom'+data[i].IdCarnet+'" required></label><button type="submit" class="btn btn-primary" onClick=modifNom('+data[i].IdCarnet+'); >Modifier nom du carnet</button></form><button type="button" onClick=supprimerCarnet('+data[i].IdCarnet+'); class="btn btn-primary">Supprimer ce carnet</button>');
								}
							}
						}
					});
				}
			
			
			//Affiche les adresses d'un carnet dans le tableau.
			function afficherAdresses(numCarnet) {
				$('#tabAdresses'+numCarnet+' tr:not(:first-child)').remove();
				
				$.ajax({
					type: 'POST', 
					url: 'requeteListeAdresse2.php',
					async: false,
					dataType: 'json',
					data: 'idcarnet=' + numCarnet,
					success: function (data) {
						for(var i=0; i<data.length; i++){
							$('#tabAdresses'+data[i].IdCarnet+'').append('<tr><td>'+data[i].Email+'</td><td><a id="'+data[i].InviteCode+';'+data[i].IdCarnet+'" class="delete glyphicon glyphicon-trash"></a></td></tr>');
						}
					}
				});
			}
			
			//Ajoute une adresse à un carnet.
			function ajouterAdresse(idCarnet) {
				var adresseM = $('#email'+idCarnet+'').val();
				if(adresseM != ""){
					$.ajax({
						  type: "POST",
						  url: "requeteAjoutUtilisateur.php",
						  data: {Mail: adresseM, IDCarnet: "'" + idCarnet + "'"},
						  async: false,
						  success: function (result)
						  {
								afficherAdresses(idCarnet);
						  },
						  error : function (result, status, err) {
						  console.log(err);
						  }
					});
				}
			}
			
			// Permet de supprimer une adresse d'un carnet
			function supprimerUtilisateurCarnet(idCarnet, idCodeMail){
				$.ajax({
					type: "POST",
					url: "requeteSupprimerUtilisateurCarnet.php",
					data: {IDCarnet: "'" + idCarnet + "'", CodeMail: "'" + idCodeMail + "'"},
					async: false,
					success: function (result)
					{
						afficherAdresses(idCarnet);
					},
					error : function (result, status, err) {
						console.log(err);
					}
				});
			}
			
			//Permet l'ajout d'un carnet d'adresse
			function ajouterCarnet() {
				var iduser = parseInt('<?php echo $id_user; ?>');
				if($('#nouveauCarnet').val()!= "")
				{
					var nomC ="'"+$('#nouveauCarnet').val()+"'";
					$.ajax({
							  type: "POST",
							  url: "requeteAjoutCarnet.php",
							  data: {nomCarnet: nomC, idCreateur: "'" + iduser + "'"},
							  async: false,
							  success: function (result)
							  {
									afficherListeCarnet(iduser);
							  },
							  error : function (result, status, err) {
							  console.log(err);
							  }
					});
				}
			}
			
			//Fonction qui permet la suppresion d'un carnet d'adresse
			function supprimerCarnet(idCarnet){
				var iduser = parseInt('<?php echo $id_user; ?>');
				  $.ajax({
					  type: "POST",
					  url: "requeteSupprimerCarnet.php",
					  data: {IDCarnet: "'" + idCarnet + "'"},
					  async: false,
					  success: function (result)
					  {
						console.log("suppression réussie de "+idCarnet);
						afficherListeCarnet(iduser);
					  },
					  error : function (result, status, err) {
						console.log(err);
					  }
				  });
			}
			
			//Modifier le nom d'un Carnet
			function modifNom(idCarnet) {
				var iduser = parseInt('<?php echo $id_user; ?>');
				var nouvNom = $('#nouveauNom'+idCarnet+'').val();
				if(nouvNom != ""){
					$.ajax({
						  type: "POST",
						  url: "requeteModifierNomCarnet.php",
						  data: {Nom: "'"+ nouvNom + "'", IDCarnet: "'" + idCarnet + "'"},
						  async: false,
						  success: function (result)
						  {
								afficherListeCarnet(iduser);
						  },
						  error : function (result, status, err) {
						  console.log(err);
						  }
					});
				}
			}
			
	</script>
	
	<body>
		<?php include("menu.php"); ?>
		<div class="page-header text-center container">
            <h2 id="titleHeader">Gestion carnet d'adresse</h2>
        </div>
		<div id="contenu" class="container">
			<div id="contenuAjout" class="container">
				<h3>Ajouter un carnet:</h3>
				<div class="container">
					<form id="ajoutC" class="form-inline" role="form">
						<div class="form-group">
							<label for="nouveauCarnet">Nom du carnet: </label>
							<input class="form-control" type="text" id="nouveauCarnet" name="nouveauCarnet" placeholder="Titre du nouveau carnet" required/>
						</div>
						<button type="submit" onClick=ajouterCarnet(); class="btn btn-primary btn-sm">Ajouter ce carnet</button>
					</form>
				</div>
			</div>
			<div id="contenuCarnet" class="container">
			</div>
		</div>
	</body>
</html>