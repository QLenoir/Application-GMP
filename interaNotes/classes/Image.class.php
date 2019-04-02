<?php
class Image{
	private $idImage;
	private $cheminImage;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'idImage' :
					$this->setIdImage($valeur);
					break;

				case 'cheminImage' :
					$this->setCheminImage($valeur);
					break;
			}
		}
	}

	public function getIdImage(){
		return $this->idImage;
	}

	public function setIdImage($id){
		if(is_numeric($id)){
			$this->idImage = $id;
		}
	}

	public function getCheminImage(){
		return $this->cheminImage;
	}

	public function setCheminImage($cheminImage){
		$this->cheminImage = $cheminImage;
	}
}
