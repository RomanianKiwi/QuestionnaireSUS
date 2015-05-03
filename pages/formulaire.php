<!DOCTYPE html>
<html>
    <head>
        <title>Questionnaire SUS</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="../css/formulaire.css" />
        <link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <script src="../js/jquery-2.1.3.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/fonctionsUtiles.js"></script>
        <script src="../js/loadXMLFile.js"></script>
        <script src="../js/computeScoreSUS.js"></script>
        <script src="../js/getInformationsQuestionnaire.js"></script>
        <script src="../js/updateScoreQuestionnaire.js"></script>
        <script src="../js/checkExpirationDate.js"></script>
        <script src="../js/listFilesXml.js"></script>
        <script src="../js/checkStatutInvitationOfUser.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.1/jquery.fittext.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){                
                var dataSystem = new Array();
                var statut;
                var urlSurveyMonkey;


                //we make the h1 header's text responsive
                $("h1").fitText(2,{'minFontSize':22, 'maxFontSize':30});

                //we get the hash code of the questionnaire and the user's mail in the current url
                var sysCode = getUrlParameter('c');
                var mailCode = getUrlParameter('m');
                
                 
                //we get all datas of this questionnaire
                dataSystem = getNoteLastVersionAndNomSysteme(sysCode, mailCode);

                if(dataSystem.length != 0) {
                    //we check the expiration date of the questionnaire
                    checkExpirationDate(dataSystem);
                    //we check if the user has already answer to the questionnaire
                    statut = getStatutInvitationUser(dataSystem[0],dataSystem[2],dataSystem[5]);
                    
                    if (statut == 1) {
                            $("#titleSUS").hide();
                            hideLanguagesOptionAndStartButton();
                            $("#questSUS").hide();
                            $("#contentSUS").append("<h2 style='margin-top: 25%; text-align: center; color: red;'>Ooops ! Wrong way ! :(</h2>" +
                                                    "<p style='text-align: center;'>It seems you have already completed the questionnaire or the URL is incorrect.</p>");                        
                    }
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
                $("#surveyExplications").hide();
            }
            
            function endQuestionnaire(){
                $("#questSUS").hide();
                $("#contentSUS").append("<h2 style='margin-top:25%; color: green; text-align: center;'>Success !</h2>" +
                                                    "<p style='text-align: center;'>Thanks you for your participation.</p>");
            }
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
        <div class="page-header text-center">
                <h1 id="titleSUS">SUS Questionnaire for </h1>
            </div>
        <div id="mainContent" class="container">
            
            <div id="contentSUS" class="row" style="margin-top:2%;">
                <form id="questSUS"></form>
            </div>
            <div id="buttonContainer" class="row text-center" style="margin-top:10%;">
                <h3>Welcome, choose your language</h3>
                <div class="col-xs-4 col-md-4" style="float:none; margin:0 auto;">
                    <select class="form-control" id="languagesAvailables">
                        <option disabled selected></option>
                    </select>
                </div>
            </div>
            <div id="surveyExplications" class="row" style="margin-top:7%; text-align: center;">
                <div class="container">
                    <p>When you click on the Start button, you might be redirected towards a SurveyMonkey form.<br/>
                   Please note that the information is only meant to help us better analyze the results of the Questionnaire.<br/> 
                   Thank you for your participation!</p>
                </div>
            </div>
            <div id="startContent" class="container" style="margin-top:1%; text-align: center;"></div>
        </div>
    </body>
</html>
