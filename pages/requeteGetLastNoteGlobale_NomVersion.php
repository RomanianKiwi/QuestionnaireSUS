<?php
    try {
            $bdd = new PDO('mysql:host=localhost;dbname=cl24-project;charset=utf8', 'cl24-project', 'teamTIX');
    } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
    }

    $nomSysHash = $_POST['Code'];
    $mailHash = $_POST['MailH'];

    $reponse = $bdd->query("SELECT NumVersion, DateExpiration, SommeNote, NbReponses, V.IdQuest, Nom FROM versionquestionnaire V, questionnaire Q
                                                    WHERE V.IdQuest = Q.IdQuest
                                                    AND V.IdQuest in (SELECT IdQuest FROM questionnaire WHERE Nom in (SELECT SysName FROM syshash WHERE HashCode = ".$nomSysHash."))
                                                    ORDER BY NumVersion DESC LIMIT 1;");

    $reponseMail = $bdd->query("SELECT InviteCode FROM participer WHERE InviteCode = ".$mailHash." AND statut_Invitation = '0';");

    $donnees = $reponse->fetch();
    $donnees2 = $reponseMail->fetch();

    $data = array(
        "NumVersion"      => $donnees['NumVersion'],
        "DateExpiration"  => $donnees['DateExpiration'],
        "SommeNote"       => $donnees['SommeNote'],
        "NbReponses"      => $donnees['NbReponses'],
        "IdQuest"         => $donnees['IdQuest'],
        "Nom"             => $donnees['Nom'],
        "InviteCode"      =>  $donnees2['InviteCode']
    );
    echo json_encode($data);

    $reponse->closeCursor();
    $reponseMail->closeCursor();
?>

