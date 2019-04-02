<?php
class Enonce{
	private $id;
	private $titre;
	private $consigne;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'idEnonce' :
					$this->setIdEnonce($valeur);
					break;

				case 'titre' :
					$this->setTitreEnonce($valeur);
					break;

				case 'consigne' :
					$this->setConsigneEnonce($valeur);
					break;
			}
		}
	}

	public function getIdEnonce(){
		return $this->id;
	}

	public function setIdEnonce($id){
		if(is_numeric($id)){
			$this->id = $id;
		}
	}

	public function getTitreEnonce(){
		return $this->titre;
	}

	public function setTitreEnonce($titre){
		$this->titre = $titre;
	}

	public function getConsigneEnonce(){
		return $this->consigne;
	}

	public function setConsigneEnonce($consigne){
		$this->consigne = $consigne;
	}
}
