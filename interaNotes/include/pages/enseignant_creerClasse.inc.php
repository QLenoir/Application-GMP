<?php require_once("include/verifEnseignant.inc.php"); ?>

<?php if (empty($_POST['annee'])) { ?>
    <div class="row createClass">
        <form action="index.php?page=2" method="post" enctype="multipart/form-data" name="form1">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12">
                        <label>Nom de la promotion :</label>
                    </div>
                    <div class="col-8 inputNameClass">
                        <input type="text" name="nom" value="" placeholder="Promo 1A" maxlength="30" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <label>Année de la promotion :</label>
                    </div>
                    <div class="col-8 inputYearClass">
                        <input type="number" name="annee" value="" min="2018" placeholder="20XX" onkeydown="return event.keyCode !== 69" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 importStudent">
                        <div class="">
                            <input type="file" name="file" id="file-3" class="inputfile inputfile-3" accept=".xls,.xlsx,.csv" required/>
                            <label for="file-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                </svg>
                                <span>Choisissez un fichier&hellip;</span>
                            </label>
                        </div>
                    </div>
                </div>
                <input type="submit" name="Submit" value="Importer">
            </div>
        </form>
    </div>


<?php } else {

    if (isset($_FILES['file'])) {

        $extensionAutorises = array('csv','xls' ,'xlsx');
        $nomFichier = $_FILES['file']['name'];

        $extensionFichier = pathinfo($nomFichier, PATHINFO_EXTENSION);

        if(!in_array($extensionFichier, $extensionAutorises)) {?>
            <div class="msgErrorTitre">
                <h3>Erreur fichier importé</h3>
                <p>Veuillez importer un fichier valide, les extensions acceptées sont : .xls, .xlsx, .csv</p>
                <a href="index.php?page=2">
                    <input class="btnRetour" type=button value="Retour"></input>
                </a>
            </div>
            <?php
        }else{

            $fichier = $_FILES['file']['tmp_name'];
            $eleves = GestionCSV::recupererDonneesDeCSV($fichier);

            $db = new Mypdo();
            $personneManager = new PersonneManager($db);

            $listeElevesImportes = $personneManager->creerTableauEleves($eleves);

            if(!$listeElevesImportes) { ?>
                <div class="msgErrorTitre">
                    <h3>Erreur importation</h3>
                    <p>Un ou plusieurs élèves possèdent déjà cette adresse e-mail !</p>
                </div>
                <?php
            } else {
                $personneManager->insererTableauEleves($listeElevesImportes,$_POST['annee'],$_POST['nom']);

                $listeEleves = $personneManager->getAllEleveAnnee($_POST['annee']);?>

                <div class="row affClassCreated">
                    <div class="col-12 d-flex justify-content-center" style="margin-bottom:5%">
                        <h4>Récapitulatif de la classe importée</h4>
                    </div>

                    <!--Affichage caractéristiques de la classe importée-->
                    <div class="col-12 col-md-5 ">
                        <div class="row">
                            <div class="col-12">
                                <label>Nom de la promotion :</label>
                                <p><?php echo $_POST['nom'] ?></p>
                            </div>

                            <div class="col-12">
                                <label>Année de la promotion :</label>
                                <p><?php echo $_POST['annee'] ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Affichage des élèves importés -->
                    <div class="col-12 col-md-5 listImportStudent">

                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" style="border-radius: 20px 0 0 0;">#</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col" style="border-radius: 0 20px 0 0;">Nom</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($listeEleves as $eleve) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $eleve->getIdPersonne() ?></th>
                                        <td><?php echo $eleve->getPrenomPersonne()?></td>
                                        <td><?php echo $eleve->getNomPersonne()?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                //Préparation de la sauvegarde dans un CSV
                $_SESSION['tableauEleves'] = $personneManager->getTableauElevesPourCSV($listeElevesImportes);?>

                <meta http-equiv="refresh" content="1;url=include/pages/enseignant_exportElevesCSV.inc.php">

                <?php
            }
        }
    }
}
?>
