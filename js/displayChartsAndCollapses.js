    function affichageCollapses(iduser){
        $('#contenu').children().remove();
        $.ajax({
            type: "POST",
            url: "enquetes.php",
            async: false,
            dataType: 'json',
            data: 'iduser=' + iduser,
            success: function (data)
            {
                if (data.length == 0)
                    $('#contenu').append("<p>Aucun questionnaire remplie</p>");
                else {
                    var systems = new Array();
                    var indexSystemsArray = 0;
                    var nomSysteme = "";
                    var cpt=0;
                    
                    for (var i = 0; i < data.length; i++) {
                            
                            if(nomSysteme != data[i].Nom)
                            {
                                systems[indexSystemsArray] = data[i].Nom;
                                indexSystemsArray++;
                                
                                $('#contenu').append('<div class="panel-group" id="accordion'+cpt+'">' +
                                                        '<div class="panel panel-default">'+
                                                            '<div class="panel-heading">' +
                                                                '<h1 class="panel-title">' +
                                                                    '<a class="accordeon'+cpt+'" data-toggle="collapse" data-parent="#accordion'+cpt+'" href="#collapse'+cpt+'"><span class="glyphicon glyphicon-plus"></span>'+data[i].Nom+'</a>' +
                                                                '</h1>' + 
                                                            '</div>' +
                                                            '<div id="collapse'+cpt+'" class="panel-collapse collapse">' +
                                                                '<div id="body'+cpt+'" name='+data[i].IdQuest+' class="panel-body">' +
                                                                    '<h3 class="col-xs-offset-5">Liste des versions</h3>' +
                                                                '</div>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>');
                            }
                            else
                            {
                                    cpt--;
                            }
                            if(data[i].Moyenne == null){
                                    data[i].Moyenne = 0;
                            }
                            $('#body'+cpt).append('<div class="panel-group" id="accordion'+cpt+'V'+data[i].NumVersion+'">' +
                                                        '<div class="panel panel-default">' +
                                                            '<div class="panel-heading">' +
                                                                '<h2 class="panel-title">' +
                                                                    '<a class="accordeon'+cpt+'V'+data[i].NumVersion+'" data-toggle="collapse" data-parent="#accordion'+cpt+'V'+data[i].NumVersion+'" href="#collapse'+cpt+'V'+data[i].NumVersion+'"><span class="glyphicon glyphicon-plus"></span>Version '+data[i].NumVersion+'</a>' +
                                                                '</h2>' +
                                                            '</div>' +
                                                            '<div id="collapse'+cpt+'V'+data[i].NumVersion+'" class="panel-collapse collapse">' +
                                                                '<div id="list' + data[i].Nom + 'Version' + data[i].NumVersion + '" class="panel-body">' +
                                                                    '<button type="button" onClick=supprimerVersion('+data[i].NumVersion+','+data[i].IdQuest+','+iduser+'); class="btn btn-primary ajouter">Supprimer cette version</button>' +
                                                                '</div>' +
                                                            '</div>' +
                                                        '</div>' +
                                                    '</div>');
                            generateTableAndPagination(iduser, data[i].Nom, data[i].NumVersion)
                            nomSysteme = data[i].Nom;
                            cpt++;
                            getDataSUSOfUser(iduser, data[i].NumVersion, data[i].IdQuest, data[i].Nom);
                            updateScoreWhenCheckboxesAreChanged(data[i].Nom, data[i].NumVersion);
                            $(".isUser" + data[i].Nom + "Version" + data[i].NumVersion).hide();
                            $("." + data[i].Nom + "Version" + data[i].NumVersion + "user1").show();
                    }

                    for (var i = 0; i < cpt; i++){
                        $('#body'+i).append('<form>' +
                                                '<label for="ajouV'+i+'">Version: \n\<input id="ajoutV'+i+'" type="number" min=2 name="ajoutV'+i+'" required></label>' +
                                                '<label for="ajoutV'+i+'date">Date d\'expiration: <input id="ajoutV'+i+'date" type="text" placeholder="format aaaa-mm-jj" name="ajoutV'+i+'date" required></label>' +
												'<label for="ajoutV'+i+'SMbox">Ajouter un questionnaire Survey Monkey: <input class="SMbox" id="ajoutV'+i+'SMbox" type="checkbox" name="ajoutV'+i+'SMbox" value="'+i+'"/></label>' +
												'<div class="codeSM2 code'+i+'"><label for="ajoutV'+i+'SMcode">Code HTML Survey Monkey: <textarea id="ajoutV'+i+'SMcode" name="ajoutV'+i+'SMcode" placeholder="Indiquez le code HTML généré par Survey Monkey."></textarea></label></div>' +
                                                '<button type="submit" class="btn btn-primary ajouter" onClick=ajouterVersion('+i+','+iduser+'); >Ajouter Version</button>' +
                                            '</form>' + 
                                            '<h3 class="col-xs-offset-5">Graphique des résultats</h3>' +
                                            '<div id="chartContainer' + systems[i] + '" class="col-xs-offset-3"></div>');
                    }
                }
            }
        });
    }
    
    function affichageGraphiques(iduser){
        $.ajax({
            type: "POST",
            url: "enquetes.php",
            async: false,
            dataType: 'json',
            data: 'iduser=' + iduser,
            success: function (data)
            {
                if (data.length == 0)
                {
                    console.log("No data.")
                }
                else {
                    var nomSysteme = "";
                    var cpt_s=0;
                    var cpt_v=0;
                    var tab_systemes = new Array();
                    var tab_systemes_version = new Array();
                    var tab_systemes_version_res = new Array();
                    var scoreVersions = new Array();

                    for (var i = 0; i < data.length; i++) {
                            if(nomSysteme != data[i].Nom)
                            {
                                    tab_systemes[cpt_s] = data[i].Nom;
                                    tab_systemes_version[cpt_s] = new Array();
                                    tab_systemes_version_res[cpt_s] = new Array();
                                    cpt_v=0;
                                    tab_systemes_version[cpt_s][cpt_v] = data[i].NumVersion;
                                    if(data[i].Moyenne == null){
                                            data[i].Moyenne = 0;
                                    }
                                    tab_systemes_version_res[cpt_s][cpt_v] = parseInt(data[i].Moyenne);
                            }
                            else
                            {
                                    cpt_s--;
                                    tab_systemes_version[cpt_s][cpt_v] = data[i].NumVersion;
                                    if(data[i].Moyenne == null){
                                            data[i].Moyenne = 0;
                                    }
                                    tab_systemes_version_res[cpt_s][cpt_v] = parseInt(data[i].Moyenne);
                            }
                            nomSysteme = data[i].Nom;
                            cpt_s++;
                            cpt_v++;
                    }
                    
                    for (var j = 0; j < tab_systemes.length; j++)
                    {
                            scoreVersions = getScoreVersions(tab_systemes[j], tab_systemes_version[j].length);
                            generateChart(tab_systemes[j],tab_systemes_version[j],scoreVersions);
                    }
                }
            }		
        });
    }
    
    function getScoresVersionsSystem(nameSystem){
        var scoresVersions = new Array();
        
        $(".score" + nameSystem).each(function(i){
            scoresVersions[i] = parseFloat($(this).text());
        });
        
        return scoresVersions;
    }
    
    function getVersionsSystem(nameSystem){
        var scoresVersions = getScoresVersionsSystem(nameSystem);
        var versionsSystem = new Array();
        
        for(var i = 0; i < scoresVersions.length; i++){
            versionsSystem[i] = i + "";
        }
        
        return versionsSystem;
    }
    
    function updateChartWhenVersionScoreChange(nameSystem){
        var scoresVersions = getScoresVersionsSystem(nameSystem);
        var versionsSystem = getVersionsSystem(nameSystem);
        
        generateChart(nameSystem, versionsSystem, scoresVersions);
    }