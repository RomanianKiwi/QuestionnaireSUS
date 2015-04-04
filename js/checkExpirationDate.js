    //check if questionnaire is expired
    function checkExpirationDate(){
        var sysCode, mailCode, expirationDate;
        var dataSystem = new Array();
                
        //we get the hash code of the questionnaire and the user's mail in the current url
        sysCode = getUrlParameter('c');
        mailCode = getUrlParameter('m');
        
        //we get all datas of this questionnaire
        dataSystem = getNoteLastVersionAndNomSysteme(sysCode,mailCode);
        expirationDate = dataSystem[3];
        
        return expirationDate == getCurrentDate();
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