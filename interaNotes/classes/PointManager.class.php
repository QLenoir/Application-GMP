<?php
class PointManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getAllPointsOfExamens($idExamen){

		$sql = 'SELECT idPoint, idExamen, nomPoint FROM points WHERE idExamen=:idExamen';

    $requete = $this->db->prepare($sql);
		$requete->bindValue(':idExamen', $idExamen);
		$requete->execute();

		while($point = $requete->fetch(PDO::FETCH_OBJ)){
			$listePoints[] = new Point($point);
		}

		$requete->closeCursor();
		return $listePoints;
	}

	public function getPoint($idPoint){
		$sql = 'SELECT idPoint, idExamen, nomPoint, estDonneesCatia, idSymboleMathematique, idFormuleMathematique FROM points WHERE idPoint=:idPoint';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':idPoint', $idPoint);
		$requete->execute();

		$point = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		return new Point($point);
	}

	public function getCheminOfSymboleMathematique($point){
		$sql = 'SELECT cheminImage FROM images WHERE idImage=:idImage';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':idImage', $point->getIdSymboleMathematique());
		$requete->execute();

		$image = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		return $image->cheminImage;
	}

	public function getCheminOfFormuleMathematique($point){
		$sql = 'SELECT cheminImage FROM images WHERE idImage=:idImage';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':idImage', $point->getIdFormuleMathematique());
		$requete->execute();

		$image = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		return $image->cheminImage;
	}

	public function getIdPointMaximal(){
		$sql = 'SELECT max(idPoint) as maxId FROM points';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		$point = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		if($point->maxId == null){
			return 1;
		}
		return $point->maxId +1;
	}
}
