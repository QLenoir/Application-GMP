<?php
class Question{
	private $idQuestion;
	private $idExamen;
	private $intituleQuestion;
	private $baremeQuestions;
	private $zoneTolerance;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'idQuestion' :
					$this->setIdQuestion($valeur);
					break;

				case 'idExamen' :
					$this->setIdExamen($valeur);
					break;

				case 'intituleQuestion' :
					$this->setIntituleQuestion($valeur);
					break;
				case 'baremeQuestion' :
					$this->setBaremeQuestion($valeur);
					break;
				case 'zoneTolerance' :
					$this->setZoneTolerance($valeur);
					break;
			}
		}
	}

	public function getIdQuestion(){
		return $this->idQuestion;
	}

	public function setIdQuestion($idQuestion){
		$this->idQuestion = $idQuestion;
	}

	public function getIdExamen(){
		return $this->idExamen;
	}

	public function setIdExamen($idQuestion){
		$this->idExamen = $idExamen;
	}

	public function getIntituleQuestion(){
		return $this->intituleQuestion;
	}

	public function setIntituleQuestion($intituleQuestion){
		$this->intituleQuestion = $intituleQuestion;
	}

	public function getBaremeQuestion(){
		return $this->baremeQuestion;
	}

	public function setBaremeQuestion($bareme){
		$this->baremeQuestion = $bareme;
	}

	public function getZoneTolerance(){
		return $this->zoneTolerance;
	}

	public function setZoneTolerance($zoneTolerance){
		$this->zoneTolerance = $zoneTolerance;
	}
}
