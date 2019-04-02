<?php
$db = new Mypdo();
$questionManager = new QuestionManager($db);
$sujetManager = new SujetManager($db);
$examenManager = new ExamenManager($db);
$reponseEleveManager = new ReponseEleveManager($db);
$resultatAttendusManager = new ResultatsAttendusManager($db);

$idSujet = $_GET['idSujet'];

if(isset($idSujet)) {

	if($sujetManager->sujetEstExistant($idSujet)){

		$personneManager = new PersonneManager($db);
		$personne = $personneManager->getNomPrenomParSujet($idSujet);

		$sujet = $sujetManager->getSujet($idSujet);
		$examenSujet = $examenManager->getExamen($sujet->getIdExamenOfSujet());

		$questions = $questionManager->getAllQuestionOfSujet($sujet->getIdExamenOfSujet(),$idSujet);

		$listeReponses = $reponseEleveManager->getAllReponseEleve($idSujet);

		if (isset($_SESSION['eleve']) && !$examenSujet->estFini()) { ?>
			<h4 style="margin-top:30px">Résultats attendus : </h4>
			<p>La date de dépôt du sujet n'est pas encore passée</p>

			<?php
		}else{ ?>
			<h4 style="margin-top:30px">Résultats attendus : </h4>
			<div class="row d-flex justify-content-center correctionSujet">
				<div class="col-11 listImportStudent">

					<table class="table table-hover">
						<thead class="thead-dark">
							<tr>
								<th scope="col" style="border-radius: 20px 0 0 0;">Question n°</th>
								<th scope="col">Intitulé de la question</th>
								<th scope="col">Réponse</th>
								<th scope="col">Exposant du résultat</th>
								<th scope="col">Unité</th>
								<th scope="col">Exposant de l'unité</th>
								<th scope="col" style="border-radius: 0 20px 0 0;">Zone de tolérance</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td>
									<?php foreach ($questions as $question) {
										$idQuestion = $question->getIdQuestion();?>

										<p><?php echo $idQuestion; ?></p>
									<?php } ?>
								</td>
								<td>
									<?php foreach ($questions as $question) {
										$intitule = $question->getIntituleQuestion();?>

										<p><?php echo $intitule; ?></p>
									<?php } ?>
								</td>
								<td>
									<?php foreach ($questions as $question) {
										$idQuestion = $question->getIdQuestion();
										$resultatAttendus = $resultatAttendusManager->getResultatAttendusByQuestion($idSujet, $idQuestion);
										$resultat = $resultatAttendus->getResultat();?>

										<p><?php echo $resultat; ?></p>
									<?php } ?>
								</td>
								<td>
									<?php foreach ($questions as $question) {
										$idQuestion = $question->getIdQuestion();
										$resultatAttendus = $resultatAttendusManager->getResultatAttendusByQuestion($idSujet, $idQuestion);
										$exposantResultat = $resultatAttendus->getResultatExposant();?>

										<p><?php echo $exposantResultat; ?></p>
									<?php } ?>
								</td>
								<td>
									<?php foreach ($questions as $question) {
										$idQuestion = $question->getIdQuestion();
										$resultatAttendus = $resultatAttendusManager->getResultatAttendusByQuestion($idSujet, $idQuestion);
										$unite = $resultatAttendus->getResultatUnite();?>

										<p><?php echo $unite; ?></p>
									<?php } ?>
								</td>
								<td>
									<?php foreach ($questions as $question) {
										$idQuestion = $question->getIdQuestion();
										$resultatAttendus = $resultatAttendusManager->getResultatAttendusByQuestion($idSujet, $idQuestion);
										$exposant = $resultatAttendus->getExposantUnite();?>

										<p><?php echo $exposant; ?></p>
									<?php } ?>
								</td>
								<td>
									<?php foreach ($questions as $question) {
										$zoneTolerance= $question->getZoneTolerance();?>

										<p><?php echo $zoneTolerance; ?>%</p>
									<?php } ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<?php
		} ?>

		<h4> Résultats saisis par l'étudiant : </h4>

		<?php
		if(!$listeReponses){ ?>

			<div class="msgErrorTitre">
				<h3>Erreur saisie</h3>
				<p>Aucune réponse saisie par l'étudiant !</p>
			</div>

			<?php
		} else { ?>
			<div class="col-12 listImportStudent">

				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col" style="border-radius: 20px 0 0 0;">Date de saisie</th>
							<th scope="col">Question n°</th>
							<th scope="col">Résultat saisi</th>
							<th scope="col">Exposant du résultat</th>
							<th scope="col">Unité</th>
							<th scope="col">Exposant de l'unité</th>
							<th scope="col" <?php if (!$examenSujet->estFini()){ ?>
								style="border-radius: 0 20px 0 0;"<?php }?>>
							Justification</th>


							<?php if ($examenSujet->estFini()){ ?>
								<th scope="col" style="border-radius: 0 20px 0 0;">Précision</th>
							<?php } ?>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($listeReponses as $reponse) { ?>
							<tr>
								<td><?php echo getFrenchDate($reponse->getDateResult()) ?></td>
								<td><?php echo $reponse->getIdQuestion() ?></td>
								<td><?php echo $reponse->getResultat() ?></td>
								<td><?php echo $reponse->getResultatUnite() ?></td>
								<td><?php echo $reponse->getExposantUnite() ?></td>
								<td><?php echo $reponse->getResultatExposant() ?></td>
								<td style="overflow-wrap: break-word;max-width:400px"><?php echo $reponse->getJustification() ?></td>
								<?php if ($examenSujet->estFini()){ ?>
									<td><?php echo $reponse->getPrecisionReponse() ?> %</td>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>

			<?php
		}

	} else {
		header('Location: index.php?page=3');
	}

} else {
	header('Location: index.php?page=3');
} ?>
