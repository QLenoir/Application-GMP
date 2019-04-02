<?php require_once("include/verifEleve.inc.php");

$pdo = new Mypdo();
$sujetManager = new SujetManager($pdo);
$enonceManager = new EnonceManager($pdo);
$examenManager = new ExamenManager($pdo);
$questionManager = new QuestionManager($pdo);
$eleveManager = new EleveManager($pdo);
$reponseEleveManager = new ReponseEleveManager($pdo);
$noteManager = new NoteManager($pdo);

$idSujet = $sujetManager->getIdSujetByLogin($_SESSION['eleve']); // WARNING si plusieurs sujets
$sujet = $sujetManager->getSujet($idSujet);
$enonceSujet = $enonceManager->getEnonce($sujet->getIdEnonce());
$idEleve = $eleveManager->getIdEleveByLogin($_SESSION['eleve']);
$nbEssaiRestant = $examenManager->getNbEssaiRestant($idSujet,$sujet->getIdExamenOfSujet());


if(!$idSujet){
    ?>
    <div class="msgErrorTitre">
        <h3>Erreur sujet</h3>
        <p>Aucun sujet n'a été attribué pour l'instant !</p>
    </div>
    <?php
} else {

    $dateLimite=$examenManager->getDateLimitebySujet($idSujet);

    if($examenManager->dateLimiteEstDepassee($dateLimite)) { ?>

        <div class="msgErrorTitre">
            <h3>Erreur date</h3>
            <p>La date limite pour envoyer les réponses a été dépassée !</p>
        </div>

    <?php } elseif($nbEssaiRestant==0) { ?>
      <div class="msgErrorTitre">
          <h3>Plus d'essai</h3>
          <p>Vous avez utilisé tous vos essais ! Prenez contact avec votre professeur.</p>
      </div>
  <?php  } else {

        if (empty($_POST['reponse1'])) { ?>

            <div class="row answerSubject">
                <form action="index.php?page=19" method="post" style="width:100%">
                    <div class="col-12">
                        <div class="row justify-content-around">
                            <div class="col-12 col-sm-6 col-md-5 form-group headerSaisie">
                                <span>Titre de l'énoncé : </span>
                                <?php echo $enonceSujet->getTitreEnonce(); ?>
                            </div>
                            <div class="col-12 col-sm-6 col-md-5 form-group headerSaisie">
                                <span>Date de fin : </span>
                                <?php echo getFrenchDateWithHours($dateLimite); ?>
                            </div>
                        </div>
                    </div>

                    <hr class="hr" style="width:80%">
                    <div class="col-12 d-flex justify-content-center" id="needHelp">
                        <span class="more_info" id="text_info">
                            <img class="helpIcon" src="image/help.svg" alt="help" title="Aide">
                            Besoin d'aide ?
                            <div class="popup">
                            </br> <h3>Comment&nbspsaisir vos&nbspréponses ?</h3>  </br>

                            <h5> La zone de détails :</h5>
                            <p id="text_info">C'est dans cette zone que vous pouvez détailler les différentes étapes qui vous ont permis de trouver votre résultat</p>

                            <h5> Le résultat :</h5>
                            <p id="text_info">La saisie du résultat (en écriture scientifique) se fait en 2 étapes&nbsp: vous devez d'abord saisir la partie décimale du résultat puis la puissance de 10</p>
                            <i>Exemple : Pour 5,32 x10^4, vous saisissez 5,32 dans la zone gauche et 4 dans la zone qui se situe en haut à droite du 10 </i> </br> </br>

                            <h5> L'unité du résultat :</h5>
                            <p id="text_info">La saisie de l'unité se fait en 2 étapes&nbsp: vous devez d'abord saisir l'unité du Système International (SI) puis la puissance de 10 qui permet d'obtenir la bonne unité</p>
                            <i>Exemple : Pour avoir un résultat en 'km', vous devez sélectionner l'unité 'm' (mètre) dans unité du résultat puis 3 dans Exposant de l'unité </i> </br> </br>
                        </div>
                    </span>
                </div>

                <hr class="hr" style="width:80%">

                <div class="col-12">
                    <?php
                    $listeQuestions = $questionManager->getAllQuestionOfSujet($sujet->getIdExamenOfSujet(),$idSujet);
                    foreach ($listeQuestions as $question) { ?>

                      <div class="row">
                        <div class="col-9">
                            <span>Question <?php echo $question->getIdQuestion() ?> :</span>
                        </div>

                        <div class="col-3">
                            <p style="align-self:end; margin:0"><?php echo " /".$question->getBaremeQuestion()."pts" ?></p>
                        </div>

                        <div class="col-12">
                            <p><?php echo $question->getIntituleQuestion() ;?></p>
                        </div>

                        <div class="col-12">
                          <div class="row">
                            <div class="col-12 col-lg-7 form-group">
                                <label for="detailAnswer">Détails calculs :</label>
                                <textarea class="form-control" id="detailAnswer" name="justification<?php echo $question->getIdQuestion() ?>" onkeyup="adjustHeightTextAreaLittle(this)" placeholder='Veuillez écrire ici les différentes étapes de calculs qui vous ont permis de trouver le résultat ...' maxlength="65535" required></textarea>
                            </div>

                            <div class="col-12 col-lg-5">

                              <div class="row">
                                <div class="col-12">
                                  <div class="row">
                                    <div class="col-12 col-lg-6 form-group">
                                      <label for="resultAnswer">Résultat :</label>
                                      <input class="form-control" id="resultAnswer" name="reponse<?php echo $question->getIdQuestion() ?>" type="number" placeholder="" step="0.001" onkeydown="return event.keyCode !== 69" required>
                                    </div>

                                    <div class="col-5 col-sm-3 col-md-2 col-lg-4 d-flex form-group divPuissanceResult">
                                      <p id="puissanceResult">x10</p>
                                      <input id="resultAnswer"  class="form-control saisiePuissanceResult" name="resultatExposant<?php echo $question->getIdQuestion() ?>" type="number" value="0" step="1" onkeydown="return event.keyCode !== 69" required>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-12 form-group">
                                  <label for="uniteAnswer">Unité du Résultat :</label>
                                  <select class="form-control" id="uniteAnswer" name="unite<?php echo $question->getIdQuestion() ?>" type="text" placeholder="Sélectionnez l'unité du résultat" required>
                                      <?php
                                      $listeUnites = Unites::getConstants();

                                      foreach ($listeUnites as $unite => $abreviation) { ?>
                                          <option value="<?php echo $abreviation ?>"><?php echo $abreviation ?></option>
                                          <?php
                                      }
                                      ?>
                                  </select>
                                </div>

                                <div class="col-12 form-group">
                                  <label for="exposantAnswer">Exposant de l'unité :</label>
                                  <select class="form-control" id="exposantAnswer" name="exposant<?php echo $question->getIdQuestion() ?>" type="text" placeholder="Sélectionnez l'exposant de l'unité" required>
                                      <?php
                                      $listeExposants = Exposants::getConstants();
                                      $defautExposant = Exposants::getExposantParDefaut();

                                      foreach ($listeExposants as $exposant) { ?>
                                          <option <?php if($exposant==$defautExposant){ echo "selected ";} ?>value="<?php echo $exposant ?>"><?php echo $exposant ?></option>

                                      <?php
                                      }
                                      ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                    <input type="submit" class="sendSaisie" value="Envoyer">
                </form>
            </div>
        </div>

    <?php  } else {

        $i=1;
        foreach ($_POST as $attribut => $value) {
          switch ($i) {
              case 1:
                $reponse['justification']=$value;
                $i++;
                break;
              case 2:
                $reponse['resultat']=$value;
                $i++;
                break;
              case 3:
                $reponse['resultatExposant']=$value;
                $i++;
                break;
              case 4:
                $reponse['resultatUnite']=$value;
                $i++;
                break;
              case 5:
                $reponse['exposantUnite']=$value;
                $i=1;
                $listeReponse[]=$reponse;
                break;
              default:
                break;
          }
        }

        $idEleve =$eleveManager->getIdEleveByLogin($_SESSION['eleve']);
        $date = date("Y-m-d H:i:s");

        foreach ($listeReponse as $numeroReponse => $reponse) {
            $reponseObj = new ReponseEleve($reponse);
            $reponseObj->setDateResult($date);
            $reponseObj->setIdQuestion($numeroReponse+1);
            $reponseObj->setIdSujet($idSujet);
            $reponseObj->setIdEleve($idEleve);

            $reponseObj->setPrecisionReponse($reponseEleveManager->calculerPrecisionReponse($reponseObj));

            $reponseEleveManager->importSaisie($reponseObj);
        }

        $questions = $questionManager->getAllQuestionOfSujet($sujet->getIdExamenOfSujet(),$idSujet);
        $noteTotal = 0;

        foreach ($questions as $question) {
            $idQuestion = $question->getIdQuestion();
            $reponse = $reponseEleveManager->getReponseEleveByIdQuestion($idQuestion, $idSujet);
            $note = $noteManager->calculerNotePourUneQuestion($question, $reponse);
            $noteTotal=$noteTotal+$note;
        }

        $exist = $noteManager->noteExist($idSujet, $idEleve);

        if (!$exist) {
            $noteManager->insererNote($idSujet, $idEleve, $noteTotal);
        }else{
            $noteManager->updateNote($idSujet, $idEleve, $noteTotal);
        }


        $examenManager->ajouterEssaiPourUnSujet($idSujet,$sujet->getIdExamenOfSujet());
        ?>

        <div class="msgConfirmTitre">
            <h3>Message de confirmation</h3>
            <p>Vos réponses ont été envoyées au professeur !</p>
        </div>

    <?php
    }
  }
} ?>
