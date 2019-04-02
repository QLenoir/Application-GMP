<div class="headTestCorrectionSujet">
	<h3>Page de test pour la correction des sujets</h3>
	<hr>
</div>

<?php
$db = new Mypdo();
$corrigeManager = new CorrigeManager($db);
$resultatsAttendusManager = new ResultatsAttendusManager($db);

$idExamen = $_SESSION['examen']->getIdExamen();
$listeSujets = $resultatsAttendusManager->getlisteDesSujets($idExamen);

?>
<p>Liste des sujets</p>

<?php
var_dump($listeSujets);
foreach ($listeSujets as $idSujet) {
	$listeCorrectionSujet[] = $corrigeManager->calculerCorrection($idSujet,true);
}
?>

<p>Liste des corrections</p>

<?php
var_dump($listeCorrectionSujet);
?>
