<?php
class Note{
	private $idEleve;
	private $idSujet;
	private $note;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'idEleve' :
				$this->setIdEleve($valeur);
				break;

				case 'idSujet' :
				$this->setIdSujet($valeur);
				break;

				case 'note' :
				$this->setNote($valeur);
				break;
			}
		}
	}

	public function getIdEleve(){
		return $this->idEleve;
	}

	public function setIdEleve($idEleve){
		$this->idPoint = $idEleve;
	}

	public function getIdSujet(){
		return $this->idSujet;
	}

	public function setIdSujet($idSujet){
		$this->idSujet = $idSujet;
	}

	public function getNote(){
		return $this->note;
	}

	public function setNote($note){
		$this->note = $note;
	}

}