<?php
class ExerciceGenere{
	private $idSujet;
	private $idValeur;

	public function __construct(){
		$nbArguments = func_num_args();

		switch ($nbArguments) {
			case 1:
				$this->affecteAvecTableau(func_get_arg(0));
				break;

			case 2:
				$this->affecteValeurs(func_get_arg(0), func_get_arg(1));
				break;
		}
	}

	public function affecteAvecTableau($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'idSujet' :
					$this->setIdSujet($valeur);
					break;

        case 'idValeur' :
					$this->setIdValeur($valeur);
					break;
			}
		}
	}

	public function affecteValeurs($idSujet, $idValeur){
		$this->setIdSujet($idSujet);
    $this->setIdValeur($idValeur);
	}

	public function getIdSujet(){
		return $this->idSujet;
	}

	public function setIdSujet($idSujet){
    if(is_numeric($idSujet)){
			$this->idSujet = $idSujet;
		}
	}

	public function getIdValeur(){
		return $this->idValeur;
	}

	public function setIdValeur($idValeur){
		if(is_numeric($idValeur)){
			$this->idValeur = $idValeur;
		}
	}
}
