	<?php
	if (!empty($_GET["page"])){
		$page=$_GET["page"];
	}else{
		$page=0;
	}

	switch ($page) {

		// WARNING: CONNEXION
		case 0:
		$_SESSION['titre'] = "Connexion";
		break;

		// WARNING: PARTIE ENSEIGNANT

		case 1:
		$_SESSION['titre'] = "";
		break;

		case 2:
		$_SESSION['titre'] = "Créer une classe";
		break;

		case 3:
		$_SESSION['titre'] = "Lister les sujets";
		break;

		case 4:
		$_SESSION['titre'] = "Créer un examen";
		break;

		case 5:
		$_SESSION['titre'] = "Lister mes examens";
		break;

		case 6:
		$_SESSION['titre'] = "Ajouter des essais";
		break;

		case 7:
		$_SESSION['titre'] = "Tester une correction";
		break;

		case 8:
		$_SESSION['titre'] = "Mes images";
		break;

		// WARNING: PARTIE ELEVE
		case 10:
		$_SESSION['titre'] = "";
		break;

		case 12:
		$_SESSION['titre'] = "Poser une question";
		break;

		case 14:
		$_SESSION['titre'] = "Lister mes sujets terminés";
		break;

		case 17:
		$_SESSION['titre'] = "Consulter mes notes";
		break;

		case 18:
		$_SESSION['titre'] = "Détails des notes";
		break;

		case 19:
		$_SESSION['titre'] = "Saisir mes réponses";
		break;

		// WARNING : Pages communes

		case 40:
		$_SESSION['titre'] = "Déconnexion";
		break;

		case 41:
		$_SESSION['titre'] = "Mon compte";
		break;

		case 42:
		$_SESSION['titre'] = "Mon compte - Mot de passe";
		break;

		case 43:
		$_SESSION['titre'] = "Mot de passe oublié";
		break;

		case 44:
		$_SESSION['titre'] = "Mot de passe oublié";
		break;

		case 45:
		$_SESSION['titre'] = "Afficher le sujet";
		break;

		case 46:
		$_SESSION['titre'] = "Afficher le sujet et les résultats";
		break;
	}

	?>
