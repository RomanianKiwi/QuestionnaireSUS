    //check if questionnaire is expired
    function checkExpirationDate(dataSystem){
        var expirationDate;
        var currentDate;
        var detailsExpirationDate;
        var yearExpiration, monthExpiration, dayExpiration;
        var currentYear, currentMonth, currentDay;
        
        expirationDate = dataSystem[3];
        currentDate = getCurrentDate();
        detailsExpirationDate = expirationDate.split("-");
        
        yearExpiration = detailsExpirationDate[0];
        monthExpiration = detailsExpirationDate[1];
        dayExpiration = detailsExpirationDate[2];
        
        currentYear = currentDate[0];
        currentMonth = currentDate[1];
        currentDay = currentDate[2];
        
        if (currentYear > yearExpiration || currentMonth > monthExpiration || currentDay > dayExpiration) {
            $("#titleSUS").hide();
            hideLanguagesOptionAndStartButton();
            $("#questSUS").hide();
            $("#contentSUS").append("<h2 style='margin-top: 25%; text-align: center; color: red;'>Ooops ! Wrong way ! :(</h2>" +
                                    "<p style='text-align: center;'>Sorry, this questionnaire has expired ! Expiration Date : " + expirationDate + "</p>");           
        }
    }
    
    //get the current date when the user access the questionnaire
    function getCurrentDate(){
        var datetime = new Array();
        var currentdate = new Date();
        
        datetime[0] = currentdate.getFullYear();
        datetime[1] = currentdate.getMonth()+1;
        datetime[2] = currentdate.getDate();
        
        return datetime;
    }