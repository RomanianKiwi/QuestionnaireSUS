<?php
// le contenu du script est à intégrer à vos pages php directement d'où le choix de stocker le resulat dans des variables.
// faites moi savoir si vous voulez que je m'y prenne d'une autre façon.
	
	$email = $_Post['email'];
	$sysName = $_Post['sysName'];

	$HashedMail = hash('ripemd160', $email);
	$hashed = $HashedMail = hash('ripemd160', $sysName); // il ya possibilité de modifié l'algo de hashage si vous avez des préferences n'hesitez pas.
?>