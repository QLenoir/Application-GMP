<?php
class ExamenManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getAllExamens(){

		$sql = 'SELECT idExamen, dateDepot, anneeScolaire, titreExamen, consigneExamen FROM examen e
		ORDER BY e.dateDepot DESC';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($examen = $requete->fetch(PDO::FETCH_OBJ)){
			$listeExamens[] = new Examen($examen);
		}

		$requete->closeCursor();

		if(isset($listeExamens)){
			return $listeExamens;
		}

		return false;
	}

	public function getAllExamensAttribues(){

		$sql = 'SELECT DISTINCT s.idExamen FROM sujet s
		WHERE s.idSujet IN (select idSujet FROM exerciceattribue)';

		$requete = $this->db->prepare($sql);
		$requete->execute();

		while($examen = $requete->fetch(PDO::FETCH_OBJ)){
			$listeIdExamens[] = $examen->idExamen;
		}

		$requete->closeCursor();

		if(isset($listeIdExamens)){
			return $listeIdExamens;
		}
		return array();
	}

	public function examenEstAttribue($listeExamensObjets, $idExamen){
		foreach($listeExamensObjets as $examen){
			if($examen->getIdExamen() === $idExamen){
				return true;
			}
		}

		return false;
	}

	public function getExamen($idExamen){

		$sql = 'SELECT idExamen, dateDepot, anneeScolaire, titreExamen, consigneExamen FROM examen e
		WHERE e.idExamen=:idExamen';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':idExamen', $idExamen);
		$requete->execute();

		$examen = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();
		return new Examen($examen);
	}

	public function getDateLimitebySujet($idSujet){
		$sql = 'SELECT dateDepot FROM examen e JOIN sujet s ON e.idExamen=s.idExamen AND s.idSujet=:idSujet ';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':idSujet',$idSujet);
		$requete->execute();

		$date = $requete->fetch(PDO::FETCH_OBJ);

		$requete->closeCursor();

		return $date->dateDepot;
	}

	public function dateLimiteEstDepassee ($date){
		$now = new DateTime(date("Y:m:d H:i:s"));
		$limite = new DateTime($date);

		return $now>$limite;

	}

	public function creerExamen($dateLimite,$anneeScolaire,$titreExamen,$consigneExamen,$nbEssaiPossible) {
		$sql = 'INSERT INTO examen(dateDepot,anneeScolaire,titreExamen,consigneExamen,nbEssaiPossible) VALUES (:dateDepot,:anneeScolaire,:titreExamen,:consigneExamen,:nbEssaiPossible)';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':dateDepot',$dateLimite);
		$requete->bindValue(':anneeScolaire',$anneeScolaire);
		$requete->bindValue(':titreExamen',$titreExamen);
		$requete->bindValue(':consigneExamen',$consigneExamen);
		$requete->bindValue(':nbEssaiPossible',$nbEssaiPossible);

		$requete->execute();

		$requete->closeCursor();
	}

	public function creerQuestion($questions) {


		foreach ($questions as $key => $value) {

			if (strpos($key, 'bareme') !== false ) {
				$tab = explode('areme',$key);
				$tableauNumeroQuestion[] = $tab[1];
			}

		}

		$i = 0;
		foreach ($questions as $key => $value) {

			if(!strpos($key,'catia') && !strpos($key,'idImage'.$i)){
				switch ($key) {
					case 'intituleQuestion'.$tableauNumeroQuestion[$i]:
					$question['intituleQuestion'] = $value;
					break;

					case 'bareme'.$tableauNumeroQuestion[$i]:
					$question['bareme'] = $value;
					break;

					case 'zoneTolerance'.$tableauNumeroQuestion[$i]:
					$question['zoneTolerance'] = $value;
					$listeQuestions[]=$question;
					if(sizeof($tableauNumeroQuestion) != $i+1){
						$i++;
					}
					$question['intituleQuestion']=null;
					$question['bareme']=null;
					$question['zoneTolerance']=null;
					break;

					/*			case 'catia'.$tableauNumeroQuestion[$i]:
					break;

					case 'symbole'.$tableauNumeroQuestion[$i]:
					break;

					case 'formule'.$tableauNumeroQuestion[$i]:
					break; */

					default:
					break;
				}
			}

		}

		$idExamen = $this->db->lastInsertId();
		$i = 1;

		foreach ($listeQuestions as $key => $value) {

			$sql = 'INSERT INTO question(idQuestion,idExamen,intituleQuestion,baremeQuestion,zoneTolerance) VALUES (:idQuestion,:idExamen,:intituleQuestion,:baremeQuestion,:zoneTolerance)';

			$requete = $this->db->prepare($sql);
			$requete->bindValue(':idQuestion',$i);
			$requete->bindValue(':idExamen',$idExamen);
			$requete->bindValue(':intituleQuestion',$value['intituleQuestion']);
			$requete->bindValue(':baremeQuestion',$value['bareme']);
			$requete->bindValue(':zoneTolerance',$value['zoneTolerance']);

			$requete->execute();
			$i++;
		}

	}

	public function creerPoint($listePoints) {
		$pointManager = new PointManager($this->db);

		$i = $pointManager->getIdPointMaximal();
		$idExamen = $this->getLastExamenCree();

		foreach ($listePoints as $key => $value) {
			$sql = 'INSERT INTO points(idPoint,idExamen,nomPoint,estDonneesCatia,idSymboleMathematique,idFormuleMathematique) VALUES (:idPoint,:idExamen,:nomPoint,:estDonneesCatia,:symboleMathematique,:formuleMathematique)';

			$requete = $this->db->prepare($sql);
			$requete->bindValue(':idPoint',$i);
			$requete->bindValue(':idExamen',$idExamen);
			$requete->bindValue(':nomPoint',$key);
			$requete->bindValue(':estDonneesCatia',$value['estDonneesCatia']);
			$requete->bindValue(':symboleMathematique',$value['symboleMathematique']);
			$requete->bindValue(':formuleMathematique',$value['formuleMathematique']);

			$requete->execute();

			foreach ($value as $clé => $valeur) {  //pour chaque point

				if(is_array($valeur) ){ //Verification pour ne pas avoir catia ou les id Images

					if (isset($valeur[0])) {
						foreach ($valeur as $key => $valeurPoint) {


							$sql = 'INSERT INTO valeurs(idPoint,valeur,exposantValeur,uniteValeur,uniteExposant) VALUES (:idPoint,:valeur,:exposantValeur,:uniteValeur,:uniteExposant)';

							$requete = $this->db->prepare($sql);

							$requete->bindValue(':idPoint',$i);
							$requete->bindValue(':valeur',$valeurPoint['valeur']);
							$requete->bindValue(':exposantValeur',$valeurPoint['exposantValeur']);
							$requete->bindValue(':uniteValeur',$valeurPoint['uniteValeur']);
							$requete->bindValue(':uniteExposant',$valeurPoint['uniteExposant']);

							$requete->execute();

						}
					} else {

						$sql = 'INSERT INTO valeurs(idPoint,valeur,exposantValeur,uniteValeur,uniteExposant) VALUES (:idPoint,:valeur,:exposantValeur,:uniteValeur,:uniteExposant)';

						$requete = $this->db->prepare($sql);

						$requete->bindValue(':idPoint',$i);
						$requete->bindValue(':valeur',$valeur['valeur']);
						$requete->bindValue(':exposantValeur',$valeur['exposantValeur']);
						$requete->bindValue(':uniteValeur',$valeur['uniteValeur']);
						$requete->bindValue(':uniteExposant',$valeur['uniteExposant']);

						$requete->execute();
					}
				}
			}
			$i++;
		}
	}


public function getLastExamenCree(){
	$sql = 'SELECT COUNT(idExamen) as nbExam FROM examen ';

	$requete = $this->db->prepare($sql);
	$requete->execute();

	$res = $requete->fetch(PDO::FETCH_OBJ);

	return($res->nbExam);
}

public function getNbEssaiRestant($idSujet,$idExamen) {
	$sql = 'SELECT nbEssaiPossible FROM examen WHERE idExamen=:idExamen ';

	$requete = $this->db->prepare($sql);
	$requete->bindValue(':idExamen',$idExamen);

	$requete->execute();
	$res = $requete->fetch(PDO::FETCH_OBJ);
	$nbEssaiPossible = $res->nbEssaiPossible;

	$sql = 'SELECT nbEssaiRealise as nbEssaiUtilise FROM `sujet` WHERE idSujet=:idSujet';

	$requete = $this->db->prepare($sql);
	$requete->bindValue(':idSujet',$idSujet);

	$requete->execute();
	$res = $requete->fetch(PDO::FETCH_OBJ);

	return $nbEssaiPossible - $res->nbEssaiUtilise;
}

public function ajouterEssaiPourUnSujet($idSujet,$idExamen) {
	$sql = "
	UPDATE sujet
	SET nbEssaiRealise = nbEssaiRealise + 1
	WHERE idSujet = :idSujet AND idExamen = :idExamen";

	$requete = $this->db->prepare($sql);
	$requete->bindValue(':idExamen',$idExamen);
	$requete->bindValue(':idSujet',$idSujet);

	$requete->execute();

}

public function updateNombreEssais($nbEssaieRealise,$idSujet,$idExamen) {
	$sql = "
	UPDATE sujet
	SET nbEssaiRealise = nbEssaiRealise - :nbEssaiRealise
	WHERE idSujet = :idSujet AND idExamen = :idExamen";

	$requete = $this->db->prepare($sql);
	$requete->bindValue(':nbEssaiRealise',$nbEssaieRealise);
	$requete->bindValue(':idExamen',$idExamen);
	$requete->bindValue(':idSujet',$idSujet);

	$requete->execute();

}
}
