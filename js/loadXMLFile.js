    function loadXMLDoc(url){
        var xmlhttp;
        var questions, formGroup, i;

        if (window.XMLHttpRequest){
            // code pour IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else{
            // code pour IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange=function(){
            // on regarde si la requête est terminée et la réponse prête
            if(xmlhttp.readyState == 4 && xmlhttp.status ==200){
                $("#questSUS").html("");
                questions = xmlhttp.responseXML.documentElement.getElementsByTagName("question");
                for(i=0; i<questions.length; i++){
                    var question = questions[i].firstChild.nodeValue;
                    formGroup="<div class='form-group'>"
                            +"<h4>"+question+"</h4>"
                            +"<label class='radio-inline'>"
                                +"<input type='radio' name='question"+i+"' value='5' checked>Tout à fait d'accord"
                            +"</label>"
                            +"<label class='radio-inline'>"
                                +"<input type='radio' name='question"+i+"' value='4'>Plutôt d'accord"
                            +"</label>"
                            +"<label class='radio-inline'>"
                                +"<input type='radio' name='question"+i+"' value='3' checked>Partiellement d'accord"
                            +"</label>"
                            +"<label class='radio-inline'>"
                                +"<input type='radio' name='question"+i+"' value='2'>Un peu d'accord"
                            +"</label>"
                            +"<label class='radio-inline'>"
                                +"<input type='radio' name='question"+i+"' value='1' checked>Pas du tout d'accord"
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