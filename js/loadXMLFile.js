    function loadXMLDoc(url){
        var xmlhttp;
        var questions, answers, system, formGroup, i;
        var nameSystem;
        var dataSystem = new Array();

        //we get the hash code of the questionnaire and the user's mail in the current url
        var sysCode = getUrlParameter('c');
        var mailCode = getUrlParameter('m');

        //we get all datas of this questionnaire
        dataSystem = getNoteLastVersionAndNomSysteme(sysCode, mailCode); 
        nameSystem = dataSystem[1];
        
        if (window.XMLHttpRequest){
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else{
            // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange=function(){
            // we check if the query is achieved and the response is ready
            if(xmlhttp.readyState == 4 && xmlhttp.status ==200){
                $("#questSUS").html("");
                questions = xmlhttp.responseXML.documentElement.getElementsByTagName("question");
		answers = xmlhttp.responseXML.documentElement.getElementsByTagName("answer");
                system = xmlhttp.responseXML.documentElement.getElementsByTagName("system")[0].firstChild.nodeValue;
                $("#questSUS").append("<table class='table table-bordered table-hover table-striped table-condensed'>" +
                                        "<thead>" +
                                            "<th>Questions</th>" +
                                            "<th>" + answers[0].firstChild.nodeValue + "</th>" +
                                            "<th>" + answers[1].firstChild.nodeValue + "</th>" +
                                            "<th>" + answers[2].firstChild.nodeValue + "</th>" +
                                            "<th>" + answers[3].firstChild.nodeValue + "</th>" +
                                            "<th>" + answers[4].firstChild.nodeValue + "</th>" +
                                        "</thead>" +
                                        "<tbody id='tableSUS'></tbody>" +
                                      "</table>");
                                
                for(i=0; i<questions.length; i++){
                    var question = questions[i].firstChild.nodeValue;
                    var re = new RegExp(system, "g");
                    question = question.replace(re, nameSystem);
                    formGroup="<tr>"
                                    + "<td>"
                                        + "<h5>"+question+"</h5>"
                                    + "</td>"
                                    + "<td>"
                                        + "<label class='radio-inline'>"
                                                + "<input class='answerSUS' type='radio' name='question"+i+"' data-value='5' value='"+answers[0].firstChild.nodeValue+"'>"
                                        + "</label>"
                                    + "</td>"
                                    + "<td>"
                                        + "<label class='radio-inline'>"
                                                + "<input class='answerSUS' type='radio' name='question"+i+"' data-value='4' value='"+answers[1].firstChild.nodeValue+"'>"
                                        + "</label>"
                                    + "</td>"
                                    + "<td>"
                                        + "<label class='radio-inline'>"
                                                + "<input class='answerSUS' type='radio' name='question"+i+"' data-value='3' value='"+answers[2].firstChild.nodeValue+"'>"
                                        + "</label>"
                                    + "</td>"
                                    + "<td>"
                                        + "<label class='radio-inline'>"
                                                + "<input class='answerSUS' type='radio' name='question"+i+"' data-value='2' value='"+answers[3].firstChild.nodeValue+"'>"
                                        + "</label>"
                                    + "</td>"
                                    + "<td>"
                                        + "<label class='radio-inline'>"
                                                +"<input class='answerSUS' type='radio' name='question"+i+"' data-value='1' value='"+answers[4].firstChild.nodeValue+"'>"
                                        + "</label>"
                                    + "</td>"
                            + "</tr>";

                        $("#tableSUS").append(formGroup);
                }
                $(".answerSUS").on('change', verifyAllQuestionsAreChecked);
		$("#questSUS").append("<div  class='container' style='text-align: center;'><button type='submit' disabled='true' class='btn btn-lg btn-default'>Submit</button></div>");
            }   
        }

        xmlhttp.open("GET",url,true);
        xmlhttp.send();
    }
    
    function verifyAllQuestionsAreChecked(){
        var anyQuestionsAreChecked = true;
        
        $("#questSUS > table > tbody > tr").each(function(){
               var answers = $(this).find('.answerSUS');
               var questionIsChecked = false;
               var index = 0;
               
               while(!questionIsChecked && index<answers.length){
                   if(answers[index].checked){
                       questionIsChecked = true;
                   }
                   index++;
               }
               if(!questionIsChecked){
                   anyQuestionsAreChecked = false;
               }
        });
        
        if(anyQuestionsAreChecked){
            $("#questSUS > div > button[type='submit']").attr("disabled", false);
        }
        else{
            $("#questSUS > div > button[type='submit']").attr("disabled", true);
        }
    }