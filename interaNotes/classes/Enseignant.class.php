<?php
class Enseignant{
	private $personneObj;

	public function __construct($personneObj){
		$this->affecte($personneObj);
	}

	public function affecte($personneObj){
		$this->setPersonneEnseignant($personneObj);
	}

	public function getPersonneEnseignant(){
		return $this->personneObj;
	}

	public function setPersonneEnseignant($personneObj){
		$this->personneObj = $personneObj;
	}
}
