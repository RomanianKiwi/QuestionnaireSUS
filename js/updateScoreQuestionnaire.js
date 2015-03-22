    
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
            dataType: 'json',
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
    
    function updateScoreSystem(score){
        var code, idQuest, nameSystem, nbResp, versSystem, currentScore;
        var dataSystem = new Array();
        
        //we get the hash code of the questionnaire in the current url
        code = getUrlParameter('c');
        
        //we get all datas of this questionnaire
        dataSystem = getNoteLastVersionAndNomSysteme(code);  
        idQuest = dataSystem[0];
        nameSystem = dataSystem[1];
        versSystem = dataSystem[2];
        currentScore = dataSystem[4];
        nbResp = dataSystem[5];
        
        updateScoreSUS(score, currentScore, nbResp, idQuest, versSystem);
    }