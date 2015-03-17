<?php
    // On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
	session_start();
		// On teste nos deux variables
		if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['statut'])) {
			$_SESSION['login']=$_POST['login'];
			$_SESSION['password']=$_POST['password'];
			$_SESSION['statut']=$_POST['statut'];
			//print_r($_POST);
			//print_r($_SESSION['login']);
			
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
			}
			catch (Exception $e)
			{
					die('Erreur : ' . $e->getMessage());
			}
			$log = $_POST['login'];
			$mpass = $_POST['password'];
			$reponse = $bdd->query("SELECT * FROM administrateur WHERE UserName= \"". $log . "\"AND PassWord = \"". $mpass ."\";");
			$donnees = $reponse->fetch(PDO::FETCH_ASSOC);
			/*
			while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
			{
				echo $donnees['UserName'];
			}
			*/
			
			/*
			$_SESSION['user']=$_POST['user'];
			$_SESSION['mdp']=$_POST['mdp'];
			*/
			//echo $_SESSION['user'];
			/*
			echo "<br/>";
			echo $donnees['UserName'];
			echo "<br/>";
			echo $donnees['PassWord'];
			echo "<br/>";
			*/
			
				if($_SESSION['login'] == strtolower($donnees['UserName']) && $_SESSION['password'] == strtolower($donnees['PassWord']) && $_SESSION['login'] != ""){
					echo 'tu es un boss';
				}else{
					//echo 'faiseur de merde!';
					header("Location:pages/logout.php");
				}
				$reponse->closeCursor();
			}
			else{
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
		<<nav class="navbar navbar-default" role="navigation">
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
				<li>
				<a id ="ajoutQuest" href="../QuestionnaireSUS/pages/AjoutQuestionnaire.php">Nouvelle enquête</a>
				</li>
				<li><a href="../QuestionnaireSUS/pages/consult.php">Consultation résultats</a></li>
				<li>
				<a href="../QuestionnaireSUS/pages/mailing.php">Invitation participants </a>
				</li>
				<li><a href="../QuestionnaireSUS/pages/AjoutAdminEval.php">Ajouter évaluateur</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a id="deco" href="../pages/logout.php" class="dropdown-toggle" >Déconnexion</a></li>
			</ul>
		</div>
	</div>
</nav>
    </body>
</html>