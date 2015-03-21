<!DOCTYPE html>
<html>
    <head>
        <title>Questionnaire SUS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
        <script src="../js/jquery-2.1.3.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/loadXMLFile.js"></script>
        <script src="../js/computeScoreSUS.js"></script>
        <script src="../js/replaceSystemByProductName.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#questSUS").submit(function(e){
                    e.preventDefault();
                    var scoreSUS = computeScoreSUS();
					//ajouterScoreSUS(computeScoreSUS());
                    console.log(scoreSUS);
                });
				/*
				function ajouterScoreSUS(score){
					$.ajax({
                        type: "POST",
                        url: "requeteAjoutScoreSUS.php",
                        data: {Score: "'" + score + "'"},
                        async: false,
                        dataType: 'json',
                        success: function (data)
                        {
                            console.log("insertion du score SUS dans la base de données réussie avec succès !");
                        }
						error: function( jqXHR jqXHR, String textStatus, String errorThrown )
						{
							console.log("echec de l'insertion du score SUS dans la base de données !");
						}
						
                    });*/
				}		
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1>Questionnaire</h1>
            </div>
            <div class="row">
                <form id="questSUS"></form>
            </div>
            <div class="row" style="margin-top:20px;">
                <button class="btn btn-default" type="button" onclick="loadXMLDoc('../questionnaires/quest_fr.xml')">Français</button>
                <button class="btn btn-default" type="button" onclick="loadXMLDoc('../questionnaires/quest_en.xml')">Anglais</button>
                <button class="btn btn-default" type="button" onclick="loadXMLDoc('../questionnaires/quest_es.xml')">Espagnol</button>
                <button class="btn btn-default" type="button" onclick="loadXMLDoc('../questionnaires/quest_de.xml')">Allemand</button>
            </div>
        </div>
    </body>
</html>