<?php
class Examen{
	private $idExamen;
	private $dateDepot;
	private $anneeScolaire;
	private $titreExamen;
	private $consigneExamen;
	private $nbEssaiPossible;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'idExamen' :
				$this->setIdExamen($valeur);
				break;

				case 'dateDepot' :
				$this->setDateDepotExamen($valeur);
				break;

				case 'anneeScolaire' :
				$this->setAnneeScolaireExamen($valeur);
				break;

				case 'titreExamen' :
				$this->setTitreExamen($valeur);
				break;

				case 'consigneExamen' :
				$this->setConsigneExamen($valeur);
				break;

				case 'nbEssaiPossible' :
				$this->setNbEssaiPossible($valeur);
				break;
			}
		}
	}

	public function getIdExamen(){
		return $this->idExamen;
	}

	public function setIdExamen($id){
		if(is_numeric($id)){
			$this->idExamen = $id;
		}
	}

	public function getDateDepotExamen(){
		return $this->dateDepot;
	}

	public function setDateDepotExamen($date){
		$this->dateDepot = $date;
	}

	public function getAnneeScolaireExamen(){
		return $this->anneeScolaire;
	}

	public function setAnneeScolaireExamen($anneeScolaire){
		if(is_numeric($anneeScolaire)){
			$this->anneeScolaire = $anneeScolaire;
		}
	}

	public function getTitreExamen(){
		return $this->titreExamen;
	}

	public function setTitreExamen($titreExamen){
		$this->titreExamen = $titreExamen;
	}

	public function getConsigneExamen(){
		return $this->consigneExamen;
	}

	public function setConsigneExamen($consigneExamen){
		$this->consigneExamen = $consigneExamen;
	}

	public function getNbEssaiPossible(){
		return $this->nbEssaiPossible;
	}

	public function setNbEssaiPossible($nbEssaiPossible){
		$this->nbEssaiPossible = $nbEssaiPossible;
	}

	public function getStatut($estAttribue){
		if($this->estFini()){
			return StatutExamen::TERMINE;

		}elseif(!$estAttribue){
			return StatutExamen::NON_DISTRIBUE;

		}else{
			return StatutExamen::EN_COURS;
		}
	}

	public function estFini(){
		$dateFin = new DateTime($this->dateDepot);
		$dateDuJour = new DateTime();
		return $dateDuJour >= $dateFin;
	}

}
