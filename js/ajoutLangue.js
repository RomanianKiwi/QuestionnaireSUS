/*
 * @param nameLangue : the name of the langue of the new xml file
 * @param stringXML : string of the contains of xml file
 */

function ajoutLangue(nameLangue, stringXML) {
    $.ajax({
        type: "POST",
        url: "writeFileXml.php",
        data: {NameFile: nameLangue, StringXML: stringXML},
        async: false,
        success: function (result)
        {
            console.log("ajout réussie");
            console.log(result);
            $("input").val("");
            $("html, body").animate({scrollTop: 0}, "slow");
            $("#alertSuccess").text("Ajout de la langue " + nameLangue + " r&eacute;ussie ");
            $("#alertSuccess").fadeIn(500).delay(2000).fadeOut(1000);
            $('#listeFilesXML').append('<div class="row">' +
                    '<div class="col-md-12"><span class="glyphicon glyphicon-file fileXML" aria-hidden="true"></span>&thinsp;&thinsp;quest_' + nameLangue + '</div>' +
                    '</div>');
            $('span:last').parent().css("color", "green");
            $('span:last').parent().delay(3500).queue(function (next) {
                $(this).css("color", "black");
                next();
            });
        },
        error: function (result, status, err) {
            $("#alertFail").fadeIn(500).delay(2000).fadeOut(1000);
            console.log(err);
        }
    });
}


