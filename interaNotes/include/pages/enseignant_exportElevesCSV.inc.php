<?php
session_start();

$filename = "liste_eleves_".date("d_m_Y").".csv";

header('Content-Encoding: UTF-8');
header("Content-Type: application/csv; charset=UTF-8");
header("Content-disposition: attachment; filename={$filename}");
echo "\xEF\xBB\xBF";

$csv = fopen('php://output', 'w');

$nomDeColonnes = array("Nom","Prénom","Mail","Identifiant","Mot de passe");
fputcsv($csv, $nomDeColonnes, ";");

foreach($_SESSION['tableauEleves'] as $personne)
{
  fputcsv($csv, $personne, ";");
}
fclose($csv);

unset($_SESSION['tableauEleves']);


?>
