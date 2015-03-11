<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="../js/fonctionsUtiles.js"></script>


        <script type="text/javascript">

            $(document).ready(function () {
                //fonctionsUtiles.js
                var nomSysteme = getUrlParameter('nomSysteme');
                console.log(nomSysteme);

                function afficherQuestXml() {
                    /*$.ajax({
                        type: "POST",
                        url: "accueil.php",
                        //data : { num : 1},

                        async: false,
                        dataType: 'json',
                        success: function (data)
                        {
                            console.log(data);
                            for (var i = 0; i < data.length; i++) {
                                //appel de la fonction dans fonctionsUtiles.js
                                var str = replaceSYSTEM(data[i].question, nomSysteme);*/
                                //$('#questions').append("<p>" + data[i].idQuestion + " : " + str + "</p>");
                                $('#questions').append("<p> Nom Système : " + nomSysteme + "</p>");
                                /*
                            }
                        }
                    });*/
                }

                $.ajax({
                    type: "POST",
                    url: "verificationNomSysteme.php",
                    data: {nomSyst: "'" + nomSysteme + "'"},
                    async: false,
                    dataType: 'json',
                    success: function (data)
                    {
                        console.log(data);
                        if (data.length == 0){
                            $('#questions').append("<p>questionnaire inexistant</p>");
                            console.log("questionnaire inexistant");
                        }
                        else {
                            console.log("Questionnaire ok : " + data[0].nomSysteme);
                            afficherQuestXml();
                        }

                    }
                });





            });

        </script>

        <style>
            .container {
                width:50%;
            }
        </style>

    </head>

    <body>

        <div id="questions">
        </div>

    </body>
</html>
