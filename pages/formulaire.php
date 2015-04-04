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
        <script src="../js/checkExpirationDate.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                console.log(getCurrentDate());
                console.log(checkExpirationDate());
                //called when the user submit his answers
                $("#questSUS").submit(function(e){
                    e.preventDefault();
		    updateScoreSystem(computeScoreSUS());
                    console.log(getAnswersToString());
                });		
            });
            
            function hideButtonLanguage(){
                $(".btn-lang").hide();
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1 class="col-xs-offset-5">Questionnaire SUS</h1>
            </div>
            <div id="contentSUS" class="row">
                <form id="questSUS"></form>
            </div>
            <div class="row" style="margin-top:20px;">
                <button class="btn btn-default btn-lang" type="button" onclick="loadXMLDoc('../questionnaires/quest_fr.xml'),hideButtonLanguage()">Français</button>
                <button class="btn btn-default btn-lang" type="button" onclick="loadXMLDoc('../questionnaires/quest_en.xml'),hideButtonLanguage()">Anglais</button>
                <button class="btn btn-default btn-lang" type="button" onclick="loadXMLDoc('../questionnaires/quest_es.xml'),hideButtonLanguage()">Espagnol</button>
                <button class="btn btn-default btn-lang" type="button" onclick="loadXMLDoc('../questionnaires/quest_de.xml'),hideButtonLanguage()">Allemand</button>
            </div>
        </div>
    </body>
</html>
