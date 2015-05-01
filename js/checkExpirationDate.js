    //check if questionnaire is expired
    function checkExpirationDate(dataSystem){
        var expirationDateString;
        var currentDate = new Date();
        expirationDateString = dataSystem[3];
        var expirationDate = new Date(expirationDateString);

        if (currentDate > expirationDate) {
            $("#titleSUS").hide();
            hideLanguagesOptionAndStartButton();
            $("#questSUS").hide();
            $("#contentSUS").append("<h2 style='margin-top: 25%; text-align: center; color: red;'>Ooops ! Wrong way ! :(</h2>" +
                                    "<p style='text-align: center;'>Sorry, this questionnaire has expired ! Expiration Date : " + expirationDateString + "</p>");         
        }
        else {
            //creation of button start
            var str = '<button id="startQuestionnaire" class="btn btn-success" type="button"';

            if(dataSystem[4] != null) {
                str += ' onclick="window.open(href=\'' + dataSystem[4] + '\');return false;"';
            }
            str += '>Start</button>';

            $("#startContent").append(str);
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