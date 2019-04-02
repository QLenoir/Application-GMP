<?php
class QuestionManager{

  private $db;

  public function __construct($db){
		$this->db = $db;
	}

  public function getAllQuestionOfSujet($idExamen, $idSujet){
    $sql = 'SELECT q.idQuestion, intituleQuestion, resultat, exposantUnite, resultatUnite, baremeQuestion , resultatExposant, zoneTolerance FROM resultatsattendus r
    INNER JOIN question q ON (q.idQuestion=r.idQuestion)
    WHERE idSujet=:idSujet AND idExamen=:idExamen';

    $requete = $this->db->prepare($sql);
    $requete->bindValue(':idSujet', $idSujet);
    $requete->bindValue(':idExamen', $idExamen);
    $requete->execute();

    while($question = $requete->fetch(PDO::FETCH_OBJ)){
      $listeQuestions[] = new Question($question);
    }

    $requete->closeCursor();
    return $listeQuestions;
  }

  public function getNbQuestionsOfSujet($idSujet){
    $sql = 'SELECT COUNT(idQuestion) as nbQuestion FROM question q JOIN sujet s ON s.idExamen=q.idExamen WHERE idsujet=:idSujet ';

  	$requete = $this->db->prepare($sql);
		$requete->bindValue(':idSujet', $idSujet);
		$requete->execute();

    $res = $requete->fetch(PDO::FETCH_OBJ);

    return $res->nbQuestion;
  }
}
