<?php require_once("include/verifEnseignant.inc.php"); ?>

<?php
if(isset($_GET['id'])){
  $pdo = new Mypdo();
  $examenManager = new ExamenManager($pdo);
  $sujetManager = new SujetManager($pdo);
  $personneManager = new PersonneManager($pdo);

  $_SESSION['examen'] = $examenManager->getExamen($_GET['id']);
  $listeSujets = $sujetManager->getAllSujetsOfExamenAttribues($_GET['id']);

  if (!$listeSujets){ ?>
      <div class="msgErrorTitre">
          <h3>Liste de sujets vide</h3>
          <p>Aucun sujet n'a été attribué pour l'instant !</p>
      </div>
  <?php } else { ?>

      <div class="listerSujet">

          <div class="row justify-content-around text-center teteListeSujet">
              <div class="col-6 col-sm-3 col-lg-2 textListeSujet">
                  <p> </p>
              </div>
              <div class="col-6 col-lg-4">
                  <span id="attributeTo">Attribué à : </span>
              </div>
              <div class="col-3 col-lg-2">
              </div>
          </div>

          <?php
          foreach ($listeSujets as $sujet) { ?>
              <div class="row justify-content-center text-center contenuListeSujet">
                  <div class="col-6 col-sm-3 col-lg-2 textListeSujet">
                      <p>Sujet n°<?php echo $sujet->getIdSujet() ?></p>
                  </div>

                  <?php $eleve = $personneManager->getNomPrenomParSujet($sujet->getIdSujet()); ?>

                  <div class="col-6 col-lg-4 textListeSujet">
                      <p> <?php echo $eleve->getPrenomPersonne()." ".$eleve->getNomPersonne() ?></p>
                  </div>

                  <!--Boutons d'actions sur chaque sujet-->
                  <div class="col-12 col-sm-3 col-lg-2">
                      <a href="index.php?page=45&amp;idSujet=<?php echo $sujet->getIdSujet();?>">
                          <input type="button" name="" value="Consulter">
                      </a>
                  </div>

                  <div class="col-12 col-sm-3 col-lg-2">
                      <a href="index.php?page=46&amp;idSujet=<?php echo $sujet->getIdSujet();?>">
                        <input type="button" name="" value="Voir les réponses">
                      </a>
                  </div>
                  <div class="col-12 col-sm-3 col-lg-2">
                      <a href="index.php?page=6?&amp;id=<?php echo $sujet->getIdSujet();?>">
                        <input type="button" name="" value="Ajouter Essai">
                      </a>
                  </div>
              </div>
          <?php }
      }
      ?>

      <hr>

       <div class="btnTestCorrection d-flex col-12 justify-content-center">
           <a href="index.php?page=7">
               <input id="btn_testCorrection" type="button" value="Test Correction" >
           </a>
       </div>
  </div>
<?php }else{
  header('Location: index.php?page=5');
} ?>
