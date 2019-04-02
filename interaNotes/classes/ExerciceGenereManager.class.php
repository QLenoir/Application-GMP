<?php
class ExerciceGenereManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function insererTableauExercices($exercices) {
		$exercicesTableaux = $this->preparationRequeteTableauExercices($exercices);

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

	private function preparationRequeteTableauExercices($exercicesObjets){
		foreach ($exercicesObjets as $exercice) {
      $exercicesTableaux[] = array($exercice->getIdSujet(), $exercice->getIdValeur());
    }

		return $exercicesTableaux;
	}
}
