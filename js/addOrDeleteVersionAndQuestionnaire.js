    function ajouterEnquete(idUtil, iduser) {  
        //var idUtil = <?php echo $_SESSION['ID']; ?>;
        var d = new Date();

        var month = d.getMonth() + 1;
        var day = d.getDate();

        var output = d.getFullYear() + '-' +
                    (month < 10 ? '0' : '') + month + '-' +
                    (day < 10 ? '0' : '') + day;
        ajoutQuestionnaire($("#nomQuestionaire").val(), output, idUtil, $("#ajoutVersion").val(), $("#systemeDate").val(), iduser);
    }

    function ajouterVersion(idBody, iduser){
        //var iduser = parseInt('<?php echo $id_user; ?>');
        //console.log(iduser);
        var numV = $('#ajoutV'+idBody).val();
        var date = $('#ajoutV'+idBody+'date').val();
        var idQuestionnaire = $('#body'+idBody).attr('name');

        $.ajax({
            type: "POST",
            url: "ajoutVersion.php",
            async: false,
            data: {NumVersion: numV, IdQuest: idQuestionnaire, DateExpiration: "'" +date+ "'"},
            success: function (result)
            {
                affichageCollapses(iduser);
                affichageGraphiques(iduser);
            },
            error: function (result, status, err) {
                console.log("err");
            }					
        });
    }
    
    function supprimerVersion(NumV, idQ, iduser){
        //var iduser = parseInt('<?php echo $id_user; ?>');
        $.ajax({
            type: "POST",
            url: "SupprimerVersion.php",
            async: false,
            data: {NumVersion: NumV, IdQuest: idQ},
            success: function (result)
            {
                affichageCollapses(iduser);
                affichageGraphiques(iduser);
            }		
        });
    }
    
    function ajoutQuestionnaire(nom, dateCreation, idAmin, NumVersion, DateExpiration, iduser) {
        //var iduser = parseInt('<?php echo $id_user; ?>');
        $.ajax({
            type: "POST",
            url: "requeteAjoutQuestionnaire.php",
            data: {NomQuest: nom, Date: "'" + dateCreation + "'", ID: "'" + idAmin + "'", NV: "'" + NumVersion + "'", DE: "'" + DateExpiration + "'"},
            async: false,
            success: function (result)
            {
                affichageCollapses(iduser);
                affichageGraphiques(iduser);
            },
            error: function (result, status, err) {
                console.log(err);
            }
        });
    }	