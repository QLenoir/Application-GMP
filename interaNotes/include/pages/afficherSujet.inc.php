<?php
if(isset($_GET['idSujet'])){
    $idSujet = $_GET['idSujet'];

    $pdo = new Mypdo();
    $sujetManager = new SujetManager($pdo);

    if($sujetManager->sujetEstExistant($idSujet)){
        $examenManager = new ExamenManager($pdo);
        $enonceManager = new EnonceManager($pdo);
        $questionManager = new QuestionManager($pdo);
        $valeurManager = new ValeurManager($pdo);
        $pointManager = new PointManager($pdo);
        $personneManager = new PersonneManager($pdo);
        $eleveManager = new EleveManager($pdo);
        $attributionManager = new AttributionManager($pdo);

        $idEleve = $attributionManager->getIdEleveByIdSujet($idSujet);
        $sujet = $sujetManager->getSujet($idSujet);
        $enonceSujet = $enonceManager->getEnonce($sujet->getIdEnonce());
        $examenSujet = $examenManager->getExamen($sujet->getIdExamenOfSujet());
        $personneEleve = $personneManager->getPersonneById($idEleve);
        $eleve = $eleveManager->getEleve($personneEleve);
        $valeurs = $valeurManager->getValeursSujet($idSujet);

        $dateDepot = $examenSujet->getDateDepotExamen();
        $titre = $enonceSujet->getTitreEnonce();
        $enonce = $enonceSujet->getConsigneEnonce();
        $question = $questionManager->getAllQuestionOfSujet($sujet->getIdExamenOfSujet(),$idSujet);
        $image1 = "image/examen".$_SESSION['examen']->getIdExamen()."/sujet".$idSujet."/1_".$valeurs[0]->getValeur().".jpg";
        $image2 = "image/examen".$_SESSION['examen']->getIdExamen()."/sujet".$idSujet."/2_".$valeurs[2]->getValeur().".jpg"; ?>

        <div class="row w-100 d-flex justify-content-center headAfficherSujet">
            <div class="col-12 col-md-4">
                <p>N° étudiant : <span><?php echo $personneEleve->getIdPersonne(); ?></span> </p>
            </div>
            <div class="col-12 col-md-4">
                <p>N° Sujet : <span><?php echo $idSujet; ?></span> </p>
            </div>
            <div class="col-12 col-md-4">
                <p>Sujet de : <span><?php echo $personneEleve->getNomPersonne().' '.$personneEleve->getPrenomPersonne(); ?></span> </p>
            </div>
        </div>

        <hr class="hr" style="width:100%; border:solid #333 1px; border-collapse: collapse; margin-top: 2%;">

        <div class="row mySubject">
            <div class="row">
                <div class="col-12">
                    <p>
                        <h1 style="text-align: center;"><?php echo $titre.' - '.$eleve->getNomPromotion().' - '.$eleve->getAnneeInscription(); ?></h1>
                    </p>
                </div>
            </div>

            <div class="row" style="clear: both; width: 100%;" >
                <div class="col-12 subjectTitle">
                    <div>
                        <span id="subjectTitle">Enoncé :</span>
                        <br>
                        <p style="margin-left: 18px;"class="textSubject">
                            <?php echo $enonce; ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row" style="clear: both; width: 100%;" >
                <div class="col-12 subjectTitle">
                    <div>
                        <span id="subjectTitle">Valeurs :</span>
                        <br>
                    </div>
                </div>
            </div>

            <div>
                <ul style="list-style-type:disc">
                    <?php
                    foreach ($valeurs as $val) {
                        $idPoint = $val->getIdPointOfValeur();
                        $point = $pointManager->getPoint($idPoint);?>

                        <li>
                            <?php echo($point->getNomPoint())  ?> :

                            <?php
                            if($point->aUnSymboleMathematique()) {
                                $cheminSymbole = $pointManager->getCheminOfSymboleMathematique($point);
                            }

                            if($point->aUneFormuleMathematique()) {
                                $cheminFormule = $pointManager->getCheminOfFormuleMathematique($point);
                            }

                            if(isset($cheminSymbole) || isset($cheminFormule)) {
                                if(isset($cheminSymbole)) { ?>
                                    <img class="vecteur" alt="vecteur" src="image/vecteurs/<?php echo $cheminSymbole ?>"> =
                                    <?php
                                }

                                if(isset($cheminFormule)){ ?>
                                    <img class="vecteur" alt="vecteur" src="image/vecteurs/<?php echo $cheminFormule ?>">
                                    <?php
                                }

                                echo $val->getValeur(); ?>

                                <?php
                                unset($cheminSymbole);
                                unset($cheminFormule);

                            } else { ?>
                                <?php echo $val->getValeur(); ?>

                                <?php
                            }
                        } ?>
                    </li>
                </ul>
            </div>

            <div class="row" style="width: 100%;">
                <div class="col-12 subjectTitle">
                    <div>
                        <span id="subjectTitle">Questions :</span>

                        <p class="textSubject">
                            <ol style="list-style-type: decimal;">
                                <?php foreach ($question as $numQuestion) { ?>
                                    <li><?php echo $numQuestion->getIntituleQuestion(); ?></li>
                                <?php } ?>
                            </ol>
                        </p>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 subjectTitle">
                        <span id="subjectTitle">Images :</span>

                        <div class="row justify-content-around">
                            <img style="border:solid #333 1px; border-collapse: collapse; padding: 0;"  class="col-12 col-sm-6 col-md-4 col-lg-2 rounded subjectPictureOne" src=<?php echo $image1; ?> >

                            <img style="border:solid #333 1px; border-collapse: collapse; padding: 0;"  class="col-12 col-sm-6 col-md-4 col-lg-2 rounded subjectPictureTwo" src=<?php echo $image2; ?> >
                        </div>

                        <div class="row mesBtnSujet">
                            <?php
                            if (isset($_SESSION['eleve']) && !$examenSujet->estFini()) { ?>
                                <div class="col-12 col-md-3 d-flex justify-content-around">
                                    <div class="">
                                        <a href="index.php?page=19">
                                            <input type=button value="Saisir réponses"></input>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            } ?>


                            <div class="col-12 col-md-3 d-flex justify-content-center">
                                <div class="">
                                    <a href="index.php?page=46&amp;idSujet=<?php echo $idSujet;?>">
                                        <input type=button value="Voir réponses saisies"></input>
                                    </a>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 d-flex justify-content-center">
                                <div class="">
                                    <?php
                                    $_SESSION['sujet'] = $arrayName = array('idSujet' => $idSujet,'titre' => $titre, 'date' => $dateDepot, 'enonce' => $enonce,'image1' => $image1, 'image2' => $image2, 'questions' => $question);
                                    ?>
                                    <a href="include/pages/obtenirPdfSujet.inc.php" target="_blank">
                                        <input type=button value="Télécharger"></input>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="hr" style="width:100%; border:solid #333 1px; border-collapse: collapse; margin-top: 2%;">

                    <div class="row d-flex justify-content-center w-100 headCreateExam">
                        <div class="col-12 col-md-4">
                            <p>Pierre CARRILLO </p>
                        </div>

                        <div class="col-12 col-md-4">
                            <p>IUT du Limousin - GMP</p>
                        </div>

                        <div class="col-12 col-md-4">
                            <p>Page 1/1</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }else{
        header('Location: index.php?page=3');
    }
}else{
    header('Location: index.php?page=3');
}?>
