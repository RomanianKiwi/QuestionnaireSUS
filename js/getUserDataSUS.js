    function getDataSUSOfUser(iduser, nVersion, idQuest, nameSystem) {
        $.ajax({
            type: "POST",
            url: "requeteListeReponsesUtilisateurs.php",
            data: {NumVersion: "'" + nVersion + "'", IdQuest: "'" + idQuest + "'"},
            async: false,
            dataType: 'json',
            success: function (data)
            {
                generateList(iduser, data,nameSystem, nVersion);
                generatePages(data, nameSystem, nVersion);
            },
            error: function (result, status, err) {
                console.log(err);
            }
        });
    }