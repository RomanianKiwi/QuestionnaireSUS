    
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
                console.log("Mise a jour reussie avec succes !");
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
    
    function updatePartiper(versSystem, mailCode, idQuest) {
        $.ajax({
            type: "POST",
            url: "requeteMajParticiper.php",
            data: {NumVersion: "'" + versSystem + "'", InviteCode: "'" + mailCode + "'", IdQuest: "'" + idQuest + "'"},
            async: false,
            success: function (data)
            {
                console.log("Mise à jour de Participer réussie");
            },
            error: function (result, status, err) {
                console.log(err);
            }
        });
    }
                
    function setActiveToOneToUser(dataSystem){
        var mailCode = getUrlParameter('m');
        var idQuest = dataSystem[0];
        var versSystem = dataSystem[2];
        
        updatePartiper(versSystem, mailCode, idQuest);       
    }