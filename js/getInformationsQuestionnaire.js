
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
                            $("#questSUS").hide();
                            $("#contentSUS").append("<h2 class='col-xs-offset-5'>Ooops ! Wrong way ! :(</h2>" +
                                                    "<p class='col-xs-offset-4'>Il se peut que vous ayez déjà répondu au questionnaire ou que l'URL soit incorrecte.</p>");
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
    
    function getSystemName(){
        var sysCode, mailCode, nameSystem;
        var dataSystem = new Array();
                
        //we get the hash code of the questionnaire and the user's mail in the current url
        sysCode = getUrlParameter('c');
        mailCode = getUrlParameter('m');
        
        //we get all datas of this questionnaire
        dataSystem = getNoteLastVersionAndNomSysteme(sysCode,mailCode);
        nameSystem = dataSystem[1];

        //we only return the name of the system
        return nameSystem;
    }