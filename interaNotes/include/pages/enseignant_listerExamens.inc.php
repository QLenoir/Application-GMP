<?php require_once("include/verifEnseignant.inc.php"); ?>

<?php
$pdo = new Mypdo();
$examenManager = new ExamenManager($pdo);

$listeExamens = $examenManager->getAllExamens();
$listeExamensAttribues = $examenManager->getAllExamensAttribues();

if (!$listeExamens){ ?>
    <div class="msgErrorTitre">
        <h3>Erreur examen</h3>
        <p>Aucun examen n'a été créé pour l'instant !</p>
    </div>
<?php } else { ?>

    <div class="listerSujet">
        <h4 style="text-align:center">Liste de mes examens : </h4>
        <hr style="width:80%">

        <?php
        
        foreach ($listeExamens as $compteur=>$examen) {
            $examenEstAttribue = in_array($examen->getIdExamen(), $listeExamensAttribues);
            $statutExamen = $examen->getStatut($examenEstAttribue);?>

            <div class="row text-center">
                <!-- Numero examen -->
                <div class="col-6 col-sm-3 col-lg-3">
                    <p>Examen n°<?php echo $examen->getIdExamen() ?> : <?php echo $examen->getTitreExamen() ?></p>
                </div>

                <!-- statut -->
                <div class="col-6 col-lg-4">
                    <p> <?php echo $statutExamen; ?></p>
                </div>

                <div class="justify-content-between boutonsListerSujetProf">
                    <!-- Actions examen : bouton 'Consulter un examen'-->
                    <div class="col-6 col-sm-4 col-lg-2">
                        <a href="index.php?page=3&amp;id=<?php echo $examen->getIdExamen() ?>">
                            <input type="button" name="" value="Consulter">
                        </a>
                    </div>

                    <!-- Actions examen : bouton 'commencer un examen'-->

                    <?php
                    if($statutExamen == StatutExamen::NON_DISTRIBUE){ ?>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <a href="#">
                                <input type="button" name="" value="Commencer">
                            </a>
                        </div>
                        <?php
                    }
                    ?>

                </div>

            </div>
        <?php }
    }
    ?>

</div>
