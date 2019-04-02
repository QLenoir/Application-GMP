<?php
if(empty($_POST['mail'])){ ?>

    <div class="form-wrapper">
        <h3 style="margin-bottom : 5%; margin-top:-2%">Mot de passe oublié&nbsp?</h3>

        <form method="post" action="#">

            <div class="form-group">
                <label for="mail" class="form-label">Veuillez saisir votre mail</label>
                <input class="form-input" type="mail" id="mail" name="mail"  required/>
            </div>

            <div class="form-group divMdpButton">
                <input class="detailMdpButton" type="submit" value="Valider" class="btn"/>
            </div>

        </form>
    </div>

    <?php
}else{
    $pdo = new Mypdo();
    $personneManager = new PersonneManager($pdo);

    $personne = $personneManager->getPersonneByMail($_POST['mail']);

    if($personne){

        $password = createRandomPassword();
        $personneManager->updatePasswordOfPersonne($personne->getIdPersonne(),createProtectedPassword($password));

        $_SESSION['mail'] = $_POST['mail'];
        $_SESSION['passwd'] = $password;

        header('Location: index.php?page=44');?>

        <?php
    }else{ ?>

        <div class="msgErrorTitre">
            <h3>Compte inexistant</h3>
            <p>L'adresse mail insérée ne correspond à aucun compte, veuillez vérifier votre adresse mail et essayer à nouveau</p>
        </div>

        <?php
    }
}?>
