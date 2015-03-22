<!DOCTYPE html>
<html>
    <head>
        <title>Questionnaire SUS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
        <script src="../js/jquery-2.1.3.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/fonctionsUtiles.js"></script>
        <script src="../js/loadXMLFile.js"></script>
        <script src="../js/computeScoreSUS.js"></script>
        <script src="../js/getInformationsQuestionnaire.js"></script>
        <script src="../js/updateScoreQuestionnaire.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                //called when the user submit his answers
                $("#questSUS").submit(function(e){
                    e.preventDefault();
					updateScoreSystem(computeScoreSUS());
                });		
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
