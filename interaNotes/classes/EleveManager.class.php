<?php
class EleveManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

  public function getIdEleveByLogin($login){

		$sql = 'SELECT idEleve FROM eleve e INNER JOIN personne p ON(p.idPersonne=e.idEleve) WHERE p.login=:login';
		$req = $this->db->prepare($sql);
		$req->bindValue(':login',$login,PDO::PARAM_STR);
		$req->execute();

		$res = $req->fetch(PDO::FETCH_OBJ);
		$req->closeCursor();

		return $res->idEleve;
	}

	public function getEleve($personne){

		$sql = 'SELECT annee, nomPromo FROM eleve WHERE idEleve = :id';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':id', $personne->getIdPersonne());
		$requete->execute();

		$eleve = $requete->fetch(PDO::FETCH_OBJ);
		$requete->closeCursor();

		return new Eleve($personne, $eleve);
	}

	public function getAllPromo() {
		$sql = 'SELECT DISTINCT nomPromo, annee FROM eleve e';
		$req = $this->db->prepare($sql);
		$req->execute();

		while($promo = $req->fetch(PDO::FETCH_OBJ)){
			$listePromo[] = $promo;
		}

		$req->closeCursor();

		if(isset($listePromo)) {
			return $listePromo;
		}
		return false;
	}

	public function getAllIdElevesByPromo($nomPromo) {
		$sql = 'SELECT idEleve FROM eleve e WHERE e.nomPromo = :nomPromo';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':nomPromo', $nomPromo);
		$requete->execute();

		while($eleve = $requete->fetch(PDO::FETCH_OBJ)){
			$listeEleves[] = $eleve->idEleve;
		}

		$requete->closeCursor();
		return $listeEleves;
	}

}
