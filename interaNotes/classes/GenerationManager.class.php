<?php
class GenerationManager{

  private $db;

  private $constructionSujet;
  private $idSujet;

  private $listeExercicesGeneres;
  private $listeDesEnonces;
  private $listeDesSujets;

  public function __construct($db){
		$this->db = $db;
	}

  //WARNING : faire var pour nbPoints
  public function genererExercice($examen, $idSujetDepart){
    $pointManager = new PointManager($this->db);
    $valeurManager = new ValeurManager($this->db);

    $listeDesPoints = $pointManager->getAllPointsOfExamens($examen->getIdExamen());
    $this->idSujet = $idSujetDepart;

    foreach ($listeDesPoints as $index => $point) {
      $listeValeursDesPoints[$index] = $valeurManager->getAllValeursOfPoints($listeDesPoints[$index]->getIdPoint());
    }

    $listeValeursTemporaires = array();
    $this->genererSujetAvecNouveauParametre(count($listeDesPoints) -1, 0, $listeValeursDesPoints, $listeValeursTemporaires);

    $this->extractionDesDonnees($examen, $listeDesPoints);

    //Gestion des données extraites
    $tableauSujets['enonces'] = $this->listeDesEnonces;
    $tableauSujets['sujets'] = $this->listeDesSujets;
    $tableauSujets['exerciceGeneres'] = $this->listeExercicesGeneres;
    return $tableauSujets;
  }

  /*Fonction permettant d'attribuer à chaque point des sujets une valeurs
  * Précondition : Une variable globale doit être définie : $listeValeursTemporaires
  *       Elle va permettre de stocker les informations nécessaires entre les différents appels récursifs
  */
  private function genererSujetAvecNouveauParametre($nbEtapesTotale, $etapeActuelle, $listeDesPoints, $listeValeursTemporaires){
    if($nbEtapesTotale === $etapeActuelle){

      foreach ($listeDesPoints[$etapeActuelle] as $point) {
        $listeValeursTemporaires[$etapeActuelle] = $point;

        foreach ($listeValeursTemporaires as $valeurPoint) {
          $this->constructionSujet[$this->idSujet][$valeurPoint->getIdPointOfValeur()] = $valeurPoint;
        }

        $this->idSujet++;
      }

    } else {
      foreach ($listeDesPoints[$etapeActuelle] as $point) {
        $listeValeursTemporaires[$etapeActuelle] = $point;
        $this->genererSujetAvecNouveauParametre($nbEtapesTotale, $etapeActuelle +1, $listeDesPoints, $listeValeursTemporaires);
      }
    }
  }

  private function extractionDesDonnees($examen, $listeDesPoints){

    foreach ($listeDesPoints as $point) {
      $nomDesPoints[$point->getIdPoint()] = "$".$point->getNomPoint()."$";
    }

    $valeurDesPointsDuSujet = array();
    $enonceExamen = $examen->getConsigneExamen();
    $titreExamen = $examen->getTitreExamen();
    $idExamen = $examen->getIdExamen();

    foreach ($this->constructionSujet as $idSujet => $point) {

      foreach($point as $valeur){
        $this->listeExercicesGeneres[] = new ExerciceGenere($idSujet, $valeur->getIdValeur());
        $valeurDesPointsDuSujet[$valeur->getIdPointOfValeur()] = $valeur->getValeur();
      }

      $enonceSujet = str_replace($nomDesPoints, $valeurDesPointsDuSujet, $enonceExamen);
      $this->listeDesEnonces[] = new Enonce(array('idEnonce'=>$idSujet,'titre'=>$titreExamen,'consigne'=>$enonceSujet));

      $this->listeDesSujets[] = new Sujet(array('idSujet'=>$idSujet,'idEnonce'=>$idSujet,'semestre'=>1, 'idExamen'=>$idExamen, 'nbEssaiRealise'=>0));
    }
  }

}
