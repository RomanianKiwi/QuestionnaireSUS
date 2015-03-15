<?php
	ini_set('SMTP','smtp.free.fr');
	ini_set('sendmail_from','equipetix@gmail.com');
	if(isset($_POST) && isset($_POST['objet']) && isset($_POST['choixQuestionnaire']) && isset($_POST['message']) && isset($_POST['destinataires']))
	{
		if(!empty($_POST['objet']) && !empty($_POST['choixQuestionnaire']) && !empty($_POST['message']) && !empty($_POST['destinataires'])){
		
			// Création de l'email
			$passage_ligne = "\r\n";
			$sujet = $_POST['objet'];
			$message_txt = $_POST['message'].' voici le lien sur le questionnaire: ';
			
			$boundary = "-----=".md5(rand());
			
			$header = "From: \"equipetix\"<equipetix@gmail.com>".$passage_ligne;
			$header.= "Reply-to: \"equipetix\" <equipetix@gmail.com>".$passage_ligne;
			$header.= "MIME-Version: 1.0".$passage_ligne;
			$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"".$boundary."\"".$passage_ligne;
			
			//=====Création du message.
			$message = $passage_ligne."--".$boundary.$passage_ligne;
			//=====Ajout du message au format texte.
			$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;		
			try {
					$bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
			} catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());
			}
			
			$questionnaire = $_POST['choixQuestionnaire'];
			$reponse = $bdd->query("SELECT nom, url FROM questionnaire WHERE nom = \"".$questionnaire."\";");
			while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
			{
				$message_txt .= $donnees['url'].' '.$passage_ligne;
			}	
			$reponse->closeCursor();
			
			$message.= $passage_ligne.$message_txt.$passage_ligne;
			$message.= $passage_ligne."--".$boundary.$passage_ligne;
			// fin du message

			$destinataires = $_POST['destinataires'];
			$destinataires_array = explode("\n",$destinataires);
			$nb_dest = count($destinataires_array);

			for($i=0;$i<$nb_dest;$i++)
			{
				if (mail($destinataires_array[$i],$sujet,$message,$header)){
					echo 'Message'.$i.' envoyé';
					echo '</br>';
				} else {
					echo 'Une erreur est survenue lors de l\'envoi du mail'.$i;
					echo '</br>';
				}
			}
			echo '<a href="mailing.php">Retour page invitation</a>';

		}
}

?>