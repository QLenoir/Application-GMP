<?php
class Dependance{
	private $idValeur;
	private $idValeurDependante;

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

				case 'idValeurDependante' :
					$this->setIdValeurDependante($valeur);
					break;
			}
		}
	}

	public function getIdValeur(){
		return $this->idValeur;
	}

	public function setIdValeur($id){
		if(is_numeric($id)){
			$this->idValeur = $id;
		}
	}

	public function getIdValeurDependante(){
		return $this->idValeurDependante;
	}

	public function setIdValeurDependante($idValeurDependante){
    if(is_numeric($idValeurDependante)){
		    $this->idValeurDependante = $idValeurDependante;
    }
	}
}
