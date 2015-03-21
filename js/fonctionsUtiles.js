/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getUrlParameter(urlSTR)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');

    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        console.log(sParameterName[1]);
        //si on a des espaces dans l'adresse url (traduit par %20)
        //on les remplace par des espaces
        var temp = sParameterName[1].split('%20');
        console.log(temp);
        var str = "";
        for (var j = 0; j < temp.length; j++)
            str += temp[j] + " ";

        console.log(str);
        if (sParameterName[0] == urlSTR)
        {
            return str;
        }
    }
}

//fonction pour remplacer le nom "Systeme" par le nom du système à tester
function replaceSYSTEM(str, parametre) {
    var res = str.split(" ");
    var newStr = "";

    for (var i = 0; i < res.length; i++) {
        if (res[i] == "SYSTEME")
            res[i] = parametre;

        newStr += res[i] + " ";
    }
    return newStr;
}

