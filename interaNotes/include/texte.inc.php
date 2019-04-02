<div id="texte">
	<?php
	if (!empty($_GET["page"])){
		$page=$_GET["page"];
	}else{
		$page=0;
	}

	switch ($page) {

		// WARNING: CONNEXION
		case 0:
		include_once('pages/connexion.inc.php');
		break;

		// WARNING: PARTIE ENSEIGNANT

		case 1:
		include_once('pages/enseignant_accueil.inc.php');
		break;

		case 2:
		include_once('pages/enseignant_creerClasse.inc.php');
		break;

		case 3:
		include_once('pages/enseignant_listerSujets.inc.php');
		break;

		case 4:
		include_once('pages/enseignant_creerExamen.inc.php');
		break;

		case 5:
		include_once('pages/enseignant_listerExamens.inc.php');
		break;

		case 6:
		include_once('pages/enseignant_ajouterEssai.inc.php');
		break;

		case 7:
		include_once('pages/enseignant_testerUneCorrection.inc.php');
		break;

		case 8:
		include_once('pages/enseignant_ajouterImage.inc.php');
		break;

		// WARNING: PARTIE ELEVE
		case 10:
		include_once('pages/eleve_accueil.inc.php');
		break;

		case 12:
		include_once('pages/eleve_poserQuestion.inc.php');
		break;

		case 13:
		include_once('pages/eleve_mailPoserQuestion.inc.php');
		break;

		case 14:
		include_once('pages/eleve_listerSujetsTermines.inc.php');
		break;

		case 17:
		include_once('pages/eleve_consulterNote.inc.php');
		break;

		case 18:
		include_once('pages/eleve_calculerNote.inc.php');
		break;

		case 19:
		include_once('pages/eleve_saisieReponses.inc.php');
		break;

		case 22:
		include_once('pages/enseignant_genererSujets.inc.php');
		break;

		// WARNING: PARTIE TEST

		case 28:
		include_once('pages/test_attributionDesSujets.inc.php');
		break;

		// WARNING : Pages communes

		case 40:
		include_once('pages/deconnexion.inc.php');
		break;

		case 41:
		include_once('pages/detailsCompte.inc.php');
		break;

		case 42:
		include_once('pages/detailsCompte_modifierPassword.inc.php');
		break;

		case 43:
		include_once('pages/detailsCompte_passwordOublie.inc.php');
		break;

		case 44:
		include_once('pages/detailsCompte_mailPasswordOublie.inc.php');
		break;

		case 45:
		include_once('pages/afficherSujet.inc.php');
		break;

		case 46:
		include_once('pages/afficherSujet_avecResultats.inc.php');
		break;

		default:
		if(isset($_SESSION['eleve'])){

			header('Location: index.php?page=10');

		} elseif (isset($_SESSION['enseignant'])) {

			header('Location: index.php?page=1');

		} else {

			header('Location: index.php?page=0');

		}
		break;
	}

	?>
</div>
