    function ajouterEnquete(idUtil, iduser) {
        if($("#nomQuestionaire").val() != "" && $("#ajoutVersion").val() != "" && $("#systemeDate").val() != "") {
			var d = new Date();
			
			/***partie Survey Monkey ****/
			var codeSM = $('textarea[id="systemeCode"]').val();
			console.log(codeSM);
			/*********/

			var month = d.getMonth() + 1;
			var day = d.getDate();

			var output = d.getFullYear() + '-' +
						(month < 10 ? '0' : '') + month + '-' +
						(day < 10 ? '0' : '') + day;
			ajoutQuestionnaire($("#nomQuestionaire").val(), output, idUtil, $("#ajoutVersion").val(), $("#systemeDate").val(), iduser);
		}
    }

    function ajouterVersion(idBody, iduser){
        var numV = $('#ajoutV'+idBody).val();
        var date = $('#ajoutV'+idBody+'date').val();
        var idQuestionnaire = $('#body'+idBody).attr('name');
		if(numV != "" && date != "") {
			
			/***partie Survey Monkey ****/
			var codeSM = $('textarea[id="ajoutV'+idBody+'SMcode"]').val();
			console.log(codeSM);
			/*********/
			
			$.ajax({
				type: "POST",
				url: "ajoutVersion.php",
				async: false,
				data: {NumVersion: numV, IdQuest: idQuestionnaire, DateExpiration: "'" +date+ "'"},
				success: function (result)
				{
					location.reload()
				},
				error: function (result, status, err) {
					console.log("err");
				}					
			});
		}
    }
    
    function supprimerVersion(NumV, idQ, iduser){
        $.ajax({
            type: "POST",
            url: "SupprimerVersion.php",
            async: false,
            data: {NumVersion: NumV, IdQuest: idQ},
            success: function (result)
            {
				location.reload()
            }		
        });
    }
    
    function ajoutQuestionnaire(nom, dateCreation, idAmin, NumVersion, DateExpiration, iduser) {
        $.ajax({
            type: "POST",
            url: "requeteAjoutQuestionnaire.php",
            data: {NomQuest: nom, Date: "'" + dateCreation + "'", ID: "'" + idAmin + "'", NV: "'" + NumVersion + "'", DE: "'" + DateExpiration + "'"},
            async: false,
            success: function (result)
            {
                affichageCollapses(iduser);
                affichageGraphiques(iduser);
				$(".codeSM2").hide();
            },
            error: function (result, status, err) {
                console.log(err);
            }
        });
    }	