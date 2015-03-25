
/*
 * @param system : the name of the system
 * @param answers : array containing the answers of the questionnaire
 * @apram questions : array containing the questions of the questionnaire
 * @return : a string of xml content
 */
function createXMLString(system, answers, questions) {
    var i;
    var xmlString = "<?xml version='1.0' encoding='UTF-8'?>\n";
    xmlString = xmlString + "<questionnaire>\n    <system>" + system + "</system>";
    xmlString = xmlString + "\n    <answers>";
    for (i = 0; i < answers.length; i++)
        xmlString = xmlString + "\n      <answer>" + answers[i] + "</answer>";
    xmlString = xmlString + "\n    </answers>";
    xmlString = xmlString + "\n    <questions>";
    for (i = 0; i < questions.length; i++)
        xmlString = xmlString + "\n      <question>" + questions[i] + "</question>";
    xmlString = xmlString + "\n    </questions>";
    xmlString = xmlString + "\n</questionnaire>";

    return xmlString;
}