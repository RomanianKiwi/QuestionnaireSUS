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
            $("#alertSuccess").text("Ajout de la langue " + nameLangue + " réussie ");
            $("#alertSuccess").fadeIn(500).delay(2000).fadeOut(1000);
        },
        error: function (result, status, err) {
            $("#alertFail").fadeIn(500).delay(2000).fadeOut(1000);
            console.log(err);
        }
    });
}


