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
            <title>Consultation des r&eacute;sultats</title>
            <link rel="stylesheet" href="../css/bootstrap.css">
            <link rel="stylesheet" href="../css/consult.css">
            <link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
            <script src="../js/jquery-2.1.3.js"></script>
            <script src="../js/bootstrap.js"></script>
            <script src="../js/displayChartsAndCollapses.js"></script>
            <script src="../js/addOrDeleteVersionAndQuestionnaire.js"></script>
            <script src="../js/getUserDataSUS.js"></script>
            <script src="../js/generateUserTableAndPagination.js"></script>
            <script src="../js/computeVersionScore.js"></script>
            <script src="../js/fonctionsUtiles.js"></script>	
            <script src="../js/highcharts.js"></script>
            <script src="../js/modules/exporting.js"></script>
            <script src="../js/generateChart.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.1/jquery.fittext.min.js"></script>
	    <script type="text/javascript">

            $(document).ready(function () {

            	$("h2").fitText(2,{'minFontSize':25, 'maxFontSize':30});
				
				$(".codeSM").hide();
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
				$(".codeSM2").hide();
				
				$('input[id="systemeSM"]').change(function() {
					if($('input[id="systemeSM"]').prop( "checked" )){
						$(".codeSM").show();
						$('textarea[id="systemeCode"]').prop('required',true);
					}
					else{
						$(".codeSM").hide();
						$('textarea[id="systemeCode"]').val("");
						$('textarea[id="systemeCode"]').prop('required',false);
					}
				});
				
				$('input[class="SMbox"]').change(function() {
					var idbox = $(this).val();
					if($('input[id="ajoutV'+idbox+'SMbox"]').prop( "checked" )){
						$(".code"+idbox).show();
						$('textarea[id="ajoutV'+idbox+'SMcode"]').prop('required',true);
					}
					else{
						$(".code"+idbox).hide();
						$('textarea[id="ajoutV'+idbox+'SMcode"]').val("");
						$('textarea[id="ajoutV'+idbox+'SMcode"]').prop('required',false);
					}
				});
            });		
        </script>
		
		<style type="text/css">
        .page-header, h2{
            font-family: 'Lobster', cursive;
        }

        body {
        	font-family: 'Slabo 27px', serif;
        }
        </style>
		
	</head>
    <body>
        <?php include("menu.php"); ?>
        <div class="container">
            <div class="row">
            	<div class="page-header">
                	<h2>Ajouter une nouvelle enquête</h2>
            	</div>
                <div class= "container">
                	<form "form-horizontal" id="formAjout" role="form">
                    <div class="form-group col-sm-4">
                        <label for="nomQuestionaire" class="control-label">Nom du Questionnaire <input class="form-control" id="nomQuestionaire" type="text" placeholder="Nom du Questionnaire" required></label>
                    </div>
                    <div class="form-group col-sm-4">	
                        <label for="ajoutVersion" class="control-label">Version <input class="form-control" id="ajoutVersion" type="number" min=1 name="ajoutVesion" required></label>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="systemeDate" class="control-label">Date d'expiration <input class="form-control" id="systemeDate" type="text" placeholder="format aaaa-mm-jj" name="systemeDate" required></label>
                    </div>
					<div class="form-group">
							<label for="systemeSM" class="control-label">Ajouter un questionnaire Survey Monkey <input class="form-control" id="systemeSM" type="checkbox" name="systemeSM" value="survey"/></label>
                    </div>
					<div class="form-group codeSM">
							<label for="systemeCode" class="control-label">Code HTML généré par Survey Monkey <textarea id="systemeCode" name="systemeCode" class="form-control" rows="4" placeholder="Indiquez le code HTML généré par Survey Monkey."></textarea></label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary ajouter" onClick=ajouterEnquete(<?php echo $_SESSION['ID']; ?>,<?php echo $id_user; ?>)>Ajouter</button>
                    </div>
                </form>
                </div>
            </div>
            <div class="row">
                <h2>Mes enquêtes</h2>
                <div class="container col-md-12 col-lg-12" id="contenu"></div>
            </div>
        </div>
    </body>
</html>