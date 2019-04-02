<?php
$pdo = new Mypdo();
?>

<div class="generationSujets">

  <div class="genererSujet">
    <?php

    $sujetManager = new SujetManager($pdo);
    $idPremierSujet = $sujetManager->getIdSujetPossible();

    $examenManager = new ExamenManager($pdo);
    $examen = $examenManager->getExamen($_SESSION['idExamenCree']);

    $generationManager = new GenerationManager($pdo);
    $listeExercicesGeneres = $generationManager->genererExercice($examen, $idPremierSujet);

    /*echo "<pre>";
    //var_dump(count($listeExercicesGeneres));
    var_dump($listeExercicesGeneres['enonces']);
    echo "</pre>";*/


    //Exportation dans la base de données
    $enonceManager = new EnonceManager($pdo);
    $resultatTabEnonces = $enonceManager->insererTableauEnonces($listeExercicesGeneres['enonces']);

    $sujetManager = new SujetManager($pdo);
    $resultatTabSujets = $sujetManager->insererTableauSujets($listeExercicesGeneres['sujets']);

    $exerciceGenereManager = new ExerciceGenereManager($pdo);
    $resultatTabExercices = $exerciceGenereManager->insererTableauExercices($listeExercicesGeneres['exerciceGeneres']);

    $retour = $resultatTabEnonces*$resultatTabSujets*$resultatTabExercices;

    if($retour){
      $nbSujets = count($listeExercicesGeneres['sujets']);
      echo "<p style='text-align:center;font-weight:bold; margin:10% 0;'><img class='icone' src='image/valid.png' alt='Validation génération'> ".$nbSujets." sujets ont été générés";

    }else{
      echo "<p style='text-align:center;font-weight:bold; margin:10% 0;'><img class='icone' src='image/erreur.png' alt='Erreur génération'>Erreur interne lors de la génération";
    }

    unset($_SESSION['idExamenCree']);

     ?>
  </div>
  <?php
  foreach($_COOKIE as $key => $value) {
      if($key != "PHPSESSID") { ?>
          <script type="text/javascript">
          function delete_cookie(name) {
              document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
          }
          delete_cookie(<?php echo '"'.$key.'"'; ?>);
          </script>
          <?php
      }
  } ?>
</div>
