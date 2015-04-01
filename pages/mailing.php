<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['statut']) && isset($_SESSION['ID'])) {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $log = $_SESSION['login'];
    $mpass = $_SESSION['password'];
    $statut = $_SESSION['statut'];
    $id_user = $_SESSION['ID'];
    $reponse = $bdd->query("SELECT * FROM administrateur WHERE UserName= \"" . $log . "\"AND PassWord = \"" . $mpass . "\"AND Statut = \"" . $statut . "\";");
    $donnees = $reponse->fetch(PDO::FETCH_ASSOC);
//Partie Envoi de mail.
    if ($donnees['UserName'] != "" && $donnees['PassWord'] != "" && $_SESSION['login'] != "" && $donnees['Statut'] != "") {
        ini_set('SMTP', 'smtp.orange.fr');
        ini_set('sendmail_from', 'equipetix@gmail.com');
        if (isset($_POST) && isset($_POST['objet']) && isset($_POST['choixQuestionnaire']) && isset($_POST['message']) && (isset($_POST['autresDestinataires']) || isset($_POST['adresses']))) {
            if (!empty($_POST['objet']) && !empty($_POST['choixQuestionnaire']) && !empty($_POST['message']) && !empty($_POST['autresDestinataires'] || $_POST['adresses'])) {
// Création de l'email.
                $passage_ligne = "\r\n";
                $sujet = $_POST['objet'];
                $message_txt = $_POST['message'] . ' voici le lien sur le questionnaire: ';
                $urlIni = "http://localhost/QuestionnaireSUS/pages/formulaire.php";

                function hashMail($Email) {
                    $test = hash('md5', $Email);
                    $retval = base_convert($test, 16, 10);
                    return $retval;
                }

                $boundary = "-----=" . md5(rand());
                $header = "From: \"equipetix\"<equipetix@gmail.com>" . $passage_ligne;
                $header.= "Reply-to: \"equipetix\" <equipetix@gmail.com>" . $passage_ligne;
                $header.= "MIME-Version: 1.0" . $passage_ligne;
                $header.= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"" . $boundary . "\"" . $passage_ligne;
//=====Création du message.
                $message_head = $passage_ligne . "--" . $boundary . $passage_ligne;
//=====Ajout du message au format texte.
                $message_head.= "Content-Type: text/plain; charset=\"ISO-8859-1\"" . $passage_ligne;
                $message_head.= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
                $message_txt.=$_POST['choixQuestionnaire'] . ' ';
                $reponse2 = $bdd->query("SELECT NumVersion from versionquestionnaire V, questionnaire Q WHERE V.IdQuest = Q.IdQuest AND Nom = '" . $_POST['choixQuestionnaire'] . "' ORDER BY NumVersion DESC LIMIT 1;");
                $donnees2 = $reponse2->fetch(PDO::FETCH_ASSOC);
                $lastV = $donnees2['NumVersion'];
                $reponse2->closeCursor();
                $reponse3 = $bdd->query("SELECT IdQuest from questionnaire WHERE Nom = '" . $_POST['choixQuestionnaire'] . "';");
                $donnees3 = $reponse3->fetch(PDO::FETCH_ASSOC);
                $numQ = $donnees3['IdQuest'];
                $reponse3->closeCursor();
//envoi de mail destinataires du carnet
                $boolmail = true;
                if (isset($_POST['adresses'])) {
                    foreach ($_POST['adresses'] as $destinataire) {
                        $mailHascher = hashMail($destinataire);
                        $nomHasher = hashMail($_POST['choixQuestionnaire']);
                        $message_url = $urlIni . "?c=" . $nomHasher . "&n=" . $mailHascher;
                        $message = $message_head . $passage_ligne . $message_txt . $message_url . $passage_ligne . $passage_ligne . "--" . $boundary . $passage_ligne;
// fin du message
                        $participation = "INSERT INTO participer VALUES ('0','" . $lastV . "','" . $mailHascher . "','" . $numQ . "');";
                        $bdd->exec($participation);
                        if (mail($destinataire, $sujet, $message, $header)) {
                            
                        } else {
                            $boolmail = false;
                        }
                    }
                }
//envoi de mail destinataires autres
                $destinataires_sup = $_POST['autresDestinataires'];
                if ($destinataires_sup != "") {
                    $destinataires_array = explode("\n", $destinataires_sup);
                    $nb_dest = count($destinataires_array);
                } else {
                    $nb_dest = 0;
                }
                for ($i = 0; $i < $nb_dest; $i++) {
                    $mailHascher = hashMail($destinataires_array[$i]);
                    $nomHasher = hashMail($_POST['choixQuestionnaire']);
                    $message_url = $urlIni . "?n=" . $mailHascher . "&c=" . $nomHasher;
                    $message = $message_head . $passage_ligne . $message_txt . $message_url . $passage_ligne . $passage_ligne . "--" . $boundary . $passage_ligne;
// fin du message
                    $testBool = "false";
                    $reponse4 = $bdd->query('SELECT * FROM utilisateurs');
                    while ($donnees4 = $reponse4->fetch()) {
                        if ($mailHascher == $donnees4['InviteCode'])
                            $testBool = "true";
                    }
                    $reponse4->closeCursor();
                    if ($testBool == "false") {
//etape 1 : inserer utilisateur dans la table utilisateurs si il n'existe pas déjà :
                        $etape1 = "INSERT INTO utilisateurs VALUES ('" . $mailHascher . "' , '" . $destinataires_array[$i] . "', NULL, NULL);";
                    } else
                        $etape1 = "";
//etape 2 : inserer dans gerer le code hashé et le code du carnet en cours :
                    $etape2 = "INSERT INTO gerer VALUES ('0', '" . $mailHascher . "');";
                    $bdd->exec($etape1 . $etape2);
                    $participation2 = "INSERT INTO participer VALUES ('0','" . $lastV . "','" . $mailHascher . "','" . $numQ . "');";
                    $bdd->exec($participation2);
                    if (mail($destinataires_array[$i], $sujet, $message, $header)) {
                        
                    } else {
                        $boolmail = false;
                    }
                }
            }
        }
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
        <title>Invitation de participants</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
		<script src="../js/jquery-2.1.3.js"></script>
		<script src="../js/bootstrap.js"></script>	
    </head>
    <script type="text/javascript">
        $(document).ready(function () {
            var statutUtil = "<?php echo $_SESSION['statut']; ?>";
            if (statutUtil != "Administrateur") {
                $(".AjoutAd").hide();
            }
            //Masquer toutes les alertes par défaut
            $('.alert').hide();
            $('#mails').attr('display', 'none');
            function afficherListeQuestionnaires(id) {
                $.ajax({
                    type: "POST",
                    url: "requeteListeQuestionnaire.php",
                    async: false,
                    dataType: 'json',
					data: 'id=' + id,
                    success: function (data)
                    {
                        if (data.length == 0)
                            $('#choixQuestionnaire').append("<option value='choix1'>Aucun Questionnaire</option>");
                        else {
                            for (var i = 0; i < data.length; i++)
                                $('#choixQuestionnaire').append('<option value="' + data[i].Nom + '">' + data[i].Nom + '</option>');
                        }
                    }
                });
            }
            var iduser = parseInt('<?php echo $id_user; ?>');
            afficherListeQuestionnaires(iduser);
            function afficherListeCarnet(id) {
                $.ajax({
                    type: "POST",
                    url: "requeteListeCarnet.php",
                    async: false,
                    dataType: 'json',
                    data: 'id=' + id,
                    success: function (data)
                    {
                        if (data.length == 0)
                        {
                        }
                        else {
                            for (var i = 0; i < data.length; i++)
                                $('#choixCarnet').append('<option value="' + data[i].NomCarnet + '">' + data[i].NomCarnet + '</option>');
                        }
                    }
                });
            }
            afficherListeCarnet(iduser);
        });
        function changementCarnet() {
            $("#mails").children().children().children().remove();
            var carnet = $('#choixCarnet option:selected').val();
            if (carnet != "aucun") {
                $("#mails").attr('display', 'block');
                $.ajax({
                    type: "POST",
                    url: "requeteListeAdresse.php",
                    async: false,
                    data: 'carnet=' + carnet,
                    dataType: 'json',
                    success: function (data)
                    {
                        for (var i = 0; i < data.length; i++)
                            $("#mails").children().children().append('<div class="checkbox"><label display="block"><input type="checkbox" name="adresses[]" value="' + data[i].Email + '" checked/>' + data[i].Email + '</label></div>');
                    }
                });
            }
        }
    </script>
    <style>
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
<?php include("menu.php"); ?>
    <h1>Invitation de participants</h1>
    <form id="formMail" class="form-horizontal" role="form" action="mailing.php" method="post">
        <div class="row">
            <div class="form-group">
                <label for="objet" class="col-sm-3 control-label">Objet: </label>
                <div class="col-sm-4">
                    <input id="objet" type="text" name="objet" class="form-control" placeholder="Objet de votre message" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="choixQuestionnaire" class="col-sm-3 control-label">Choix Questionnaire: </label>
                <div class="col-sm-4">
                    <select id="choixQuestionnaire" name="choixQuestionnaire" class="form-control" required>
                    </select>
                </div>
            </div>
        </div>
        <div id="carnet" class="row">
            <div class="form-group">
                <label for="choixCarnet" class="col-sm-3 control-label">Choix Carnet d'adresse: </label>
                <div class="col-sm-4">
                    <select id="choixCarnet" name="choixCarnet" class="form-control" onchange="changementCarnet();">
                        <option value="aucun" selected>Aucun</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="mails" class="row">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-4">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="autresDestinataires" class="col-sm-3 control-label">Autres destinataires: </label>
                <div class="col-sm-4">
                    <textarea id="autreDestinataires" name="autresDestinataires" class="form-control" rows="4" placeholder="Indiquez les destinataires sur une ligne diff&eacute;rente."></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="message" class="col-sm-3 control-label">Message: </label>
                <div class="col-sm-4">
                    <textarea id="message" name="message" class="form-control" rows="4" placeholder="Votre message ici" required></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                    <button id="envoyer" type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </div>
        </div>
    </form>
    <div id="succes" class="alert alert-success">Invitations envoyées.</div>
    <div id="echec" class="alert alert-danger">Erreur dans l'envoi d'invitations.</div>
</body>
</html>