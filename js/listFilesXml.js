/*
 * @return tab : return elements of xml files repository with using getListFilesXml.php
 */

function listFilesXML() {
    var tab = new Array();
    $.ajax({
        type: "POST",
        url: "getListFilesXml.php",
        async: false,
        dataType: 'json',
        success: function (data)
        {
            if (data.length == 0)
            {
                return tab;
            }
            else {
                for (var i = 0; i < data.length; i++) {
                    //console.log(data[i]);
                    tab.push(data[i]);
                }
            }

        }
    });
    return tab;
}

function generateLanguageList(languagesAvailables){
    if(languagesAvailables.length != 0 ) {
        var language;
        
        for(var i = 0; i < languagesAvailables.length; i++) {
            language = languagesAvailables[i].split("_");
            language = language[1].split(".");
            $("#languagesAvailables").append("<option id='language" + language[0] + "' class='languageOption' data-value='" + languagesAvailables[i] + "'>" + 
                                                language[0] + 
                                             "</option>");
        }
    }
}


