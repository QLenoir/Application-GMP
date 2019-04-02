<?php if(empty($_POST['objet'])){ ?>

    <div class="form-wrapper">
        <h3 style="margin-bottom : 5%; margin-top:-2%">Poser une question</h3>

        <form method="post" action="#">

            <div class="form-group">
              <label for="objet" class="form-label">Veuillez saisir l'objet du mail</label>
              <input class="form-input" type="text" id="objet" name="objet" required/>
            </div>

            <div>
              <label for="contenu" class="form-label">Veuillez saisir le contenu du mail</label>
              <textarea id="phMail" class="form-control" onkeyup="adjustHeightTextAreaSmall(this)" placeholder='Détaillez la question ici ...' maxlength="65535" id="contenu" name="contenu" cols="12" rows="3" required></textarea>
            </div>

            <div class="form-group divMdpButton">
              <input type="submit" value="Valider" class="btn"/>
            </div>

        </form>
    </div>

    <?php
}else{
    $pdo = new Mypdo();
    $personneManager = new PersonneManager($pdo);

    $personne = $personneManager->getPersonneByLogin($_SESSION['eleve']);

    if($personne){

        $_SESSION['contenu'] = $_POST['contenu'];
        $_SESSION['objet'] = $_POST['objet'];
        $_SESSION['prenom'] = $personne->getPrenomPersonne();
        $_SESSION['nom'] = $personne->getNomPersonne();
        $_SESSION['mail'] = $personne->getMailPersonne();

        header('Location: index.php?page=13');

    }else{ ?>
        <h3>Compte inexistant</h3>
        <p>L'adresse mail insérée ne correspond à aucun compte, veuillez vérifier votre adresse mail et essayer à nouveau</p>
    </div>

<?php
  }
} ?>
