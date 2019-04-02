<?php
class EnonceManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getEnonce($idEnonce){

		$sql = 'SELECT idEnonce, titre, consigne FROM enonce e
            WHERE e.idEnonce=:idEnonce';

		$requete = $this->db->prepare($sql);
    $requete->bindValue(':idEnonce', $idEnonce);
		$requete->execute();

		$enonce = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();
		return new Enonce($enonce);
	}

	public function insererTableauEnonces($enonces) {
		$enoncesTableaux = $this->preparationRequeteTableauEnonces($enonces);

		$args = array_fill(0, count($enoncesTableaux[0]), '?');

		$this->db->beginTransaction();
		$sql = "INSERT INTO enonce(idEnonce, titre, consigne) VALUES (".implode(',', $args).")";
		$requete = $this->db->prepare($sql);

		foreach ($enoncesTableaux as $row)
		{
			$requete->execute($row);
		}
		$resultat = $this->db->commit();

		$requete->closeCursor();
		return $resultat;
	}

	private function preparationRequeteTableauEnonces($enoncesObjets){
		foreach ($enoncesObjets as $enonce) {
      $enoncesTableaux[] = array($enonce->getIdEnonce(), $enonce->getTitreEnonce(), $enonce->getConsigneEnonce());
    }

		return $enoncesTableaux;
	}
}
