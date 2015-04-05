    function computeVersionScore(nameSystem, numVersion){
        var scoreVersion = 0;
        var i = 0;
        
        $('.checkbox' + nameSystem + 'Version' + numVersion + ':checked').each(function(index){
            var value = $(this).attr("value");
            scoreVersion += parseInt(value);
            i++;
        });
        
        if(i == 0){
            scoreVersion = 0;
         }
        else{
            scoreVersion = scoreVersion / i;
        }
  
        return scoreVersion.toFixed(2);
    }
    
    function getScoreVersions(nameSystem, nbVersion){
        var scoreVersions = new Array();
        
        for(var i=0; i<nbVersion; i++){
            var j = i + 1;
            scoreVersions[i] = parseInt($("#score" + nameSystem + "Version" + j)[0].innerHTML);
        }
        
        return scoreVersions;
    }

    function updateScoreWhenCheckboxesAreChanged(nameSystem, numVersion){
        var scoreVersion = computeVersionScore(nameSystem, numVersion);
        $("#score" + nameSystem + "Version" + numVersion).text(scoreVersion);
    }
