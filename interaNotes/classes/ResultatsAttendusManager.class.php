<?php
class ResultatsAttendusManager {
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getListeDesSujets($idExamen){
		$sql = 'SELECT idSujet FROM sujet s WHERE s.idExamen = :id';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':id', $idExamen);
		$requete->execute();

		while($res = $requete->fetch(PDO::FETCH_ASSOC)){
			$listeIdSujets[] = $res['idSujet'];
		}

		$requete->closeCursor();

		if(isset($listeIdSujets)){
			return $listeIdSujets;
		}

		return false;
	}

	public function insererTableauCorrection($resultatsAttendus) {
		$exercicesTableaux = $resultatsAttendus;

		$args = array_fill(0, count($exercicesTableaux[0]), '?');

		$this->db->beginTransaction();
		$sql = "INSERT INTO exercicegenere(idSujet, idValeur) VALUES (".implode(',', $args).")";
		$requete = $this->db->prepare($sql);

		foreach ($exercicesTableaux as $row)
		{
			$requete->execute($row);
		}
		$resultat = $this->db->commit();

		$requete->closeCursor();
		return $resultat;
	}

	public function getResultatAttendusByQuestion($idSujet, $idQuestion){
		$sql = 'SELECT resultat, resultatExposant, resultatUnite, exposantUnite FROM resultatsattendus WHERE idSujet=:idSujet AND idQuestion=:idQuestion';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':idSujet', $idSujet);
		$requete->bindValue(':idQuestion', $idQuestion);
		$requete->execute();

		$res = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();

		return new ResultatsAttendus($res);
	}
}
