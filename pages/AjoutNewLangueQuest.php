<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['statut']) && isset($_SESSION['ID'])) {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $log = $_SESSION['login'];
    $mpass = $_SESSION['password'];
    $statut = $_SESSION['statut'];
    $reponse = $bdd->query("SELECT * FROM administrateur WHERE UserName= \"" . $log . "\"AND PassWord = \"" . $mpass . "\"AND Statut = \"" . $statut . "\";");
    $donnees = $reponse->fetch(PDO::FETCH_ASSOC);

    //print_r($_SESSION['ID']);
    //if ne sert plus après la premiere id car on a vérifié ce qu'il y a en post avec la BDD.
    //Maintenant vérifié si les données dans les SESSION sont egaux avec ce qu'il y a dans la BDD
    //donc le test est effectuer au dessus.(tester si le champ que retourne la bdd n'est pas vide)
    if ($donnees['UserName'] != "" && $donnees['PassWord'] != "" && $_SESSION['login'] != "" && $donnees['Statut'] != "") {
        //echo 'tu es un boss xD';
    } else {
        header("Location:logout.php");
    }
    $reponse->closeCursor();
} else {
    header("Location:logout.php");
}
?>

<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../css/bootstrap.css">
		<script src="../js/jquery-2.1.3.js"></script>
		<script src="../js/bootstrap.js"></script>	

        <!-- plugin Bootstrap DatePicker -->
        <link href="../css/datepicker.css" rel="stylesheet">
        <script src="../js/bootstrap-datepicker.js"></script>
        <script src="../js/dateFRtoEN.js"></script>
        <script src="../js/createXMLString.js"></script>

        <script type="text/javascript">

            $(document).ready(function () {

                var statutUtil = "<?php echo $_SESSION['statut']; ?>";

                for (var i = 1; i < 6; i++) {
                    $("#reponses").append("<div class='form-group'>" +
                            "<label for='reponse" + i + "' class='col-sm-3 control-label'>Réponse " + i + "</label>" +
                            "<div class='col-sm-4'>" +
                            "<input id='reponse" + i + "' type='text' class='form-control' placeholder='Réponse de niveau " + i + "' required>" +
                            "</div>" +
                            "</div>");
                }

                for (var i = 1; i < 11; i++) {
                    $("#questions").append("<div class='form-group'>" +
                            "<label for='question" + i + "' class='col-sm-3 control-label'>Question " + i + "</label>" +
                            "<div class='col-sm-4'>" +
                            "<input id='question" + i + "' type='text' class='form-control' placeholder='Question " + i + " à renseigner' required>" +
                            "</div>" +
                            "</div>");
                }

                var idUtil = <?php echo $_SESSION['ID']; ?>;

                $('#formAjout').on('submit', function (e) {
                    var tabRep = new Array();
                    var tabQuest = new Array();
                    
                    for (var i = 1; i < 6; i++) {
                        var idRep = "#reponse"+i;
                        var r = $(idRep).val();
                        //var r = $("#nomSysteme").val();
                        //console.log(r);
                        tabRep.push(r);
                    }
                    
                    for (var i = 1; i < 11; i++) {
                        var idQuest = "#question"+i;
                        var q = $(idQuest).val();
                        //var r = $("#nomSysteme").val();
                        //console.log(q);
                        tabQuest.push(q);
                    }
                    console.log($("#nomSysteme").val());
                    console.log(tabRep);
                    console.log(tabQuest);
                    
                    var chaineXML = createXMLString($("#nomSysteme").val(), tabRep, tabQuest);
                    
                    console.log(chaineXML);
                    
                    //ajoutQuestionnaire($("#nomQuestionaire").val(), DateFrtoEn(date), idUtil);
                });
                $(function () {
                    $("#datepicker").datepicker({
                        format: 'dd/mm/yyyy'
                    });
                });


                if (statutUtil != "Administrateur") {
                    $("#AjoutAd").hide();
                }


                //ajoutQuestionnaire("GPS", "2015-03-15",2);

                /*
                 T'as juste à faire appel à la fonction ajoutAdmin(nom, mdp);
                 Et en paramètre tu mets l'identifiant et le mot de passe que l'admin que tu récupèreras dans 
                 tes formulaires (avec les $.text() ).
                 Et voilà
                 */
            });

        </script>

        <style type="text/css">
            .bs-example{
                margin: 20px;
            }

            li:hover {
                background-color: #D8D8D8;
            }
        </style>
    </head>

    <body>

        <?php include("menu.php"); ?>

        <form id="formAjout" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="nomSysteme" class="col-sm-3 control-label">Mot Système</label>
                <div class="col-sm-4">
                    <input id="nomSysteme" type="text" class="form-control" placeholder="Traduction du mot système dans la nouvelle langue" required>
                </div>
            </div>
			
			<hr></hr>

			<div class="form-group">
                <label class="col-sm-3 control-label">Réponses :</label>
            </div>

            <div id="reponses">
            </div>
			
			<hr></hr>
			
			<div class="form-group">
                <label class="col-sm-3 control-label">Questions :</label>
            </div>

            <div id="questions">
            </div>
			
			<hr></hr>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                    <button id="ajouter" type="submit" class="btn btn-primary">Ajouter</button>

                </div>
            </div>


        </form>

    </body>

</html>