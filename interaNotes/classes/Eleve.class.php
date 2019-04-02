<?php
class Eleve{
	private $personneObj;
	private $anneeInscription;
	private $nomPromotion;

	public function __construct($personneObj, $valeursEtudiant){
		if(!empty($valeursEtudiant)){
			$this->affecte($personneObj, $valeursEtudiant);
		}
	}

	public function affecte($personneObj, $valeursEtudiant){
		$this->setPersonneEleve($personneObj);

		foreach($valeursEtudiant as $attribut => $valeur){

			switch($attribut){
				case 'annee' :
					$this->setAnneeInscription($valeur);
					break;

				case 'nomPromo' :
					$this->setNomPromotion($valeur);
					break;
			}
		}
	}

	public function getPersonneELeve(){
		return $this->personneObj;
	}

	public function setPersonneEleve($personneObj){
		$this->personneObj = $personneObj;
	}

	public function getAnneeInscription(){
		return $this->anneeInscription;
	}

	public function setAnneeInscription($anneeInscription){
		if(is_numeric($anneeInscription)){
			$this->anneeInscription = $anneeInscription;
		}
	}

	public function getNomPromotion(){
		return $this->nomPromotion;
	}

	public function setNomPromotion($nomPromotion){
		$this->nomPromotion = $nomPromotion;
	}
}
