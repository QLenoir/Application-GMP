<?php
class DependanceManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getAllDependances(){

		$sql = 'SELECT idValeur, idValeurDependante FROM dependances';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($dependance = $requete->fetch(PDO::FETCH_OBJ)){
			$listeDependances[] = new Dependance($dependance);
		}

		$requete->closeCursor();
		return $listeDependances;
	}
}
