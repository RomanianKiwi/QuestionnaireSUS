
    //return datas of the questionnaire according to his hash code
    function getNoteLastVersionAndNomSysteme(sysCode, mailCode){

            var tabData = new Array();
            $.ajax({
                    type: "POST",
                    url: "requeteGetLastNoteGlobale_NomVersion.php",
                    data: {Code: "'" + sysCode + "'", MailH: "'" + mailCode + "'"},
                    async: false,
                    dataType: 'json',
                    success: function (data)
                    {
                        //console.log(data);
                        if (data.InviteCode == null || data.NumVersion == null){
                            $("#titleSUS").hide();
                            hideLanguagesOptionAndStartButton();
                            $("#questSUS").hide();
                            $("#contentSUS").append("<h2 style='margin-top: 25%; text-align: center; color: red;'>Ooops ! Wrong way ! :(</h2>" +
                                                    "<p style='text-align: center;'>It seems you have already completed the questionnaire or the URL is incorrect.</p>");
                        }
                        else {
                            //we insert the datas into the array
                            tabData.push(data.IdQuest, data.Nom, data.NumVersion, data.DateExpiration, data.SommeNote, data.NbReponses);
                        }
                    },
                    error : function(result, status, err){
                        console.log(result);
                        console.log(err);
                    }
            });

            return tabData;
    }