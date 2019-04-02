<?php
class CorrigeManager {
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function calculerCorrection($idSujet,$isTest){

		$tableauPoint = $this->getSujetValeur($idSujet); //NE PAS TOUCHER

		//REDEFINIR VARIABLES PLUS CLAIREMENT

		$nbMoteur = $tableauPoint[0]['valeur']*pow(10, $tableauPoint[0]['exposantValeur']+$tableauPoint[0]['uniteExposant']);

		$vitesse = $tableauPoint[1]['valeur']*pow(10, $tableauPoint[1]['exposantValeur']+$tableauPoint[1]['uniteExposant']);

		$nbPersonne = $tableauPoint[2]['valeur']*pow(10, $tableauPoint[2]['exposantValeur']+$tableauPoint[2]['uniteExposant']);

		$distanceDestination = $tableauPoint[4]['valeur']*pow(10, $tableauPoint[4]['exposantValeur']+$tableauPoint[4]['uniteExposant']);

		$consommationCarburantDistance = $tableauPoint[5]['valeur']*pow(10, $tableauPoint[5]['exposantValeur']+$tableauPoint[5]['uniteExposant']);

		$consommationCarburantQuantité = $tableauPoint[5]['valeur']*pow(10, $tableauPoint[5]['exposantValeur']+$tableauPoint[5]['uniteExposant'])*10; //ALERTE

		$consoEau = $tableauPoint[6]['valeur']*pow(10, $tableauPoint[6]['exposantValeur']+$tableauPoint[6]['uniteExposant']);

		$consoNourriture = $tableauPoint[7]['valeur']*pow(10, $tableauPoint[7]['exposantValeur']+$tableauPoint[7]['uniteExposant']);

		$consoO2 = $tableauPoint[8]['valeur']*pow(10, $tableauPoint[8]['exposantValeur']+$tableauPoint[8]['uniteExposant']);

		//OPERATIONS

		$nbConso = $distanceDestination / $consommationCarburantDistance; // nombre de consommation (1000km) = [[distanceDestination]]/ [[nbMoteur]] (vient de l'unité de consommation carburant)

		$qteCarburant = $nbConso*$consommationCarburantQuantité*$nbMoteur; //qtéCarburant tous moteurs = nbConso*consommationMoteur*[[nbMoteur]]

		$jours = (($distanceDestination/1000) / $vitesse)/24; // jours = ([[distanceDestination]]/[[vitesse]])/24 (nb heures)
		$jours = ceil($jours); // arrondissement a la journée supérieure

		$qteO2 =$nbPersonne*$consoO2*$jours; // [[nbPersonnes]]*60*jours

		$qteNourriture = $nbPersonne*$consoNourriture*$jours; //[[nbPersonne]]*2kg*jours

		$qteEau = $nbPersonne*$consoEau*$jours; //[[nbPersonne]]*1.5*jours

		//RETOURNER TABLEAU SOUS LA FORME SUIVANTE : idSujet,idQuestion,resultat,resultatExposant,resultatUnite,exposantUnite

		$resultatsattendus[0] = array('idSujet'=>$idSujet, 'idQuestion' => 1, 'resultat' => $jours, 'resultatExposant' =>0, 'resultatUnite' => "jours", 'exposantUnite' => 0);
		$resultatsattendus[1] = array('idSujet'=>$idSujet, 'idQuestion' => 2, 'resultat' => $qteO2, 'resultatExposant' =>0, 'resultatUnite' => "L", 'exposantUnite' => 0);
		$resultatsattendus[2] = array('idSujet'=>$idSujet, 'idQuestion' => 3, 'resultat' => $qteCarburant, 'resultatExposant' =>0, 'resultatUnite' => "g", 'exposantUnite' => 12);
		$resultatsattendus[3] = array('idSujet'=>$idSujet, 'idQuestion' => 4, 'resultat' => $qteEau, 'resultatExposant' =>0, 'resultatUnite' => "g", 'exposantUnite' => 12);
		$resultatsattendus[4] = array('idSujet'=>$idSujet, 'idQuestion' => 5, 'resultat' => $qteNourriture, 'resultatExposant' =>0, 'resultatUnite' => "g", 'exposantUnite' => 3);

		if(!$isTest) {
			$this->importerCorrection($resultatsattendus);
		} else {
			return $resultatsattendus;
		}


	}

	public function importerCorrection($resultatsattendus){
		$sql = 'INSERT INTO resultatsattendus(idSujet,idQuestion,resultat,resultatExposant,resultatUnite,exposantUnite) VALUES (:idSujet,:idQuestion,:resultat,:resultatExposant,:resultatUnite,:exposantUnite)';

		foreach ($resultatsattendus as $reponseQuestion => $value) { // a optimiser
			$requete = $this->db->prepare($sql);
			$requete->bindValue(':idSujet', $value['idSujet']);
			$requete->bindValue(':idQuestion',$value['idQuestion']);
			$requete->bindValue(':resultat', $value['resultat']);
			$requete->bindValue(':resultatExposant', $value['resultatExposant']);
			$requete->bindValue(':resultatUnite', $value['resultatUnite']);
			$requete->bindValue(':exposantUnite', $value['exposantUnite']);
			$requete->execute();
		}
	}

	private function getSujetValeur($idSujet){

		$sql = 'SELECT T.idSujet, T.idValeur, v.valeur, v.exposantValeur, v.uniteExposant FROM (
		SELECT idSujet, idValeur FROM exercicegenere
		WHERE idSujet=:idSujet)T
		INNER JOIN valeurs v ON (T.idValeur = v.idValeur)';

		$requete = $this->db->prepare($sql);
		$requete->bindValue(':idSujet', $idSujet);
		$requete->execute();

		while($valeur = $requete->fetch(PDO::FETCH_ASSOC)){
			$valeursSujet[] = $valeur;
		}

		$requete->closeCursor();

		return $valeursSujet;
	}


}
