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
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Ajout Langue</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <script src="../js/jquery-2.1.3.js"></script>
        <script src="../js/bootstrap.js"></script>	

        <!-- plugin Bootstrap DatePicker -->
        <link href="../css/datepicker.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css" />
        <link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
        <script src="../js/bootstrap-datepicker.js"></script>
        <script src="../js/dateFRtoEN.js"></script>
        <script src="../js/createXMLString.js"></script>
        <script src="../js/ajoutLangue.js"></script>
        <script src="../js/listFilesXml.js"></script>
        <script src="../js/afficherListFilesXML.js"></script>

        <script type="text/javascript">

            $(document).ready(function () {

                $(".alert").hide();

                var statutUtil = "<?php echo $_SESSION['statut']; ?>";

                var tabXML = listFilesXML();
                afficherListFilesXML(tabXML);

                //Gestion redimension fenetre pour la liste des fichiers xml ;
                var largIni = $(document).width();
                console.log(largIni);
                if (largIni <= 850)
                {
                    $('#listeFilesXML').css('width', '90%');
                    $('#listeFilesXML').css('margin-left', '5%');
                }

                $(window).resize(function () {
                    var largRezise = $(document).width();
                    if (largRezise <= 850) {
                        $('#listeFilesXML').css('width', '90%');
                        $('#listeFilesXML').css('margin-left', '5%');
                    } else {
                        $('#listeFilesXML').css('width', '40%');
                        $('#listeFilesXML').css('margin-left', '28%');
                    }
                });

                //Initialisation formulaire
                for (var i = 1; i < 6; i++) {
                    $("#reponses").append("<div class='form-group'>" +
                            "<label for='reponse" + i + "' class='col-sm-3 control-label'>R&eacute;ponse " + i + "</label>" +
                            "<div class='col-sm-4'>" +
                            "<input id='reponse" + i + "' type='text' class='form-control' placeholder='R&eacute;ponse de niveau " + i + "' required>" +
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
                        var idRep = "#reponse" + i;
                        var r = $(idRep).val();
                        tabRep.push(r);
                    }

                    for (var i = 1; i < 11; i++) {
                        var idQuest = "#question" + i;
                        var q = $(idQuest).val();
                        tabQuest.push(q);
                    }
                    console.log($("#nomSysteme").val());
                    console.log(tabRep);
                    console.log(tabQuest);

                    var chaineXML = createXMLString($("#nomSysteme").val(), tabRep, tabQuest);

                    console.log(chaineXML);
                    console.log($("#nameLangue").val());

                    ajoutLangue($("#nameLangue").val(), chaineXML);
                    return false;
                });
                $(function () {
                    $("#datepicker").datepicker({
                        format: 'dd/mm/yyyy'
                    });
                });


                if (statutUtil != "Administrateur") {
                    $("#AjoutAd").hide();
                }
            });

        </script>

        <style type="text/css">
            .bs-example{
                margin: 20px;
            }

            li:hover {
                background-color: #D8D8D8;
            }

            body {
            font-family: 'Slabo 27px', serif;
        }
        </style>
    </head>

    <body>

        <?php include("menu.php"); ?>

        <div class="container">
            <form id="formAjout" class="form-horizontal" role="form">

                <div id="alertSuccess" class="alert alert-success" role="alert"></div>

                <div id="alertFail" class="alert alert-danger" role="alert">Erreur ajout de langue</div>

                <div id="listeFilesXML" class="form-group">
                    <div class="row">
                        <div class="col-md-12"><span class="glyphicon glyphicon-folder-open" style="color:rgb(150, 150, 55)" aria-hidden="true"></span>&thinsp;&thinsp;&thinsp;&thinsp; Liste des fichiers de langues pr&eacute;sents :</div>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label for="nameLangue" class="col-sm-3 control-label">Nouvelle langue :</label>
                    <div class="col-sm-4">
                        <input id="nameLangue" type="text" class="form-control" placeholder="Exemple : English, Chinese, etc." required>
                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <label for="nomSysteme" class="col-sm-3 control-label">Mot Syst&egrave;me</label>
                    <div class="col-sm-4">
                        <input id="nomSysteme" type="text" class="form-control" placeholder="Traduction du mot système dans la nouvelle langue" required>
                    </div>
                </div>

                <hr></hr>

                <div class="form-group">
                    <label class="col-sm-3 control-label">R&eacute;ponses :</label>
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
        </div>
    </body>

</html>