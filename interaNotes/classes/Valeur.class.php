<?php
class Valeur{
	private $idValeur;
	private $idPoint;
	private $valeur;
	private $exposantValeur;
	private $uniteValeur;
	private $uniteExposant;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'idValeur' :
				$this->setIdValeur($valeur);
				break;

				case 'idPoint' :
				$this->setIdPointOfValeur($valeur);
				break;

				case 'valeur' :
				$this->setValeur($valeur);
				break;

				case 'exposantValeur' :
				$this->setExposantValeur($valeur);
				break;

				case 'uniteValeur' :
				$this->setUniteValeur($valeur);
				break;

				case 'uniteExposant' :
				$this->setUniteExposant($valeur);
				break;
			}
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

	public function getIdPointOfValeur(){
		return $this->idPoint;
	}

	public function setIdPointOfValeur($idPoint){
		if(is_numeric($idPoint)){
			$this->idPoint = $idPoint;
		}
	}

	public function getValeur(){
		return $this->valeur;
	}

	public function setValeur($valeur){
		$this->valeur = $valeur;
	}

	public function getExposantValeur(){
		return $this->exposantValeur;
	}

	public function setExposantValeur($valeur){
		$this->exposantValeur = $valeur;
	}

	public function getUniteValeur(){
		return $this->uniteValeur;
	}

	public function setUniteValeur($valeur){
		$this->uniteValeur = $valeur;
	}

	public function getUniteExposant(){
		return $this->uniteExposant;
	}

	public function setUniteExposant($valeur){
		$this->uniteExposant = $valeur;
	}

}
