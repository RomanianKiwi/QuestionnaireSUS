
    function getStatutInvitationUser(idQuest, numVersion, inviteCode) {
            var statut = -1;
            $.ajax({
                    type: "POST",
                    url: "requeteGetStatut.php",
                    data: {IdQuest: idQuest, InviteCode: inviteCode, NumVersion: numVersion},
                    async: false,
                    dataType: 'json',
                    success: function (data)
                    {
                            statut = data[0].statut_Invitation;
                    },
                    error: function (result, status, err) {
                            console.log(err);
                    }
            });

            return statut;
    }

