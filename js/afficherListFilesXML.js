/*
 * @param tabXML : Array of xml files
 */

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
 