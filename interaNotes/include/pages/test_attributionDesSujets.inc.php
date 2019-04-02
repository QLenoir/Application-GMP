<?php
//WARNING : vérifier si l'attribution n'a pas déjà été faite
//WARNING : nom de promo a recupérer depuis créer un idExamen
$nomPromo = "Promo 2021";
$idExamen = $_SESSION['examen']->getIdExamen();

$pdo = new Mypdo();
$eleveManager = new EleveManager($pdo);
$listeEleves = $eleveManager->getAllIdElevesByPromo($nomPromo);

$sujetManager = new SujetManager($pdo);
$listeSujets = $sujetManager->getAllSujetsOfExamen($idExamen);

$attributionManager = new AttributionManager($pdo);
?>

<div class="attributionSujets">
  <?php

  $retour = $attributionManager->insererTableauAttribution($listeEleves, $listeSujets);
  if($retour){
      ?>
      <div class="msgConfirmTitre">
          <h3>Message de confirmation</h3>
          <p>Les sujets ont été attribué ! </p>
      </div>
      <?php

  }else{
      ?>
      <div class="msgErrorTitre">
          <h3>Erreur interne</h3>
          <p>Echec de l'attribution des sujets ! </p>
      </div>
      <?php
  }

   ?>
</div>
