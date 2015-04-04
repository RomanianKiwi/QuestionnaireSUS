    //check if questionnaire is expired
    function checkExpirationDate(dataSystem){        
        return dataSystem[3] == getCurrentDate();
    }
    
    //get the current date when the user access the questionnaire
    function getCurrentDate(){
        var currentdate = new Date();
        var datetime = "";
        var month = currentdate.getMonth()+1;
        var day = currentdate.getDate();
        
        datetime += currentdate.getFullYear()+"-";
        
        if(month < 10){
            datetime += "0";
        }
        datetime += month+"-"; 
        if(day < 10){
            datetime += "0";
        }
        datetime += day; 
        
        return datetime;
    }