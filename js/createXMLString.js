
    /*
     * @param system : the name of the system
     * @param answers : array containing the answers of the questionnaire
     * @apram questions : array containing the questions of the questionnaire
     * @return : a string of xml content
     */
    function createXMLString(system, answers, questions){
        var i;
        var xmlString = "<?xml version='1.0' encoding='UTF-8'?>";
        xmlString = xmlString + "<questionnaire><system>" + system + 
                    "</system>";
        xmlString = xmlString + "<answers>";
        for(i = 0; i < answers.length; i++)
                xmlString = xmlString + "<answer>" + answers[i] + "</answer>";
        xmlString = xmlString + "</answers>";
        xmlString = xmlString + "<questions>";
        for(i = 0; i < questions.length; i++)
                xmlString = xmlString + "<question>" + questions[i] + 
                            "</question>";
        xmlString = xmlString + "</questions>";
        xmlString = xmlString + "</questionnaire>";

        return xmlString;
    }