<?php
	ini_set('SMTP','smtp.free.fr');
	ini_set('sendmail_from','equipetix@gmail.com');
	if(isset($_POST) && isset($_POST['objet']) && isset($_POST['choixQuestionnaire']) && isset($_POST['message']) && isset($_POST['destinataires']))
	{
		if(!empty($_POST['objet']) && !empty($_POST['choixQuestionnaire']) && !empty($_POST['message']) && !empty($_POST['destinataires'])){
			$destinataire = $_POST['destinataires'];
			$sujet = $_POST['objet'];
			$message = $_POST['message'].'questionnaire sur :'.$_POST['choixQuestionnaire'];
			$entete = 'From: equipetix@gmail.com'."\n".'Reply-To: equipetix@gmail.com'."\n";
			if (mail($destinataire,$sujet,$message,$entete)){
				echo 'Message envoyé';
			} else {
				echo "Une erreur est survenue lors de l'envoi du formulaire par email";
			}
		}
}

?>