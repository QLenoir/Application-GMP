<?php
class SujetManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getAllSujetsOfExamen($idExamen){

		$sql = 'SELECT idSujet, idEnonce, semestre, idExamen FROM sujet s WHERE idExamen=:idExamen ';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':idExamen',$idExamen);
		$requete->execute();

		while($sujet = $requete->fetch(PDO::FETCH_OBJ)){
			$listeSujets[] = new Sujet($sujet);
		}

		$requete->closeCursor();

		return $listeSujets;
	}

	public function getAllSujetsOfExamenAttribues($idExamen){

		$sql = 'SELECT e.idSujet, idEnonce, semestre, idExamen FROM sujet s INNER JOIN exerciceattribue e ON s.idSujet=e.idSujet WHERE idExamen=:idExamen ';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':idExamen',$idExamen);
		$requete->execute();

		while($sujet = $requete->fetch(PDO::FETCH_OBJ)){
			$listeSujet[] = new Sujet($sujet);
		}

		$requete->closeCursor();

		if(isset($listeSujet)){
			return $listeSujet;
		}
		return false;
	}

	public function getSujet($idSujet){

		$sql = 'SELECT idSujet, idEnonce, semestre, idExamen FROM sujet s
		WHERE s.idSujet=:idSujet';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':idSujet', $idSujet);
		$requete->execute();

		$sujet = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		return new Sujet($sujet);
	}

	public function getIdSujetByLogin($login) {
		$sql = 'SELECT s.idSujet FROM sujet s
		INNER JOIN exerciceattribue e ON(e.idSujet=s.idSujet)
		INNER JOIN personne p ON(p.idPersonne=e.idEleve)
		WHERE p.login=:login ORDER BY s.idSujet DESC'; 

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':login', $login);
		$requete->execute();

		$sujet = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		if(!$sujet){
			return false;
		}
		return $sujet->idSujet;
	}

	public function getIdSujetPossible(){
		$sql = 'SELECT max(idSujet) as maxId FROM sujet';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		$sujet = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		if($sujet->maxId == null){
			return 1;
		}
		return $sujet->maxId +1;
	}

	public function sujetEstExistant($idSujet){
		$sql = 'SELECT idSujet FROM sujet WHERE idSujet=:idSujet';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':idSujet', $idSujet);
		$requete->execute();

		$res = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();

		if(isset($res->idSujet)){
			return true;
		}
		return false;
 	}

	public function insererTableauSujets($sujets) {
		$sujetsTableaux = $this->preparationRequeteTableauSujets($sujets);

		$args = array_fill(0, count($sujetsTableaux[0]), '?');

		$this->db->beginTransaction();
		$sql = "INSERT INTO sujet(idSujet, idEnonce, semestre, idExamen, nbEssaiRealise) VALUES (".implode(',', $args).")";
		$requete = $this->db->prepare($sql);

		foreach ($sujetsTableaux as $row)
		{
			$requete->execute($row);
		}
		$resultat = $this->db->commit();

		$requete->closeCursor();
		return $resultat;
	}

	private function preparationRequeteTableauSujets($sujetsObjets){
		foreach ($sujetsObjets as $sujet) {
      $sujetsTableaux[] = array($sujet->getIdSujet(), $sujet->getIdEnonce(), $sujet->getSemestreOfSujet(), $sujet->getIdExamenOfSujet(), $sujet->getNbEssaiRealise());
    }

		return $sujetsTableaux;
	}

	public function getSujetTermineByLogin($login) {
		$sql = 'SELECT s.idSujet FROM sujet s
			INNER JOIN exerciceattribue e ON(e.idSujet=s.idSujet)
			INNER JOIN personne p ON(p.idPersonne=e.idEleve)
			INNER JOIN examen ex ON(s.idExamen=ex.idExamen)
			WHERE p.login=:login
			AND ex.dateDepot<now()';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':login', $login);
		$requete->execute();


		while($sujet = $requete->fetch(PDO::FETCH_OBJ)){
			$listeSujet[] = $sujet->idSujet;
		}

		$requete->closeCursor();

		if (isset($listeSujet)) {
			return $listeSujet;
		}
		return false;
	}

}
