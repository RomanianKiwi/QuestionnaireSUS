    function loadXMLDoc(url){
        var xmlhttp;
        var questions, answers, system, formGroup, i;

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
                for(i=0; i<questions.length; i++){
                    var question = questions[i].firstChild.nodeValue;
                    var re = new RegExp(system, "g");
                    question = question.replace(re,"Git");
                    formGroup="<div class='form-group'>"
                                +"<h4>"+question+"</h4>"
                                +"<label class='radio-inline'>"
                                        +"<input class='answerSUS' type='radio' name='question"+i+"' data-value='5' value='"+answers[0].firstChild.nodeValue+"'>"+answers[0].firstChild.nodeValue
                                +"</label>"
                                +"<label class='radio-inline'>"
                                        +"<input class='answerSUS' type='radio' name='question"+i+"' data-value='4' value='"+answers[1].firstChild.nodeValue+"'>"+answers[1].firstChild.nodeValue
                                +"</label>"
                                +"<label class='radio-inline'>"
                                        +"<input class='answerSUS' type='radio' name='question"+i+"' data-value='3' value='"+answers[2].firstChild.nodeValue+"'>"+answers[2].firstChild.nodeValue
                                +"</label>"
                                +"<label class='radio-inline'>"
                                        +"<input class='answerSUS' type='radio' name='question"+i+"' data-value='2' value='"+answers[3].firstChild.nodeValue+"'>"+answers[3].firstChild.nodeValue
                                +"</label>"
                                +"<label class='radio-inline'>"
                                        +"<input class='answerSUS' type='radio' name='question"+i+"' data-value='1' value='"+answers[4].firstChild.nodeValue+"'>"+answers[4].firstChild.nodeValue
                                +"</label>"
                            +"</div>";

                        $("#questSUS").append(formGroup);
                }
                $(".answerSUS").on('change', verifyAllQuestionsAreChecked);
		$("#questSUS").append("<button type='submit' disabled='true' class='btn btn-default'>Submit</button>");
            }   
        }

        xmlhttp.open("GET",url,true);
        xmlhttp.send();
    }
    
    function verifyAllQuestionsAreChecked(){
        var anyQuestionsAreChecked = true;
   
        $("#questSUS > .form-group").each(function(){
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
            $("#questSUS > button[type='submit']").attr("disabled", false);
        }
        else{
            $("#questSUS > button[type='submit']").attr("disabled", true);
        }
    }