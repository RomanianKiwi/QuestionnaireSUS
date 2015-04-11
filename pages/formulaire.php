<!DOCTYPE html>
<html>
    <head>
        <title>Questionnaire SUS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="../css/formulaire.css" />
        <script src="../js/jquery-2.1.3.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/fonctionsUtiles.js"></script>
        <script src="../js/loadXMLFile.js"></script>
        <script src="../js/computeScoreSUS.js"></script>
        <script src="../js/getInformationsQuestionnaire.js"></script>
        <script src="../js/updateScoreQuestionnaire.js"></script>
        <script src="../js/checkExpirationDate.js"></script>
        <script src="../js/listFilesXml.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){                
                var dataSystem = new Array();

                //we get the hash code of the questionnaire and the user's mail in the current url
                var sysCode = getUrlParameter('c');
                var mailCode = getUrlParameter('m');
                
                 
                //we get all datas of this questionnaire
                dataSystem = getNoteLastVersionAndNomSysteme(sysCode, mailCode);

                if(dataSystem.length != 0) {
                    //we check the expiration date of the questionnaire
                    checkExpirationDate(dataSystem);    
                }

                //custom the title of this page
                $("#titleSUS").append(" "+dataSystem[1]);

                //generation of the languages availables
                generateLanguageList(listFilesXML());

                
                //called when the user click on the button Start
                $("#startQuestionnaire").click(function(){
                   var urlFile = $(".languageOption:selected").attr("data-value");
                   
                   if(urlFile != null){
                       loadXMLDoc("../questionnaires/" + urlFile);
                       hideLanguagesOptionAndStartButton();
                   }
                });
                
                //called when the user submit his answers
                $("#questSUS").submit(function(e){
                    e.preventDefault();
		    updateScoreSystem(computeScoreSUS(),dataSystem);
                    setResultsUser(dataSystem,getAnswersToString(),computeScoreSUS());
                    endQuestionnaire();
                });		
            });
            
            function hideLanguagesOptionAndStartButton(){
                $("#buttonContainer").hide();
                $("#startQuestionnaire").hide();
            }
            
            function endQuestionnaire(){
                $("#questSUS").hide();
                $("#contentSUS").append("<h2 style='margin-top:25%; color: green; text-align: center;'>Success !</h2>" +
                                                    "<p style='text-align: center;'>Thanks you for your participation.</p>");
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1 id="titleSUS" style="text-align: center;">Questionnaire SUS of</h1>
            </div>
            <div id="contentSUS" class="row" style="margin-top:2%;">
                <form id="questSUS"></form>
            </div>
            <div id="buttonContainer" class="row" style="margin-top:18%; text-align: center;">
                <h3>Welcome, choose your language</h3>
                <select id="languagesAvailables">
                    <option disabled selected></option>
                </select>
                <!--
                <button class='btn btn-default' type='button' onclick="loadXMLDoc('../questionnaires/quest_fr.xml'),hideButtonLanguage()">French</button>
                <button class='btn btn-default' type='button' onclick="loadXMLDoc('../questionnaires/quest_en.xml'),hideButtonLanguage()">English</button>
                <button class='btn btn-default' type='button' onclick="loadXMLDoc('../questionnaires/quest_es.xml'),hideButtonLanguage()">Spanish</button>
                <button class='btn btn-default' type='button' onclick="loadXMLDoc('../questionnaires/quest_de.xml'),hideButtonLanguage()">German</button>
                -->
            </div>
            <div class="row" style="margin-top:1%; text-align: center;">
                <button id="startQuestionnaire" class="btn btn-success" type="button">Start</button>
            </div>
        </div>
    </body>
</html>
