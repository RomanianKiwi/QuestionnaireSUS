    function computeScoreSUS(){
        var scoreTotal = 0;
        
        $(".answerSUS:checked").each(function(index){
            var value = $(this).attr("data-value");
            if(((index+1) % 2) == 0){
                scoreTotal += Math.abs(value-5);
            }
            else{
                scoreTotal += Math.abs(value-1);
            }
        });
        
        return scoreTotal * 2.5;
    }
    
    function getAnswersToString(){
        var answers = "";
        
        $(".answerSUS:checked").each(function(index){
            var answer = $(this).attr("data-value");
            
            if(index == 0){
                answers += answer;
            }
            answers += "," + answer;
        });
        
        return answers;
    }

    

