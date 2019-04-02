<?php require_once("include/verifEnseignant.inc.php"); ?>

<?php
if(isset($_GET['id'])){

    $pdo = new Mypdo();
    $examenManager = new ExamenManager($pdo);

    $nbEssaiRestant = $examenManager->getNbEssaiRestant($_GET['id'],$_SESSION['examen']->getIdExamen());

    if(!isset($_POST['nbEssaiRealise'])) { ?>
        <div class="modifierNbEssais">
            <form method="post" action="index.php?page=6?&id=1">

                <p>Choisir le nombre d'essai à ajouter pour l'étudiant : </p>
                <input type="number" name="nbEssaiRealise" min=1 step="1" value=1 onkeydown="return event.keyCode !== 69">
                <input type="submit" value="Valider">
            </form>
        </div>
    <?php } else {
        $examenManager->updateNombreEssais($_POST['nbEssaiRealise'],$_GET['id'],$_SESSION['examen']->getIdExamen())
        ?>
        <div class="msgConfirmTitre">
            <h3>Message de confirmation</h3>
            <p> Le nombre d'essai de l'étudiant a été mis à jour !</p>
        </div>
        <?php

    }?>

    <?php
} else {
    header('Location: index.php?page=5');
}
