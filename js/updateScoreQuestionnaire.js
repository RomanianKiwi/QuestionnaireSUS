    
    //update the score of the questionnaire into the database
    function updateScoreSUS(score, currentScore, nbResp, idQuest, versSystem){
        nbResp ++;
        var tempScore = parseInt(currentScore);
        var newScore = tempScore + score;

        $.ajax({
            type: "POST",
            url: "requeteAjoutScoreSUS.php",
            data: {Somme: "'" + newScore + "'", NB: "'" + nbResp + "'", IDQUESTIONNAIRE: "'" + idQuest + "'", IDVERSION: "'" + versSystem + "'"},
            async: false,
            success: function (data)
            {
                console.log("Mise a jour reussie de VersionQuestionnaire avec succes !");
            },
            error: function (result, status, err)
            {
                console.log(err);
            }
        });
    }
    
    function updateScoreSystem(score, dataSystem){
        var idQuest = dataSystem[0];
        var versSystem = dataSystem[2];
        var currentScore = dataSystem[4];
        var nbResp = dataSystem[5];
        
        updateScoreSUS(score, currentScore, nbResp, idQuest, versSystem);
    }
    
    function updatePartiper(versSystem, mailCode, idQuest, reponses, score) {
        $.ajax({
            type: "POST",
            url: "requeteMajParticiper.php",
            data: {NumVersion: "'" + versSystem + "'", InviteCode: "'" + mailCode + "'", IdQuest: "'" + idQuest + "'", Reponses: "'" + reponses + "'", Score: "'" + score + "'"},
            async: false,
            success: function (data)
            {
                console.log("Mise a jour de Participer reussie");
            },
            error: function (result, status, err) {
                console.log(err);
            }
        });
    }
                
    function setResultsUser(dataSystem, reponses, score){
        var mailCode = getUrlParameter('m');
        var idQuest = dataSystem[0];
        var versSystem = dataSystem[2];
        
        updatePartiper(versSystem, mailCode, idQuest, reponses, score);       
    }