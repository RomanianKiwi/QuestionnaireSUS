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
				//Flavien : ligne 19 � 105 � copier coller dans ton fichier formulaire.php avant ta fonction $("#questSUS").submit(function(e)
				
				
                //fonctionsUtiles.js
				//On r�cup�re avec la ligne suivante le code hash� du nom su syst�me :
                var num = getUrlParameter('CodeQuest');
                console.log(num);
				
				//Fonction qui renvoit les donn�es du questionnaire en fonction du numero hach� du non du syst�me � tester :
				function getNoteLastVersionAndNomSysteme(numeroCoder){
					
					var tabData = new Array();
					$.ajax({
						type: "POST",
						url: "requeteGetLastNoteGlobale_NomVersion.php",
						data: {Code: "'" + numeroCoder + "'"},
						async: false,
						dataType: 'json',
						success: function (data)
						{
							console.log(data);
							if (data.length == 0){
								$('#questions').append("<p>Code mauvais (dans l'adresse URL)</p>");
								//console.log("questionnaire inexistant");
							}
							else {
								$('#questions').append("<p>Infos Questionnaire : </p>");
								tabData.push(data[0].IdQuest, data[0].Nom, data[0].NumVersion, data[0].DateExpiration, data[0].SommeNote, data[0].NbReponses);
								for(i=0; i<tabData.length;i++)
									$('#questions').append("<p>Donn�e : "+tabData[i]+"</p>");
							}
						}
					});
					//console.log(tabData);
					return tabData;
					
				}
				
				//exemple de test : http://localhost/QuestionnaireSUS/pages/questionnaire.php?CodeQuest=123456
				//AVANT DANS LA BASE IL FAUT METTRE DANS LA ZONE SQL : INSERT INTO syshash VALUES('Parions Sport', '123456', 0);
				var tabData = new Array();
				//On r�cup�re les donn�es du questionnaire dans un tableau
				tabData = getNoteLastVersionAndNomSysteme(num);
				console.log(tabData);
				
				//Nom du syst�me
				var nomSysteme = tabData[1];
				//SommeNote
				var SommeN = tabData[4];
				//Nombre de R�ponses
				var NbRep = tabData[5];
				//IdQuestionnaire
				var quest = tabData[0];
				//IdVersion
				var vers = tabData[2];
				
				function ajoutScore(score, SommeIni, NbRep, idQuest, idVersion){
					NbRep ++;
					var tempSomme = parseInt(SommeIni);
					var newSomme = tempSomme + score;
					console.log(newSomme);
					
					$.ajax({
                        type: "POST",
                        url: "requeteAjoutScoreSUS.php",
                        data: {Somme: "'" + newSomme + "'", NB: "'" + NbRep + "'", IDQUESTIONNAIRE: "'" + idQuest + "'", IDVERSION: "'" + idVersion + "'"},
                        async: false,
                        dataType: 'json',
                        success: function (data)
                        {
                                console.log("insertion r�ussie");
                        }
                    });
					
				}
				
				//ajoutScore(75, SommeN, NbRep, quest, vers); ligne de test
				
				//Partie Flavien---------------------
				
				/*$("#questSUS").submit(function(e){
                    e.preventDefault();
                    var scoreSUS = computeScoreSUS();
                    console.log(scoreSUS);
					//Utilisation de la fonction ajoutScore :
					ajoutScore(scoreSUS, SommeN, NbRep, quest, vers);
                });*/
				
				//Fin partie Flavien------------------------------------
				
				

                /*function afficherQuestXml() {
                    $.ajax({
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
                                var str = replaceSYSTEM(data[i].question, nomSysteme);
                                //$('#questions').append("<p>" + data[i].idQuestion + " : " + str + "</p>");
                                $('#questions').append("<p> Nom Syst�me : " + nomSysteme + "</p>");
                                
                            }
                        }
                    });
                }*/

                /*$.ajax({
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
                });*/





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
