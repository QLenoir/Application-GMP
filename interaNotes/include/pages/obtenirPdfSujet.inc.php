<?php
require('../../classes/Question.class.php');
session_start();
require('../../classes/PDF.class.php');



// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->SetTitle("Sujet_".$_SESSION['sujet']['idSujet']);
$pdf->AliasNbPages();
$pdf->AddPage('','',0);
$pdf->AddTitre($_SESSION['sujet']['titre']);
$pdf->AddDate($_SESSION['sujet']['date']);
$pdf->AddEnonce($_SESSION['sujet']['enonce']);
foreach ($_SESSION['sujet']['questions'] as $Cle => $question) {
  $pdf->AddQuestion($question->getIntituleQuestion());
}
$pdf->AddImages($_SESSION['sujet']['image1'],$_SESSION['sujet']['image2']);
$pdf->Output();
?>
