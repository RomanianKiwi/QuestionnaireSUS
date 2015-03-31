<?php
    // On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
	session_start();
		 
		
		// On teste nos deux variables
		
		if (isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['statut'])) {
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
			$statut= $_SESSION['statut'];
			$reponse = $bdd->query("SELECT * FROM administrateur WHERE UserName= \"". $log . "\"AND PassWord = \"". $mpass ."\"AND Statut = \"". $statut ."\";");
			$donnees = $reponse->fetch(PDO::FETCH_ASSOC);
				
			//print_r($_SESSION['statut']);
			//if ne sert plus après la premiere id car on a vérifié ce qu'il y a en post avec la BDD.
			//Maintenant vérifié si les données dans les SESSION sont egaux avec ce qu'il y a dans la BDD
			//donc le test est effectuer au dessus.(tester si le champ que retourne la bdd n'est pas vide)
			if($donnees['UserName'] != "" && $donnees['PassWord'] != "" && $_SESSION['login'] != "" && $donnees['Statut'] != ""){
				$_SESSION['ID'] = $donnees['ID'];
				//echo 'tu es un boss xD';
			}else{
				header("Location:pages/logout.php");
				
			}
			$reponse->closeCursor();
		}else{
			header("Location:pages/logout.php");
		}		
			
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Questionnaire SUS</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="js/bootstrap.js"></script>
		<script>
		$(document).ready(function () {
				var statutUtil =  "<?php echo $_SESSION['statut']; ?>" ;
				console.log(statutUtil);
				if(statutUtil != "Administrateur"){
					$(".AjoutAd").hide();
				}
				
		});
		</script>
		
		<style type="text/css">
            .bs-example{
                margin: 20px;
            }
            li:hover {
                background-color: #D8D8D8;
            }
        </style>
    </head>
    <body>
		<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Menu</a>
		</div>
		<div class="collapse navbar-collapse" id="main-menu">
			<ul class="nav navbar-nav">
				<li><a href="../QuestionnaireSUS/pages/consult.php">Mes enquêtes</a></li>
				<li>
				<a href="../QuestionnaireSUS/pages/mailing.php">Invitation participants </a>
				</li>
				<li>
				<a href="../QuestionnaireSUS/pages/carnet.php">Gestion carnet d'adresse </a>
				</li>
				<li class="AjoutAd"><a href="../QuestionnaireSUS/pages/AjoutAdminEval.php">Ajouter évaluateur</a></li>
				<li class="AjoutAd"><a href="../QuestionnaireSUS/pages/AjoutNewLangueQuest.php">Ajouter nouvelle langue</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a id="deco" href="../QuestionnaireSUS/pages/logout.php" class="dropdown-toggle" >Déconnexion</a></li>
			</ul>
		</div>
	</div>
</nav>
    </body>
</html>