
    //return datas of the questionnaire according to his hash code
    function getNoteLastVersionAndNomSysteme(hashCode){

            var tabData = new Array();
            $.ajax({
                    type: "POST",
                    url: "requeteGetLastNoteGlobale_NomVersion.php",
                    data: {Code: "'" + hashCode + "'"},
                    async: false,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.length == 0){
                            tabData.push(null, "System", null, null, null, null);
                        }
                        else {
                            //we insert the datas into the array
                            tabData.push(data[0].IdQuest, data[0].Nom, data[0].NumVersion, data[0].DateExpiration, data[0].SommeNote, data[0].NbReponses);
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
        var code, nameSystem;
        var dataSystem = new Array();
                
        //we get the hash code of the questionnaire in the current url
        code = getUrlParameter('c');
        
        //we get all datas of this questionnaire
        dataSystem = getNoteLastVersionAndNomSysteme(code);
        nameSystem = dataSystem[1];

        //we only return the name of the system
        return nameSystem;
    }