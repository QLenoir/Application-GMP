<?php require_once("include/verifEleve.inc.php");

$pdo = new Mypdo();
$sujetManager = new SujetManager($pdo);
$idSujet = $sujetManager->getIdSujetByLogin($_SESSION['eleve']);

$examenManager = new ExamenManager($pdo);
$_SESSION['examen'] = $examenManager->getExamen(1); //WARNING: préciser examen ?>

<div class="row justify-content-center justify-content-around">

    <div class="col-6 col-lg-2 TicTacAccueil">
        <a href="index.php?page=45&amp;idSujet=<?php echo $idSujet ?>">
            <div class="tictac">
                <div class="tictacHaut">
                    <img class="iconTictac" src="image/subject.png" alt="exam" title="Mon sujet">
                </div>

                <div class="tictacBas">
                    Mon sujet
                </div>
            </div>
        </a>
    </div>

    <div class="col-6 col-lg-2 TicTacAccueil">
        <a href="index.php?page=14">
            <div class="tictac">
                <div class="tictacHaut">
                    <img class="iconTictac" src="image/liste.png" alt="exam" title="Mes sujets terminés">
                </div>

                <div class="tictacBas">
                    Mes sujets terminés
                </div>
            </div>
        </a>
    </div>

    <div class="col-6 col-sm-4 col-lg-2 TicTacAccueil">
        <a href="index.php?page=17">
            <div class="tictac">
                <div class="tictacHaut">
                    <img class="iconTictac" src="image/grade.png" alt="exam" title="Mes notes">
                </div>

                <div class="tictacBas">
                    Mes notes
                </div>
            </div>
        </a>
    </div>

    <div class="col-6 col-sm-4 col-lg-2 TicTacAccueil">
        <a href="index.php?page=12">
            <div class="tictac">
                <div class="tictacHaut">
                    <img class="iconTictac" src="image/questions.png" alt="exam" title="Une question ?">
                </div>

                <div class="tictacBas">
                    Poser une question
                </div>
            </div>
        </a>
    </div>

    <div class="col-6 col-sm-4 col-lg-2 TicTacAccueil">
        <a href="index.php?page=41">
            <div class="tictac">
                <div class="tictacHaut">
                    <img class="iconTictac" src="image/parameter.png" alt="exam" title="Mon compte">
                </div>

                <div class="tictacBas">
                    Mon compte
                </div>
            </div>
        </a>
    </div>

</div>
