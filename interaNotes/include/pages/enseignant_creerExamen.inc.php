<?php require_once("include/verifEnseignant.inc.php"); ?>

<?php

$db = new Mypdo();
$eleveManager = new EleveManager($db);
$imageManager = new ImageManager($db);

$listePromo = $eleveManager->getAllPromo();

if(!$listePromo) { ?>
    <div class="msgErrorTitre">
        <h3>Erreur saisie</h3>
        <p>Il n'y a aucune promotion enregistrée</p>
    </div>

<?php } else { ?>

    <?php if(!isset($_POST['enonceExam']) && !isset($_POST['intituleQuestion0'])) { ?>

        <div class="col-12 d-flex justify-content-center" id="needHelp" style="margin-top:20px;">
            <span class="more_info" id="text_info">
                <img class="helpIcon" src="image/help.svg" alt="help" title="Aide">
                Besoin d'aide ?
                <div class="popup">
                </br> <h3>Comment saisir un énoncé ?</h3>  </br>

                <h5> Saisir du texte :</h5>
                <p id="text_info">C'est dans cette zone que vous devrez saisir le texte commun à tous les sujets. Pour revenir à la ligne, une simple pression sur la touche "Entrée" est nécessaire. Les questions et leurs barèmes associés seront saisis ultérieurement.</p>

                <h5> Saisir une variable :</h5>
                <p id="text_info">La saisie des variables doit se faire comme ceci : $maVariable$. Le nom de la variable ne doit pas comporter d'espaces, de '$' et ne doit pas etre identique à un autre nom de variable. Les valeurs et l'unité de la variable seront saisies ultérieurement.</p>

            </div>
        </span>
    </div>
    <hr class="hr" style="width:80%">

    <form action="index.php?page=4" method="post" name="form1">
        <div class="row createExam">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="classExam">Promotion :</label>
                        <select class="form-control" id="classExam" name="classExam" required>
                            <?php foreach ($listePromo as $promo => $value) { ?>
                                <option value="<?php echo $value->annee ?>" > <?php echo $value->nomPromo ; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-12 form-group">
                        <label for="endExam">Date de fin :</label>
                        <input class="form-control" id="endExam" name="endExam" type="date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" min='<?php echo date('Y-m-d');?>' value='<?php echo date('Y-m-d');?>' placeholder="DD/MM/YYYY" required/>
                    </div>

                    <div class="col-12 form-group">
                        <label for="nameExam">Titre de l'examen :</label>
                        <input class="form-control" id="nameExam" name="nameExam" type="text" placeholder="" maxlength="50" required>
                    </div>

                    <div class="col-12 form-group" hidden>
                        <label for="">Numéro du semestre :</label><br>
                        <div class="custom-control custom-radio custom-control-inline firstCheckBoxSemester">
                            <input type="radio" class="custom-control-input" id="customRadio" name="numSemestre" value="1" checked>
                            <label class="custom-control-label" for="customRadio">Semestre 1</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="customRadio2" name="numSemestre" value="2">
                            <label class="custom-control-label" for="customRadio2">Semestre 2</label>
                        </div>
                    </div>
                    <div class="col-12 form-group">
                        <label for="nbEssai">Nombre d'essais :</label>
                        <input class="form-control" id="nbEssai" name="nbEssai" type="number" placeholder="" min="1" step="1" onkeydown="return event.keyCode !== 69" required>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="enonceExam">Enoncé :</label>
                        <textarea class="form-control" id="enonceExam" name="enonceExam" onkeyup="adjustHeightTextArea(this)" placeholder='Veuillez écrire vos variables de la manière suivante : $maVariable$' maxlength="65535" style="min-height:210px !important;" required></textarea>
                    </div>
                </div>
            </div>
            <input type="submit" name="Submit" value="Suivant">
        </form>
    </div>

<?php } elseif (!isset($_POST['intituleQuestion0'])) {

    $_SESSION['nomPromotion'] = $_POST['classExam'];
    $_SESSION['dateLimite'] = $_POST['endExam'];
    $_SESSION['titreExamen'] = $_POST['nameExam'];
    $_SESSION['texteEnonce'] = $_POST['enonceExam'];
    $_SESSION['semestre'] = $_POST['numSemestre'];
    $_SESSION['nbEssaiPossible'] = $_POST['nbEssai'];

    preg_match_all( '#\$(\w++)\$#', $_POST['enonceExam'], $tableauParametres);

    $tableauParametres = $tableauParametres[1]; //destruction des variables $var$

    if(empty($tableauParametres)){
        sleep(2);
        header('Location: index.php?page=4');
    }

    $_SESSION['tableauParametres'] = $tableauParametres;
    ?>

    <div class="row d-flex justify-content-center headCreateExam">
        <div class="col-12 col-md-4">
            <h4>Titre de l'examen : <span><?php echo $_SESSION['titreExamen'] ?></span> </h4>
        </div>
        <div class="col-12 col-md-4">
            <h4>Promotion concernée : <span><?php echo $_SESSION['nomPromotion'] ?></span> </h4>
        </div>
        <div class="col-12 col-md-4">
            <h4>Date de fin : <span><?php echo getFrenchDate($_SESSION['dateLimite']) ?></span> </h4>
        </div>
    </div>

    <hr class="hr" style="width:80%">

    <div class="col-12 d-flex justify-content-center" id="needHelp">
        <span class="more_info" id="text_info">
            <img class="helpIcon" src="image/help.svg" alt="help" title="Aide">
            Besoin d'aide ?
            <div class="popup">
            </br> <h4>Comment&nbspremplir cette&nbsppage ?</h4>

            <h5> La saisie de question :</h5>
            <p id="text_info">Pour saisir une question, vous devez d'abord saisir l'intitulé de la question puis son barème. Si cette question représente 2pts sur 20, vous devez seulement saisir 2. Enfin, vous pouvez cocher la case "valeur parfaite" si vous souhaitez que l'étudiant doit saisir exactement la bonne réponse pour avoir les points sinon il n'aura aucun point. Dans le cas contraire, les points de l'étudiant dépendront de la différence entre son résultat et le résultat attentu</p>

            <h5> La saisie des valeurs :</h5>
            <p id="text_info">A chaque paramètre saisie dans l'énoncé, vous retrouverez un bouton pour ajouter les valeurs que peut prendre cette variable. Les variables peuvent prendre soit des valeurs uniques ou alors des intervalles. Pour saisir des intervalles, vous saisissez une valeur minimale et une maximale ainsi que leur puissance et un pas. Dans les deux cas, vous devez ensuite saisir l'unité (SI) de la valeur et l'exposant de cette unité.</p>
            <i>Exemple : Pour avoir un résultat en 'km', vous devez sélectionner l'unité 'm' (mètre) dans unité du résultat puis 3 dans Exposant de l'unité </i>
            <p>Vous pouvez retrouver toutes les valeurs ou intervalles déjà saisis dans la liste en dessous. Pour supprimer une ligne, vous devez la sélectionner la ligne dans la liste puis cliquer sur la poubelle.</p>
        </br>
    </div>
</span>
</div>

<hr class="hr" style="width:80%">

<div class="row enonceCreateExam">
    <div class="col-12">
        <h4>Enonce de l'examen</h4>
        <p><?php echo $_SESSION['texteEnonce']?></p>
    </div>
</div>

<form method="post" action="index.php?page=4" id="createExam2">

    <div class="row">
        <div class="col-12">
            <h4>Liste des questions de l'examen&nbsp:</h4>

            <div class="form-container">
                <fieldset>
                    <!-- Form Name -->
                    <div class="form-group" style="margin-bottom:15px;">
                        <div class="row">
                            <!-- Replace these fields -->
                            <div class="col-12 col-md-6">
                                <input type="text" id="intituleQuestion0" name="intituleQuestion0" class="form-control intituleQuestion" placeholder="Intitulé" required>
                            </div>
                            <div class="col-4 col-md-2">
                                <input type="number" id="bareme0" name="bareme0" class="form-control bareme" placeholder="Barème" step="0.25" min="0.25" max="20" onkeydown="return event.keyCode !== 69" required>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="custom-control">
                                    <input type="number" class="form-control bareme" id="zoneTolerance0" name="zoneTolerance0" min=0 max=100 step="0.5" placeholder="% de tolérance" onkeydown="return event.keyCode !== 69" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dynamic-stuff">
                        <!-- Dynamic element will be cloned here -->
                        <!-- You can call clone function once if you want it to show it a first element-->
                        <!-- HIDDEN DYNAMIC ELEMENT TO CLONE -->
                        <!-- you can replace it with any other elements -->
                        <div class="form-group dynamic-element" style="display:none">
                            <div class="row">
                                <!-- Replace these fields -->
                                <div class="col-12 col-md-6">
                                    <input disabled="disabled" type="text" id="intituleQuestion" name="intituleQuestion" class="form-control intituleQuestion" placeholder="Intitulé">
                                </div>
                                <div class="col-4 col-md-2">
                                    <input disabled="disabled" type="number" id="bareme" name="bareme" class="form-control bareme" placeholder="Barème" step="0.25" min="0.25" max="20" onkeydown="return event.keyCode !== 69">
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="custom-control">
                                        <input type="number" class="form-control bareme" id="zoneTolerance" placeholder="% de tolérance"  min=0 max=100 step="0.5" onkeydown="return event.keyCode !== 69">
                                    </div>
                                </div>

                                <!-- End of fields-->
                                <div class="col-md-1">
                                    <p class="delete">
                                        <img class="trachIconCreateExam" src="image/trash.ico" alt="trash">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- END OF HIDDEN ELEMENT -->
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="add-one">+ ajouter une question</p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>


    <div class="row saisieValeursParametre">
        <div class="col">
            <h4>Liste des paramètres de l'examen :</h4>


            <?php

            $nombre = count($tableauParametres);

            foreach ($tableauParametres as $compteur => $parametre) { ?>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <p><?php echo $parametre ?> : </p>

                        <div class="choiceParameterSaisie">
                            <button id="<?php echo "btnAjout".$compteur; ?>" class="btn btn-primary popUp" type="button" name="button" onclick="ouvrirBox(<?php echo $compteur; ?>,<?php echo $nombre; ?>)">Ajouter les valeurs</button>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" id=<?php echo "catia".$compteur ?> name=<?php echo "catia".$compteur ?> class="custom-control-input" >
                                <label class="custom-control-label" for=<?php echo "catia".$compteur ?>>Catia</label>
                            </div>
                        </div>
                    </div>

                    <div class="ajoutImageParametre col-12 col-lg-8">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <?php $listeImages = $imageManager->getAllImages();?>

                                <label>Symbole du paramètre : </label>
                                <select class="form-control" name="symbole<?php echo $compteur;?>">
                                    <option value="0"> Aucun </option>
                                    <?php
                                    foreach ($listeImages as $image) { ?>
                                        <option value="<?php echo $image->getIdImage();?>" > <?php echo $image->getCheminImage(); ?> </option>
                                    <?php  } ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-5">
                                <label>Formule du paramètre : </label>
                                <select class="form-control" name="formule<?php echo $compteur;?>">
                                    <option value="0"> Aucune </option>
                                    <?php foreach ($listeImages as $image) { ?>
                                        <option value="<?php echo $image->getIdImage();?>" > <?php echo $image->getCheminImage() ?> </option>
                                    <?php  } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="box mesParametresSaisie" id=<?php echo "box".$compteur ;?> >
                        <div class="form-wrapper">
                            <h4><?php echo $parametre ?></h4>

                            <div class="row d-flex justify-content-around choixTypesValeurs">
                                <div class="col-5 d-flex justify-content-center">
                                    <input id=<?php echo "boutonUnique".$compteur ; ?> type="button" value="Valeurs Uniques" onclick="affichageSaisieValeurUnique(<?php echo $compteur; ?>)">
                                </div>

                                <div class="col-5 d-flex justify-content-center">
                                    <input id=<?php echo "boutonIntervalle".$compteur ; ?> type="button" onclick="affichageSaisieIntervalle(<?php echo $compteur; ?>)" value="Intervalles">
                                </div>
                            </div>

                            <div class="blockValeurUnique" id=<?php echo "valeursUniques".$compteur ;?> style="display : none">

                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Nouvelle valeur :</label>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="<?php echo 'saisieParametre'.$compteur ?>" type="text" >
                                    </div>
                                    <div class="col-5 form-group divPuissanceResult d-flex">
                                        <span id="puissanceValeur">x10</span>
                                        <input id=<?php echo "puissanceValeur".$compteur; ?> class="form-control saisiePuissanceResult" type="number" value="0" step="1" onkeydown="return event.keyCode !== 69">

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="uniteAnswer">Unité de la valeur :</label>
                                    <select class="form-control" id=<?php echo "uniteValeur".$compteur ;?> type="text" placeholder="Sélectionnez l'unité du résultat">
                                        <?php
                                        $listeUnites = Unites::getConstants();
                                        foreach ($listeUnites as $unite => $abreviation) { ?>
                                            <option value="<?php echo $abreviation ?>"><?php echo $abreviation ?></option>";
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exposantAnswer">Exposant de l'unité :</label>
                                    <select class="form-control" id=<?php echo "exposantValeur".$compteur ;?> type="text" placeholder="Sélectionnez l'exposant de l'unité" >
                                        <?php
                                        $listeExposants = Exposants::getConstants();
                                        $defautExposant = Exposants::getExposantParDefaut();

                                        foreach ($listeExposants as $exposant) { ?>
                                            <option <?php if($exposant==$defautExposant){ echo "selected ";} ?>value="<?php echo $exposant ?>"><?php echo $exposant ?></option>";
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col d-flex justify-content-center">
                                        <input class="btnSaisieValeur" type="button" value="Valider valeur" class="btn" onclick="return ajouterValeurDeParametre(event,<?php echo "'saisieParametre".$compteur."'" ?>,<?php echo "'parametre".$compteur."'" ?>,<?php echo "'puissanceValeur".$compteur."'" ?>,<?php echo "'uniteValeur".$compteur."'" ?>,<?php echo "'exposantValeur".$compteur."'" ?>)" name=<?php echo "'saisieParametre".$compteur."'" ?> />
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-between divListeValeursTrash">
                                    <div class="col-8 d-flex justify-content-center listeValeur">
                                        <select class="form-control" id="<?php echo 'parametre'.$compteur ?>" multiple></select>
                                    </div>
                                    <div class="col-3 d-flex jsutify-content-center">
                                        <button class="myTrash" id="<?php echo "bouton".$compteur; ?>" onclick=<?php echo "supprimerValeur(".$compteur.",0)"; ?> type="button" value="Supprimer">
                                            <img src="image/delete.png" alt="delete">
                                        </button>
                                    </div>
                                </div>

                                <div class="row form-group divMdpButton d-flex justify-content-around">
                                    <div class="col-5 d-flex justify-content-center">
                                        <input class="btnSaisieValeur" type="button" value="Annuler" class="btn" onclick=" annulerSaisie(<?php echo $compteur; ?>) " />
                                    </div>
                                    <div class="col-5 d-flex justify-content-center">
                                        <input class="btnSaisieValeur" type="button" value="Valider" class="btn" onclick="ouvrirBox(<?php echo $compteur ?>,<?php echo $nombre ?>)" />
                                    </div>
                                </div>
                            </div>

                            <div class="blockIntervalle" id=<?php echo "intervalle".$compteur ;?> style="display : none">

                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Nouvel intervalle :</label>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="<?php echo 'saisieValeurMinimale'.$compteur ?>" type="number" step="0.0001" placeholder="Valeur minimale" onkeydown="return event.keyCode !== 69">
                                    </div>
                                    <div class="col-5 form-group divPuissanceResult d-flex">
                                        <span id="puissanceValeur">x10</span>
                                        <input id=<?php echo "puissanceValeurIntervalle".$compteur; ?> class="form-control saisiePuissanceResult" type="number" value="0" step="1" onkeydown="return event.keyCode !== 69" >
                                    </div>

                                    <div class="col-7">
                                        <input class="form-control" id="<?php echo 'saisieValeurMaximale'.$compteur ?>" type="number" step="0.0001" placeholder="Valeur maximale" onkeydown="return event.keyCode !== 69">
                                    </div>
                                    <div class="col-5 form-group divPuissanceResult d-flex">
                                        <span id="puissanceValeur">x10</span>
                                        <input id=<?php echo "puissanceValeurIntervalle2".$compteur; ?> class="form-control saisiePuissanceResult" type="number" value="0" step="1" onkeydown="return event.keyCode !== 69" >

                                    </div>

                                    <div class="col-12">
                                        <input class="form-control" id="<?php echo 'pas'.$compteur ?>" type="number" min="0.0001" step="0.0001" placeholder="Pas" onkeydown="return event.keyCode !== 69">
                                    </div>
                                </div>

                                <div class="form-group" style="margin-top:15px">
                                    <label for="uniteAnswer">Unité de la valeur :</label>
                                    <select class="form-control" id=<?php echo "uniteValeurIntervalle".$compteur ;?> type="text" placeholder="Sélectionnez l'unité du résultat" >
                                        <?php
                                        $listeUnites = Unites::getConstants();

                                        foreach ($listeUnites as $unite => $abreviation) { ?>
                                            <option value="<?php echo $abreviation ?>"><?php echo $abreviation ?></option>";
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exposantAnswer">Exposant de l'unité :</label>
                                    <select class="form-control" id=<?php echo "exposantValeurIntervalle".$compteur ;?> type="text" placeholder="Sélectionnez l'exposant de l'unité" >
                                        <?php
                                        $listeExposants = Exposants::getConstants();
                                        $defautExposant = Exposants::getExposantParDefaut();

                                        foreach ($listeExposants as $exposant) { ?>
                                            <option <?php if($exposant==$defautExposant){ echo "selected ";} ?>value="<?php echo $exposant ?>"><?php echo $exposant ?></option>";
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col d-flex justify-content-center">
                                        <input class="btnSaisieValeur" type="button" value="Valider valeur" class="btn" onclick="return ajouterValeurDeParametreIntervalle(event,<?php echo "'saisieValeurMinimale".$compteur."'" ?>,<?php echo "'saisieValeurMaximale".$compteur."'" ?>,<?php echo "'pas".$compteur."'" ?>,<?php echo "'liste".$compteur."'" ?>,<?php echo "'puissanceValeurIntervalle".$compteur."'" ?>,<?php echo "'puissanceValeurIntervalle2".$compteur."'" ?>,<?php echo "'uniteValeurIntervalle".$compteur."'" ?>,<?php echo "'exposantValeurIntervalle".$compteur."'" ?>)" />
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-between divListeValeursTrash">
                                    <div class="col-8 d-flex justify-content-center listeValeur">
                                        <select class="form-control" id="<?php echo 'liste'.$compteur ?>" multiple></select>
                                    </div>
                                    <div class="col-3 d-flex jsutify-content-center">
                                        <button class="myTrash" id="<?php echo "bouton".$compteur; ?>" onclick=<?php echo "supprimerValeurIntervalle(".$compteur.",1)"; ?> type="button" value="Supprimer">
                                            <img src="image/delete.png" alt="delete">
                                        </button>
                                    </div>
                                </div>

                                <div class="row form-group divMdpButton d-flex justify-content-around">
                                    <div class="col-5 d-flex justify-content-center">
                                        <input class="btnSaisieValeur" type="button" value="Annuler" class="btn" onclick=" annulerSaisie(<?php echo $compteur; ?>) " />
                                    </div>
                                    <div class="col-5 d-flex justify-content-center">
                                        <input class="btnSaisieValeur" type="button" value="Valider" class="btn" onclick=<?php echo "ouvrirBox(".$compteur.",".$nombre.")"; ?> />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <hr class="sptVariableExam">

                <?php
            } ?>

        </div>
    </div>
    <input class="btnValiderExamen" id="buttonValider" type="submit" onclick="recupSelect(<?php echo $nombre; ?>)"value="Valider">
</form>


<?php    } else {

    $examenManager = new ExamenManager($db);

    $examenManager->creerExamen($_SESSION['dateLimite'],$_SESSION['nomPromotion'],$_SESSION['titreExamen'],$_SESSION['texteEnonce'],$_SESSION['nbEssaiPossible']);

    $idExamen = $db->lastInsertId();
    $questions = $_POST;
    $examenManager->creerQuestion($questions);

    foreach($_COOKIE as $key=>$value) {
        if($key != "PHPSESSID" && $key != null){
          if(strpos($key, "point") !== false){
            $points[$key]=$value;
          }
        }
    }

    $i=0;
    foreach ($points as $key => $value) {
        $listeDonnees = explode(",", $value);
        $point = $_SESSION['tableauParametres'][$i];

        foreach ($listeDonnees as $key2 => $value) {
            $donnees = explode(" / ", $value);

            if(count($donnees) === 4){

                $listePoints[$point][$key2]['valeur']=$donnees[0];
                $listePoints[$point][$key2]['exposantValeur']=$donnees[1];
                $listePoints[$point][$key2]['uniteValeur']=$donnees[2];
                $listePoints[$point][$key2]['uniteExposant']=$donnees[3];
            } else {
                $k=0;
                for ($j = $donnees[0]*pow(10, $donnees[1]); $j <= $donnees[2]*pow(10, $donnees[3]); $j = $j + $donnees[4]) {
                    //fonction pour remettre des valeurs propres ?
                    $listePoints[$point][$key2][$k]['valeur']=$j;
                    $listePoints[$point][$key2][$k]['exposantValeur']=0;
                    $listePoints[$point][$key2][$k]['uniteValeur']=$donnees[5];
                    $listePoints[$point][$key2][$k]['uniteExposant']=$donnees[6];
                    $k++;
                }

            }
        }

        if (isset($_POST['catia'.$i])) {
            $listePoints[$point]['estDonneesCatia'] = 1;
        } else {
            $listePoints[$point]['estDonneesCatia'] = 0;
        }

        $listePoints[$point]['symboleMathematique'] = $_POST['symbole'.$i];
        $listePoints[$point]['formuleMathematique'] = $_POST['formule'.$i];

        $i++;
    }

    $examenManager->creerPoint($listePoints);

    unset($_SESSION['nomPromotion']);
    unset($_SESSION['dateLimite']);
    unset($_SESSION['titreExamen']);
    unset($_SESSION['texteEnonce']);
    unset($_SESSION['semestre']);
    unset($_SESSION['nbEssaiPossible']);

    ?>
    <div class="msgConfirmTitre">
        <h3>Succès</h3>
        <p>L'examen a été créé avec succès !</p>
        <p>Veuillez patienter pendant que les sujets sont générés</p>
    </div>

<?php
  $_SESSION['idExamenCree'] = $examenManager->getLastExamenCree();
  header('Location: index.php?page=22');
  }
} ?>
