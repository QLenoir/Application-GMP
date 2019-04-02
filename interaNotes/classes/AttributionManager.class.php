<?php
class AttributionManager{

  private $db;

  public function __construct($db){
		$this->db = $db;
	}

  public function getIdEleveByIdSujet($idSujet){

		$sql = 'SELECT idEleve FROM exerciceattribue e WHERE e.idSujet = :idSujet';

    $req = $this->db->prepare($sql);
		$req->bindValue(':idSujet',$idSujet);
		$req->execute();

		$res = $req->fetch(PDO::FETCH_OBJ);
		$req->closeCursor();

		return $res->idEleve;
	}

  public function insererTableauAttribution($listeEleves, $listeSujets) {
    $tableauAttribution = $this->creerTableauAttributions($listeEleves, $listeSujets);

    $args = array_fill(0, count($tableauAttribution[0]), '?');

		$this->db->beginTransaction();
		$sql = "INSERT INTO exerciceattribue(idEleve, idSujet) VALUES (".implode(',', $args).")";
		$requete = $this->db->prepare($sql);

		foreach ($tableauAttribution as $row)
		{
			$requete->execute($row);
		}
		$resultat = $this->db->commit();

		$requete->closeCursor();
		return $resultat;
	}

  private function creerTableauAttributions($listeEleves, $listeSujets){
    $taillePromotion = count($listeEleves);
    $tailleListeSujets = count($listeSujets);

    $tabSujetsAttribues = array_rand($listeSujets, $taillePromotion);

    for($i=0; $i<$taillePromotion; $i++){
      $exerciceAttribues[] = array($listeEleves[$i], $tabSujetsAttribues[$i]);
    }

    return $exerciceAttribues;
  }

}
