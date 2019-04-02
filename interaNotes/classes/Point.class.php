<?php
class Point{
	private $idPoint;
	private $idExamen;
	private $nomPoint;
	private $estDonneesCatia;
	private $idSymboleMathematique;
	private $idFormuleMathematique;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'idPoint' :
				$this->setIdPoint($valeur);
				break;

				case 'idExamen' :
				$this->setIdExamenPoint($valeur);
				break;

				case 'nomPoint' :
				$this->setNomPoint($valeur);
				break;

				case 'estDonneesCatia' :
				$this->setEstDonneesCatia($valeur);
				break;

				case 'idSymboleMathematique' :
				$this->setIdSymboleMathematique($valeur);
				break;

				case 'idFormuleMathematique' :
				$this->setIdFormuleMathematique($valeur);
				break;
			}
		}
	}

	public function getIdPoint(){
		return $this->idPoint;
	}

	public function setIdPoint($id){
		if(is_numeric($id)){
			$this->idPoint = $id;
		}
	}

	public function getIdExamenPoint(){
		return $this->idExamen;
	}

	public function setIdExamenPoint($idExamen){
		$this->idExamen = $idExamen;
	}

	public function getNomPoint(){
		return $this->nomPoint;
	}

	public function setNomPoint($nomPoint){
		$this->nomPoint = $nomPoint;
	}

	public function getEstDonneesCatia(){
		return $this->estDonneesCatia;
	}

	public function setEstDonneesCatia($estDonneesCatia){
		$this->estDonneesCatia = $estDonneesCatia;
	}

	public function getIdSymboleMathematique(){
		return $this->idSymboleMathematique;
	}

	public function setIdSymboleMathematique($idSymboleMathematique){
		$this->idSymboleMathematique = $idSymboleMathematique;
	}

	public function getIdFormuleMathematique(){
		return $this->idFormuleMathematique;
	}

	public function setIdFormuleMathematique($idFormuleMathematique){
		$this->idFormuleMathematique = $idFormuleMathematique;
	}

	public function aUnSymboleMathematique(){
		return $this->getIdSymboleMathematique() != 0;
	}

	public function aUneFormuleMathematique(){
		return $this->getIdFormuleMathematique() != 0;
	}

}
