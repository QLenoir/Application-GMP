<?php
class ResultatsAttendus{
	private $idSujet;
	private $idQuestion;
	private $resultat;
	private $exposantUnite;
	private $resultatUnite;
	private $resultatExposant;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'idSujet' :
					$this->setIdSujet($valeur);
					break;
				case 'idQuestion' :
					$this->setIdQuestion($valeur);
					break;
				case 'resultat' :
					$this->setResultat($valeur);
					break;
				case 'exposantUnite' :
					$this->setExposantUnite($valeur);
					break;
				case 'resultatUnite' :
					$this->setResultatUnite($valeur);
					break;
				case 'resultatExposant' :
					$this->setResultatExposant($valeur);
					break;
			}
		}
	}

	public function getIdSujet(){
		return $this->idSujet;
	}

	public function setIdSujet($idSujet){
		$this->idSujet = $idSujet;
	}

	public function getIdQuestion(){
		return $this->idQuestion;
	}

	public function setIdQuestion($idQuestion){
		$this->idQuestion = $idQuestion;
	}

	public function getResultat(){
		return $this->resultat;
	}

	public function setResultat($resultat){
		$this->resultat = $resultat;
	}

	public function getExposantUnite(){
		return $this->exposantUnite;
	}

	public function setExposantUnite($exposantUnite){
		$this->exposantUnite = $exposantUnite;
	}

	public function getResultatUnite(){
		return $this->resultatUnite;
	}

	public function setResultatUnite($resultatUnite){
		$this->resultatUnite = $resultatUnite;
	}

	public function getResultatExposant(){
		return $this->resultatExposant;
	}

	public function setResultatExposant($resultatExposant){
		$this->resultatExposant = $resultatExposant;
	}
}
