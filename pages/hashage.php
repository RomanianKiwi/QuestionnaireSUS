<?php
	
	$email = $_Post['email'];
	$sysName = $_Post['sysName'];

	$HashedMail = hash('ripemd160', $email);
	$hashed = $HashedMail = hash('ripemd160', $sysName); // il ya possibilité de modifié l'algo de hashage si vous avez des préferences n'hesitez pas.
?>