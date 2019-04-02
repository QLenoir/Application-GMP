<?php
	function getEnglishDate($date){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[1].'-'.$membres[0];
		return $date;
	}

	function getFrenchDate($date){
		$dateTab = explode('-', $date);
		$tabJourHeure = explode(' ',$dateTab[2]);
		return $tabJourHeure[0]."/".$dateTab[1]."/".$dateTab[0];
	}

	function getFrenchDateWithHours($date){
		$dateTab = explode('-', $date);
		$tabJourHeure = explode(' ',$dateTab[2]);
		return $tabJourHeure[0]."/".$dateTab[1]."/".$dateTab[0]." ".$tabJourHeure[1];
	}

	function createProtectedPassword($pwd){
    	$protectedPassword = sha1(sha1($pwd).SALT);

		return $protectedPassword;
	}

	function createRandomPassword(){
		return substr(str_shuffle(strtolower(sha1(rand() . time() . SALT))),0, PASSWORD_LENGTH);
	}

?>
