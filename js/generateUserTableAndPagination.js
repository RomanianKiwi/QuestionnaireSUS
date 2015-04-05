    function generateTableAndPagination(nameSystem, numVersion){
        $("#list" + nameSystem + "Version" + numVersion).prepend('<div>' +
                                                                    '<table class="table table-striped table-bordered table-hover">' +
                                                                                    '<thead>' +
                                                                                            '<tr>' +
                                                                                                    '<th rowspan="2">Mail</th>' +
                                                                                                    '<th rowspan="2">Réponses</th>' +
                                                                                                    '<th rowspan="2">Score</th>' +
                                                                                                    '<th>Comptabilisé ?</th>' +
                                                                                            '</tr>' +
                                                                                            '<tr>' +
                                                                                                    '<th>Tous <input id="selectAll' + nameSystem + 'Version' + numVersion + '" type="checkbox" name="selectAllUser' + nameSystem + 'Version' + numVersion + '" checked></th>' +
                                                                                            '</tr>' +
                                                                                    '</thead>' +
                                                                                    '<tbody id="userList' + nameSystem + 'Version' + numVersion + '"></tbody>' +
                                                                            '</table>' +
                                                                    '</div>' +
                                                                    '<nav>' +
                                                                            '<ul id="paginationUser' + nameSystem + 'Version' + numVersion + '" class="pagination"></ul>' +
                                                                    '</nav>' + 
                                                                    '<p>Score version : <span id="score' + nameSystem + 'Version' + numVersion + '"></span></p>');
        $("#selectAll" + nameSystem + "Version" + numVersion).on("change", function(){
            selectAllUserOfSystemVersion(nameSystem, numVersion);
            updateScoreWhenCheckboxesAreChanged(nameSystem, numVersion);
        });
    }

    function generateList(iduser, data, nameSystem, numVersion){
        var page = 0;

        for(var i=0; i<data.length; i++){
                if(i % 10 == 0){
                    page++;
                }
                $("#userList" + nameSystem + "Version" + numVersion).append('<tr class="' + nameSystem + 'Version' + numVersion + 'user' + page + ' isUser' + nameSystem + 'Version' + numVersion + '">' +
                                                                                    '<td>' + data[i].Email + '</td>' +
                                                                                    '<td>' + data[i].Reponses + '</td>' +
                                                                                    '<td>' + data[i].Score + '</td>' +
                                                                                    '<td><input class="checkbox' + nameSystem + 'Version' + numVersion + '" type="checkbox" name="user' + nameSystem + 'Version' + numVersion + '" value="' + data[i].Score + '" checked></td>' +
                                                                            '</tr>');
        }

        $(".checkbox" + nameSystem + "Version" + numVersion).on("change", function(){
            updateScoreWhenCheckboxesAreChanged(nameSystem, numVersion);
            affichageGraphiques(iduser);
        });
    }

    function generatePages(data, nameSystem, numVersion){
        var page = 0;

        for(var i=0; i<data.length; i++){
            if(i % 10 == 0){
                page++;
                $("#paginationUser" + nameSystem + "Version" + numVersion).append('<li><a id="' + nameSystem + 'Version' + numVersion + 'page' + page + '" href="#">' + page + '</a></li>');
                $("#" + nameSystem + "Version" +  numVersion + "page" + page).on('click', function(e){
                    var numPage = e.target.innerText;
                    $(".isUser" + nameSystem + "Version" + numVersion).hide();
                    $("." + nameSystem + "Version" + numVersion + "user" + numPage).show();
                });
            }
        }			
    }
    
    function selectAllUserOfSystemVersion(nameSystem, numVersion){
        var isChecked = $("#selectAll" + nameSystem + "Version" + numVersion)[0].checked;

        if(isChecked){
            $(".checkbox" + nameSystem + "Version" + numVersion).prop('checked',true);
        }
        else{
            $(".checkbox" + nameSystem + "Version" + numVersion).prop('checked',false);
        }
    }