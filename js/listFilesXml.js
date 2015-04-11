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

function afficherListFilesXML(tabXML) {
    if (tabXML.length == 0)
    {
        $('#listeFilesXML').append("<p>Aucun fichier (xml) de langue connu.</p>")
    }
    else {
        for (var i = 0; i < tabXML.length; i++) {
            console.log(tabXML[i]);
            $('#listeFilesXML').append('<div class="row">' +
                    '<div class="col-md-12"><span class="glyphicon glyphicon-file fileXML" aria-hidden="true"></span>&thinsp;&thinsp;' + tabXML[i] + '</div>' +
                    '</div>');
        }
    }
}


