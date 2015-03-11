    function loadXMLDoc(url){
        var xmlhttp;
        var answers, reponses, formGroup, i;

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
                for(i=0; i<questions.length; i++){
                    var question = questions[i].firstChild.nodeValue;
                    formGroup="<div class='form-group'>"
								+"<h4>"+question+"</h4>"
								+"<label class='radio-inline'>"
									+"<input type='radio' name='question"+i+"' value='5'>"+answers[0].firstChild.nodeValue
								+"</label>"
								+"<label class='radio-inline'>"
									+"<input type='radio' name='question"+i+"' value='4'>"+answers[1].firstChild.nodeValue
								+"</label>"
								+"<label class='radio-inline'>"
									+"<input type='radio' name='question"+i+"' value='3'>"+answers[2].firstChild.nodeValue
								+"</label>"
								+"<label class='radio-inline'>"
									+"<input type='radio' name='question"+i+"' value='2'>"+answers[3].firstChild.nodeValue
								+"</label>"
								+"<label class='radio-inline'>"
									+"<input type='radio' name='question"+i+"' value='1'>"+answers[4].firstChild.nodeValue
								+"</label>"
							+"</div>";

                        $("#questSUS").append(formGroup);
                }
				$("#questSUS").append("<button type='submit' class='btn btn-default'>Submit</button>");
            }   
        }

        xmlhttp.open("GET",url,true);
        xmlhttp.send();
    }